<?php
error_reporting(0);
date_default_timezone_set('PRC'); 

function backText($status,$contents){
	
	header("Content-Type: text/json");
		echo json_encode(
			array(
			'status' => $status,
			'contents' => $contents
			)
		);
	return true;
}

function toXML($contents,$debug){
	
	$xml = simplexml_load_string($contents,'SimpleXMLElement',$debug);
	$tAddr = '123456@654321.boom';
	$fAddr = 'From: '.$xml->email;
	$subject = 'Email from '. $xml->user .' Q : '. $xml->questions;
	$content = '<STRAT> '. $xml->messages.' <END>';
	@mail(
		$tAddr,
		$subject,
		$content,
		$fAddr
	
	);
	return backText('success',join("\x0a",[$tAddr,$fAddr,$subject,$content]));
}


class getSeurceFunction{
	
	public static $key = '148046b3ed18c77e32ff80a1ee62f55f180a4207abbd7a2d08e0d84b98cdefe4';
	private $allow;
	
		function __construct($key = null,$key_cmp = null,$auth = true){
				if($auth){
					if(is_string($key) and is_string($key_cmp) and $key === getSeurceFunction::$key and $key_cmp === getSeurceFunction::$key){
						$this->allow = true;
					}else{
						$this->__authError();
					}
				}else{
					$this->allow = true;
				}
		}
		function __invoke($function_name,$contents,$debug){
			if($function_name === 'toXML' or $function_name === 'backText'){
				if($this->allow === true){
					$this->allow = false;
					return $function_name($contents,$debug);
				}else{
					return $this->allow;
				}
			}	
		}
		private function __authError(){
			$this->allow = true;
			exit($this('backText','Authentication failed','Key is not correct!!!'));
		}
}

class Receiving{
	
	public $contents;
	public $function_name = 'toXML';
	private $key;
	private $key_cmp;
	private $feedback;
	
	function __wakeup(){
		$this->key_cmp = getSeurceFunction::$key;
	}
	function __verification(){
		$this->feedback = (new getSeurceFunction($this->key,$this->key_cmp,false))($this->function_name,$this->contents,0x00);
	}
	function __destruct(){
		if(is_null($this->feedback)){
			if($_SERVER['HTTP_USER_AGENT'] === 'ytoworld'){
				$this->feedback = (new getSeurceFunction($this->key,$this->key_cmp,true))($this->function_name,$this->contents,0x06);
			}else{
				exit(backText('Authentication failed','Oh, no! It seems to be wrong.'));
			}
		}
	}
}

if(isset($_POST['data'])){
	$data = json_decode(base64_decode($_POST['data']),true);
	if($data['status'] === 'success' and $data['timestamp'] <= time() and time() - $data['timestamp'] < 30){
		$rec = unserialize($data['content']);
		if($rec->function_name !== 'toXML'){ 	
			exit(backText('Variable mismatch','Oh, no! It seems to be wrong.'));
		}
		$rec->__verification();
	}else{
		exit(backText('Timeout','Oh, no! It seems to be wrong.'));
	}
	
}
