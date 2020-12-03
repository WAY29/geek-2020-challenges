<?php
session_start();
if(!isset($_SESSION['seed']) or intval($_SESSION['seed']) < 0){
	$min = mt_rand();
	$_SESSION['seed'] = mt_rand($min,$min+rand());
}
if(isset($_POST['rand'])){
	$answer = intval($_POST['rand']);
	if(isset($_SESSION['R301']) and intval($_SESSION['R301']) === $answer){
		$_SESSION['correct'] = true;
		$status = 'success';
		$content = "答案正确!你通过这个游戏赚到了许多$$,并且收买了狱警,你现在可以访问:/admin/index.php";
	}else{
		$status = 'failed';
		$content = "答案错误,再猜一猜吧";
	}
	header("Content-Type: text/json");
		die(json_encode(
			array(
                'status' => $status,
                'content' => $content
            )
        ));
}
if(isset($_POST['get_code']) and isset($_POST['length'])){
	$length = intval($_POST['length']);
	if($length < 1 or $length > 300){
		$result = 'request failed';
		$content = '';
	}
	if(!isset($result)){
		mt_srand($_SESSION['seed']);
		$rands=array();
		for($i=0;$i<300;$i++){
			$r = mt_rand();
			if($i < $length){
				array_push($rands,$r);
			}
		}
		$_SESSION['R301'] = mt_rand();
		$min = mt_rand();
		$_SESSION['seed'] = mt_rand($min,$min+rand());
		
		$result = 'success';
		$content = join("\x20",$rands);
	}
	
	header("Content-Type: text/json");
	die(json_encode(
			array(
                'result' => $result,
                'content' => $content
            )
        ));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>双流监狱</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="HTML5 website template">
  <meta name="keywords" content="global, template, html, sass, jquery">
  <meta name="author" content="Bucky Maler">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- notification for small viewports and landscape oriented smartphones -->
<div class="device-notification">
  <a class="device-notification--logo" href="#0">
    <img src="assets/img/logo.jpg" alt="双流监狱">
    <p>双流监狱</p>
  </a>
  <p class="device-notification--message">你的屏幕放不下双流监狱的页面了嗷！</p>
</div>

<div class="perspective effect-rotate-left">
  <div class="container"><div class="outer-nav--return"></div>
    <div id="viewport" class="l-viewport">
      <div class="l-wrapper">
        <header class="header">
          <a class="header--logo" href="#0">
            <img style="height:20%;width:20%" src="assets/img/logo.jpg" alt="双流监狱">
            <p>双流监狱</p>
          </a>
          <button class="header--cta cta">需求</button>
          <div class="header--nav-toggle">
            <span></span>
          </div>
        </header>
        <nav class="l-side-nav">
          <ul class="side-nav">
            <li class="is-active"><span>我是谁</span></li>
            <li><span>犯罪过程</span></li>
            <li><span>游戏</span></li>
            <li><span>位置</span></li>
            <li><span>需求</span></li>
          </ul>
        </nav>
        <ul class="l-main-content main-content">
          <li class="l-section section section--is-active">
            <div class="intro">
              <div class="intro--banner">
                <h1>啊这，<br>我怎么<br>进来了</h1>
                <button class="cta">需求
                  
                  <span class="btn-background"></span>
                </button>
                <img src="assets/img/me.jpg" style="height:90%;width:75%" alt="No!">
              </div>
              <div class="intro--options">
                <a href="#0">
                  <h3>我的身份是啥</h3>
                  <p>东京小学5年级学生</p>
                </a>
                <a href="#0">
                  <h3>我的名字是啥</h3>
                  <p>野比大壮</p>
                </a>
                <a href="#0">
                  <h3>我要怎么出去</h3>
                  <p>玩游戏</p>
                </a>
              </div>
            </div>
          </li>
          <li class="l-section section">
            <div class="work">
              <h2>静香家 - 抢劫任务</h2>
              <div class="work--lockup">
                <ul class="slider">
                  <li class="slider--item slider--item-left">
                    <a href="#0">
                      <div class="slider--item-image">
                        <img src="assets/img/1.jpg" alt="准备任务">
                      </div>
                      <p class="slider--item-title">准备任务</p>
                      <p class="slider--item-description">静香家侦察：180W钢琴</br>抢劫对策：隐秘行踪</br>扒手：大雄 (40%分红)</br>望风兼车手：出木杉 (40%分红)</br>买家洗钱费用：20%</p>
                    </a>
                  </li>
                  <li class="slider--item slider--item-center">
                    <a href="#0">
                      <div class="slider--item-image">
                        <img src="assets/img/2.png" alt="开始抢劫">
                      </div>
                      <p class="slider--item-title">开始抢劫</p>
                      <p class="slider--item-description">大雄卡钢琴失败，惊动了静香！</br>大雄：出木衫help！</br>出木衫：溜了~</p>
                    </a>
                  </li>
                  <li class="slider--item slider--item-right">
                    <a href="#0">
                      <div class="slider--item-image">
                        <img src="assets/img/3.jpg" alt="消星失败">
                      </div>
                      <p class="slider--item-title">消星失败</p>
                      <p class="slider--item-description">大雄：不会吧不会吧，就这？怎么就5星了？</br> 小夫：芜湖，他急了他急了！</p>
                    </a>
                  </li>
                </ul>
                <div class="slider--prev">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                  viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                  <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                    <path d="M561,1169C525,1155,10,640,3,612c-3-13,1-36,8-52c8-15,134-145,281-289C527,41,562,10,590,10c22,0,41,9,61,29
                    c55,55,49,64-163,278L296,510h575c564,0,576,0,597,20c46,43,37,109-18,137c-19,10-159,13-590,13l-565,1l182,180
                    c101,99,187,188,193,199c16,30,12,57-12,84C631,1174,595,1183,561,1169z"/>
                  </g>
                  </svg>
                </div>
                <div class="slider--next">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                  <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                    <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z"/>
                  </g>
                  </svg>
                </div>
              </div>
            </div>
          </li>
          <li class="l-section section">
            <div class="about">

              <div class="about--banner">
			 
                <h2>游戏</h2>
				<h3>游戏规则：</h3>
				<p>1. 点击摇奖按钮 </p>
				<p>2. 得到300个随机数 </p>
				<p>3. 所得到的随机数预测第301个数会是什么 </p>
				<p>预测正确： 获得奖励 </p>
				<p>预测错误： 没有奖励</p>
                <a href="#0" onclick="getRandom();">
                  <span>
				  <p style="font-size:larger" id="get">摇奖
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                    <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                      <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z"/>
                    </g>
                    </svg>
                  </span>
                </a>
              </div>
			  <form class="work-request">
			  <div class="work-request--information">
                  <div class="information-name">
                    <input id="random" type="text"spellcheck="false">
                    <label for="random">请输入第301个随机数</label>
                  </div>
                </div>
				<input type="submit" value="提交答案" onclick="check();">
			</form>
            </div>
          </li>
          <li class="l-section section">
            <div class="intro">
              <div class="intro--banner">
                <img src="assets/img/locate.jpg" style="height:90%;width:105%" alt="No!">
              </div>
            </div>
          </li>
          <li class="l-section section">
            <div class="hire">
              <h2>你想要做什么</h2>
              <!-- checkout formspree.io for easy form setup -->
              <form class="work-request">
                <div class="work-request--options">
                  <span class="options-a">
                    <input id="opt-1" type="checkbox" value="app design">
                    <label for="opt-1">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                      <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                        <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                      </g>
                      </svg>
                      吃饭睡觉打豆豆
                    </label>
                    <input id="opt-2" type="checkbox" value="graphic design">
                    <label for="opt-2">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                      <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                        <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                      </g>
                      </svg>
                      搞点社工
                    </label>
                    <input id="opt-3" type="checkbox" value="motion design">
                    <label for="opt-3">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                      <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                        <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                      </g>
                      </svg>
                      黑刘壮
                    </label>
                  </span>
                
                </div>
                <div class="work-request--information">
                  <div class="information-name">
                    <input id="name" type="text" spellcheck="false">
                    <label for="name">姓名</label>
                  </div>
                  <div class="information-email">
                    <input id="sex" type="text" spellcheck="false">
                    <label for="sex">性别</label>
                  </div>
                </div>
                <input type="submit" value="不给有需求">
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <ul class="outer-nav">
    <li class="is-active">我是谁</li>
    <li>犯罪过程</li>
    <li>游戏</li>
    <li>位置</li>
    <li>需求</li>
  </ul>
</div>

<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/functions-min.js"></script>
<script src="assets/js/vendor/check.js"></script>

</body>
</html>


