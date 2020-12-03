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