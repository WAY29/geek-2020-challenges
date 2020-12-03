<?php
error_reporting(0);
session_start();

function re_error($status,$contents){
	die("<script>alert('{$status}\\n{$contents}');history.back()</script>");
}


if(isset($_POST['username']) and isset($_POST['password'])){
	
	$path = '/allPe0p1e/';
	
	$user = strval($_POST['username']);
	$pass = strval($_POST['password']);
	
	if($user == '' or $pass == ''){
		re_error('错误','用户名或密码为空！');
	}
	
	if(!in_array($user,scandir($path))){
		re_error('错误',"用户 < {$user} > 不存在！");
	}
	
	$info = explode('|',file_get_contents($path.$user));
	
	if($info[0] === $pass){
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$_SESSION['money'] = intval($info[1]);
		die("<script>alert('登录成功');location.href='home.php'</script>");
	}else{
		re_error('错误','用户名或密码错误！');
	}
	
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Longlone矿业公司 - 账号登录</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/iconfont.css">
    <link rel="stylesheet" href="css/reg.css">
</head>
<body>
<div id="ajax-hook"></div>
<div class="wrap">
    <div class="wpn">
        <div class="form-data pos">
            <div class="change-login">
                <p class="account_number on" style="font-size:30px">账号登录</p>
            </div>
		<form action="" method="post">
            <div class="form1">
                <p class="p-input pos">
                    <label for="num">用户名</label>
                    <input type="text" name="username" id="num">
                </p>
                <p class="p-input pos">
                    <label for="pass">密码</label>
                    <input type="password" name="password" id="pass" autocomplete="new-password">
                </p>
            </div>
            <div class="r-forget cl">
                <a href="reg.php" class="z">账号注册</a>
                <a href="getpass.php" class="y">忘记密码</a>
            </div>
            <button class="lang-btn">登录</button>
		</form>
            <div class="third-party">
                <a href="index.php#" class="log-qq icon-qq-round"></a>
                <a href="index.php#" class="log-qq icon-weixin"></a>
                <a href="index.php#" class="log-qq icon-sina1"></a>
            </div>
            <p class="right">Powered by (c) 2020 💣Longlone</p>
        </div>
			
    </div>
	
</div>

<script src="js/jquery.js"></script>
<script src="js/agree.js"></script>
<script src="js/login.js"></script>
</body>
</html>