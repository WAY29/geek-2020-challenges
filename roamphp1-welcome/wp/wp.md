# welcome 官方wp

进门一个405状态码,网上搜一下或者抓包发现是Method Not Allowed,尝试抓包使用POST请求方式提交,拿到源码

```php
<?php
error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
header("HTTP/1.1 405 Method Not Allowed");
exit();
} else {
	
	if (!isset($_POST['roam1']) || !isset($_POST['roam2'])){
		show_source(__FILE__);
	}
	else if ($_POST['roam1'] !== $_POST['roam2'] && sha1($_POST['roam1']) === sha1($_POST['roam2'])){
		phpinfo();  // collect information from phpinfo!
	}
}
```

发现需要提交roam1和roam2并且不能相等,但sha1值要相等.这里使用数组绕过,提交`roam1[]=1&roam2[]=2`绕过,

提交后拿到phpinfo,仔细寻找发现`auto_prepend_file = /var/www/html/f1444aagggg.php`,尝试直接抓包访问,在header中拿到flag