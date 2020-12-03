<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['code'])){
	$_SESSION['code'] = substr(md5(mt_rand().sha1(mt_rand)),0,5);
}

if(isset($_POST['cmd']) and isset($_POST['code'])){
	
	if(substr(md5($_POST['code']),0,5) !== $_SESSION['code']){
		die('<script>alert(\'Captcha error~\');history.back()</script>');
	}
	$_SESSION['code'] = substr(md5(mt_rand().sha1(mt_rand)),0,5);
	$code = $_POST['cmd'];
	if(strlen($code) > 70 or preg_match('/[A-Za-z0-9]|\'|"|`|\ |,|\.|-|\+|=|\/|\\|<|>|\$|\?|\^|&|\|/ixm',$code)){
		die('<script>alert(\'Longlone not like you~\');history.back()</script>');
	}else if(';' === preg_replace('/[^\s\(\)]+?\((?R)?\)/', '', $code)){
		@eval($code);
		die();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Do you know vim swp? -->
<head>
    <meta charset="UTF-8">
    <title>RceMe(●'◡'●)</title>
    <link rel="stylesheet" href="css/index.css">
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<script>

    $(document).ready(function () {
        var whei = $(window).width()
        $("html").css({ fontSize: whei / 24 });
        $(window).resize(function () {
            var whei = $(window).width();
            $("html").css({ fontSize: whei / 24 })
        });
    });
</script>
<div class="main">
    <div class="header">
        <div class="header-center fl">
            <div class="header-title">
                命令执行界面
            </div>
            <div class="header-img"></div>
        </div>
        <div class="header-bottom fl"></div>
    </div>
    <img src="ZWdn.png" border="0" style="display:none;"/>
    <div class="content">
        <div class="content-left">
        </div>
		<form action="" method="post">
        <div class="content-right">
            <div class="right-infp">
                <div class="right-infp-name">

                    <input type="text" name="cmd" placeholder="执行的命令" maxlength="65" required="" value="" autocomplete="off">
                </div>
                <div class="right-infp-name">
                    <input type="text" name="code" placeholder="if:substr(md5($code),0,5)==<?=$_SESSION['code'] ?>" autocomplete="off">
                </div>

                <div class="right-infp-btn">
                    <button class="btn">执行</button>
                </div>
            </div>
        </div>
		</form>
    </div>
</div>
</body>
</html>