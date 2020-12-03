<?php
error_reporting(0);
function re_error($status,$contents){
	die("<script>alert('{$status}\\n{$contents}');history.back()</script>");
}


if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['repassword'])){
	
	$path = '/allPe0p1e/';
	
	$user = strval($_POST['username']);
	$pass = strval($_POST['password']);
	$repass = strval($_POST['repassword']);
	
	if($user == '' or $pass == '' or $repass == ''){
		re_error('错误','用户名或密码为空！');
	}
	
	if($pass !== $repass){
		re_error('错误','两次密码不相同！');
	}
	
	foreach([$user,$pass,$repass] as $v){
		if(preg_match('/[^a-zA-Z0-9]/imx',$v)){
			re_error('错误','只允许使用大小写字母以及数字！');
		}
	}
	
	if(in_array($user,scandir($path))){
		re_error('错误',"用户 < {$user} > 已存在！");
	}
	
	file_put_contents($path.$user,join('|',[$pass,'11']));
	
	die("<script>alert('注册成功！\\n用户名:   {$user}   \\n密码:   {$pass}   ');location.href='index.php'</script>");
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Longlone矿业公司 - 账号注册</title>
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
                <p class="account_number on" style="font-size:30px">账号注册</p>
            </div>
                <form action="" method="post">
                    <p class="p-input pos">
                        <label for="tel">用户名</label>
                        <input type="text" name="username" id="tel" autocomplete="off" required>
                        <span class="tel-warn tel-err hide"><em></em><i class="icon-warn"></i></span>
                    </p>
                    <p class="p-input pos" id="pwd">
                        <label for="passport">输入密码</label>
                        <input type="password" name="password" id="passport" required>
                        <span class="tel-warn pwd-err hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                    </p>
                    <p class="p-input pos" id="confirmpwd">
                        <label for="passport2">确认密码</label>
                        <input type="password" name="repassword" id="passport2" required>
                        <span class="tel-warn confirmpwd-err hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                    </p>
                <div class="reg_checkboxline pos">
                    <span class="z"><i class="icon-ok-sign boxcol" nullmsg="请同意!"></i></span>
                    <input type="hidden" name="agree" value="1">
                    <div class="Validform_checktip"></div>
                    <p>我已阅读并接受 <a href="reg.php#">《Longlone矿业有限公司协议》</a></p>
                </div>
                <button class="lang-btn">注册</button>
                <div class="bottom-info">已有账号，<a href="index.php">马上登录</a></div>
			</form>
                <div class="third-party">
                    <a href="reg.php#" class="log-qq icon-qq-round"></a>
                    <a href="reg.php#" class="log-qq icon-weixin"></a>
                    <a href="reg.php#" class="log-qq icon-sina1"></a>
                </div>
                <p class="right">Powered by (c) 2020 💣Longlone</p>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/agree.js"></script>
</body>
</html>
