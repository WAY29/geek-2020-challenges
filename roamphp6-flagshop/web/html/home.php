<?php
error_reporting(0);
session_start();

function re_error($status,$contents){
	die("<script>alert('{$status}\\n{$contents}');history.back()</script>");
}

function show($params){
	header("Content-Type: text/json");
	die(json_encode($params));
}


if(!isset($_SESSION['user'])){
	die("<script>alert('认证失败\\n请先登录！');location.href='index.php'</script>");
}

$path = '/allPe0p1e/';

$_SESSION['money'] = @end(explode('|',file_get_contents($path.$_SESSION['user'])));

if(isset($_POST['buy'])){
	
	$commodity  = strval($_POST['buy']);
	$list = [
		'card' => 10,
		'flag' => 10000000000,
		'azhe' => 1000
	];
	$money = $_SESSION['money'];
	
	
	if($money > $list[$commodity]){
		$_SESSION['money'] -= $list[$commodity];
		
		@file_put_contents($path.$_SESSION['user'],join('|',[$_SESSION['pass'],$_SESSION['money']]));
		
		if($commodity === 'flag'){
			show([
				'result' => 'flag',
				'flag' => '恭喜！ SYC{cross_s1t3_r3q43st_4orgery_1s_44nny}',
				'money' => $_SESSION['money']
			]);
		}else{
			show([
				'result' => 'buy',
				'contents' => [
					'card' => 'ヽ(✿^▽^)ノ 蹭饭体验卡到手咯！',
					'azhe' => '啊这！害怕！泪目了！EGG{@_2h3_zh3_60_5h1_ro4_dan_chon9ji}'
				][$commodity],
				'money' => $_SESSION['money']
			]);
		}
		
		
		
	}else{
		show([
			'result' => 'Error',
			'contents' => 'oh！你的钱不够呢！',
			'money' => $_SESSION['money']
		]);
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
    <title>Longlone矿业公司 - 个人主页</title>
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

<body class="fix-header fix-sidebar card-no-border">
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/user.jpg" alt="user" class="profile-pic m-r-5" /><?=$_SESSION['user'] ?></a>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">主页</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">flag商店</a></li>
                            <li class="breadcrumb-item active">主页</li>
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title"></h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i> ￥1</h2>
                                    <span class="text-muted">今天预计收入</span>
                                </div>
                                <span class="text-info">1%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 1%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title"></h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="ti-arrow-up text-info"></i><span id='money'> ￥<?=$_SESSION['money'] ?> </span></h2>
                                    <span class="text-muted">钱包</span>
                                </div>
                                <span class="text-info">10.01%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
								<h1 style="text-align:center" id="FLAGISHERE"></h1>
                                <h4 class="card-title">收入统计</h4>
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">财富榜</h4>
                                <div class="table-responsive m-t-40" >
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th >头像</th>
												<th >用户名</th>
                                                <th>身份</th>
                                                <th>拥有RMB</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="round"><img src="assets/images/users/longlone.jpg" alt="user" width="50" /></span></td>
                                                <td>
                                                    <h6>Longlone</h6><small class="text-muted">财务部部长</small></td>
                                                <td>财务管理员</td>
                                                <td>￥INF</td>
                                            </tr>
                                            <tr class="active">
                                                <td><span class="round"><img src="assets/images/users/morouu.jpg" alt="user" width="50" /></span></td>
                                                <td>
                                                    <h6>Morouu</h6><small class="text-muted">技术总监</small></td>
                                                <td>高级用户</td>
                                                <td>￥23.9M</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round"><img src="assets/images/users/bai.gif" alt="user" width="50" /></span></td>
                                                <td>
                                                    <h6>白咲花</h6><small class="text-muted">开发者</small></td>
                                                <td>高级用户</td>
                                                <td>￥10.2K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round"><img src="assets/images/users/xing.png" alt="user" width="50" /></span></td>
                                                <td>
                                                    <h6>星野日向</h6><small class="text-muted">前端工程师</small></td>
                                                <td>高级用户</td>
                                                <td>￥1.5K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round"><img src="assets/images/users/dou.jpg" alt="user" width="50" /></span></td>
                                                <td>
                                                    <h6>祢豆子</h6><small class="text-muted">文案策划</small></td>
                                                <td>普通用户</td>
                                                <td>￥0.2</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row" id="things">
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive"  src="assets/images/big/img1.jpg" alt="Card">
                            <div class="card-block">
								<h1 class="font-normal" style="text-align:center"> ￥10 </h1>
								<hr>
                                <h3 class="font-normal" style="text-align:center"><a href="#things" onclick="buy('card')"><span>&lt; 购买 &gt;</span></a>&nbsp;&nbsp;蹭饭体验卡</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive"  src="assets/images/big/img2.jpg" alt="Card">
                            <div class="card-block">
								<h1 class="font-normal" style="text-align:center"> ￥10000M </h1>
								<hr>
                                <h3 class="font-normal" style="text-align:center"><a href="#things" onclick="buy('flag')"><span>&lt; 购买 &gt;</span></a>&nbsp;&nbsp;FLAG</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-responsive"  src="assets/images/big/img3.jpg" alt="Card">
                            <div class="card-block">
								<h1 class="font-normal" style="text-align:center"> ￥1000 </h1>
								<hr>
                                <h3 class="font-normal" style="text-align:center"><a href="#things" onclick="buy('azhe')"><span>&lt; 购买 &gt;</span></a>&nbsp;&nbsp;啊这</h3>
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
	<script src="js/buy.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot-data.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
