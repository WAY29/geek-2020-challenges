<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>欢迎登录</h1>
                  </div>
                  <p>—— 博客后台 ——</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" action="/?page=admin/user" class="form-validate" id="loginFrom">
                    <div class="form-group">
                      <input id="login-username" type="text" name="username" required data-msg="请输入用户名" placeholder="用户名" class="input-material">
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" required data-msg="请输入密码" placeholder="密码" class="input-material">
                    </div>
                    <button id="login" type="submit" class="btn btn-primary">登录</button>
                    <div style="margin-top: -40px;"> 
                    	<!-- <input type="checkbox"  id="check1"/>&nbsp;<span>记住密码</span>
                    	<input type="checkbox" id="check2"/>&nbsp;<span>自动登录</span> -->
                    	<div class="custom-control custom-checkbox " style="float: right;">
											    <input type="checkbox" class="custom-control-input" id="check2" >
											    <label class="custom-control-label" for="check2">自动登录</label>
											</div>
											<div class="custom-control custom-checkbox " style="float: right;">
											    <input type="checkbox" class="custom-control-input" id="check1" >
											    <label class="custom-control-label" for="check1">记住密码&nbsp;&nbsp;</label>
											</div> 
                    </div>
                  </form>
                  <br />
                  <small>没有账号?</small><a href="#" class="signup">&nbsp;不给注册</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/bootstrap.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script><!--表单验证-->
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>

<?php
require_once("secret.php");
mt_srand($secret_seed);
$_SESSION['password'] = mt_rand();
?>
