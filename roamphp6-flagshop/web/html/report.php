<?php
error_reporting(0);
session_start();

function re_error($status,$contents){
	die("<script>alert('{$status}\\n{$contents}');history.back()</script>");
}

if(!isset($_SESSION['user'])){
	die("<script>alert('认证失败\\n请先登录！');location.href='index.php'</script>");
}

if(!isset($_SESSION['code'])){
	$_SESSION['code'] = substr(md5(mt_rand().rand()),0,5);
}

if(isset($_POST['thame']) and isset($_POST['contents']) and isset($_POST['code'])){
	
	if(substr(md5($_POST['code']),0,5) === $_SESSION['code']){
		
		$_SESSION['code'] = substr(md5(mt_rand().rand()),0,5);
		
		$data = $_POST['contents'];
		$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))@';
		preg_match_all($regex, $data, $urls);
		file_put_contents("/nobodys3cr3t/".base64_encode($urls[0][0]), "");
		echo "<script>alert('< {$_POST['thame']} > 提交成功！');</script>";
	}else{
		
		re_error('错误','验证码不正确！');
		
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
    <title>Longlone矿业公司 - 报告页面</title>
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="table-basic.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/user.jpg" alt="user" class="profile-pic m-r-5" /><?=$_SESSION['user'] ?></a>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">报告</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">flag商店</a></li>
                            <li class="breadcrumb-item active">报告</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">报告表格</h4>
                                <h6 class="card-subtitle">类型：<code>.反馈报告</code></h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#编号</th>
                                                <th>用户名</th>
                                                <th>主题</th>
                                                <th>反馈时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Longlone</td>
                                                <td>测试：这是一个测试</td>
                                                <td>2020.05.10</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Morouu</td>
                                                <td>BUG：某个功能有邪恶的BUG</td>
                                                <td>2020.05.11</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>星野日向</td>
                                                <td>&lt;回复&gt; BUG：BUG已经修好了</td>
                                                <td>2020.07.01</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>白咲花</td>
                                                <td>投诉：祢豆子工作太自在</td>
                                                <td>2020.07.03</td>
                                            </tr>
											<tr>
                                                <td>5</td>
                                                <td>Longlone</td>
                                                <td>&lt;回复&gt; 投诉：已经从薪水上进行了处理</td>
                                                <td>2020.07.05</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Longlone</td>
                                                <td>安全：账号出现了不明的转账记录</td>
                                                <td>2020.08.02</td>
                                            </tr>
											<tr>
                                                <td>7</td>
                                                <td>Morouu</td>
                                                <td>投诉：Longlone最近不怎么看我报告中的链接了</td>
                                                <td>2020.08.05</td>
                                            </tr>
											<tr>
                                                <td>8</td>
                                                <td>Longlone</td>
                                                <td>&lt;回复&gt; 投诉：我会好好查看你们提交的报告</td>
                                                <td>2020.08.08</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						<div class="card">
                            <div class="card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">报告主题</label>
                                        <div class="col-md-12">
                                            <input type="text" name="thame" placeholder="BUG/投诉/安全" class="form-control form-control-line">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-4">验证码</label>
                                        <div class="col-md-4">
                                            <input type="text" name="code" placeholder="md5($code)[0:5] == <?=$_SESSION['code']?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">报告内容</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="contents" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" style="text-align:right">
                                            <button class="btn btn-success">提交报告</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				
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
