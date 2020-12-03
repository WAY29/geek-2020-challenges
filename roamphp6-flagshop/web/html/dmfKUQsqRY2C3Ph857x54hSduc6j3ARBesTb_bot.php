<?php
$a=array();
@exec("ls /nobodys3cr3t", $a);
@$url=pos($a);
@print(base64_decode($url));
?>