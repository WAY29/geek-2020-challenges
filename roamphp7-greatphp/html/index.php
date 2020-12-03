<?php
error_reporting(0);
class SYCLOVER {
	public $syc;
	public $lover;

	public function __wakeup(){
		if( ($this->syc != $this->lover) && (md5($this->syc) === md5($this->lover)) && (sha1($this->syc)=== sha1($this->lover)) ){
		   if(!preg_match("/\<\?php|\(|\)|\"|\'/", $this->syc, $match)){
			   eval($this->syc);
		   } else {
			   die("Try Hard !!");
		   }
		   
		}
	}
}

if (isset($_GET['great'])){
	unserialize($_GET['great']);
} else {
	highlight_file(__FILE__);
}

?>
