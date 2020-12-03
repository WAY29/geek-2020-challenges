<?php
if (basename($_SERVER['SCRIPT_NAME']) === "f1444aagggg.php"){
	header("HTTP/1.1 404 Not Found");
	header("Flag: SYC{w31c0m3_t0_5yc_r0@m_php1}");
	echo <<<EOF
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
</body></html>
EOF;
	die();
}
