<?php
error_reporting(0);
session_start();

function re_error($status,$contents){
	die("<script>alert('{$status}\\n{$contents}');history.back()</script>");
}
$ip=$_SERVER['REMOTE_ADDR'];
//file_put_contents("test",json_encode(array("addr"=>$ip)));

if(!isset($_SESSION['user']) and "172.20.0.1" !== $ip){
	die("<script>alert('认证失败\\n请先登录！');location.href='index.php'</script>");
}

function transfer($path,$fuser,$tuser,$money){
	
	$fuserinfo = explode('|',file_get_contents($path.$fuser));
	$tuserinfo = explode('|',file_get_contents($path.$tuser));
	
	@file_put_contents($path.$fuser,join('|',[pos($fuserinfo),$_SESSION['money']]));
	@file_put_contents($path.$tuser,join('|',[pos($tuserinfo),strval(intval(end($tuserinfo)) + $money)]));
}

$path = '/allPe0p1e/';

$_SESSION['money'] = @end(explode('|',file_get_contents($path.$_SESSION['user'])));

if(isset($_POST['target']) and isset($_POST['money']) and isset($_POST['messages'])){
	
		$target = strval($_POST['target']);
		$tmoney = intval($_POST['money']);
		if($ip === "172.20.0.1"){
			$tuserinfo = explode('|',file_get_contents($path.$target));
			@file_put_contents($path.$target,join('|',[pos($tuserinfo),strval(intval(end($tuserinfo)) + $tmoney)]));
			exit();
		
		}
		
		if($target == $_SESSION['user']){
			re_error('错误','请不要自娱自乐！');
		}
		
		if($target == '' or $tmoney <= 0 ){
			re_error('错误','对方用户名为空，或转账金额错误！');
		}
		
		
		if(in_array($target,scandir($path))){
			
			if($_SESSION['money'] >= $tmoney){
				
				$_SESSION['money'] -= $tmoney;
				transfer($path,$_SESSION['user'],$target,$tmoney);
				echo "<script>alert('转账成功！\\n对方用户名:   {$target}   \\n转账金额:   {$tmoney}   ');</script>";
				
			}else{	
				re_error('错误','金额不足，无法转账！');
			}
			
		}else{
			re_error('错误','对方用户名不存在！');
		}
		
		
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Longlone矿业公司 - 转账页面</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="home.php">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="pages-profile.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/user.jpg" alt="user" class="profile-pic m-r-5" /><?=$_SESSION['user'] ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="home.php" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>主页</a>
                        </li>
                        <li>
                            <a href="transfer.php" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>转账</a>
                        </li>
                        <li>
                            <a href="report.php" class="waves-effect"><i class="fa fa-table m-r-10" aria-hidden="true"></i>报告</a>
                        </li>
                    </ul>
                    <div class="text-center m-t-30">
                        <a href="logout.php#" class="btn btn-danger">登出</a>
                    </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">转账</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">flag商店</a></li>
                            <li class="breadcrumb-item active">转账</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="report.php#" class="btn pull-right hidden-sm-down btn-success">跳转到报告</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <center class="m-t-30"> <img src="assets/images/users/user.jpg" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10">普通用户 &lt; <?=$_SESSION['user'] ?> &gt;</h4>
                                    <h6 class="card-subtitle">你是一个身份及其普通的用户</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">👍</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">0</font></a></div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form action="" method="post" enctype="multipart/form-data"  class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">对方用户名</label>
                                        <div class="col-md-12">
                                            <input type="text" name="target"  class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">转账金额</label>
                                        <div class="col-md-12">
                                            <input type="text" name="money"  class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">留言</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="messages" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">转账方式</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line">
                                                <option>钱包</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" style="text-align:right">
                                            <input type="submit" class="btn btn-success"  value="转账">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Copyright &copy; 2020.Company name All rights reserved.<a target="_blank" href="#things">💣Longlone</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
