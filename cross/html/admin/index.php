<?php
session_start();
if(!isset($_SESSION['correct']) || $_SESSION['correct'] !== true){
	header('HTTP/1.1 403 Forbidden');
	die();
}
if (!isset($_COOKIE['Username'])){
	setcookie('Username','a2tkMWxvbmc=');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">

    <script type="text/javascript" src="js/rem.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>双流监狱平台</title>
</head>

<body style="visibility: hidden;">
    <div class="container-flex" tabindex="0" hidefocus="true">
        <div class="box-left">
            <div class="left-top">
                <div class="current-num">
                    <div>当前比对数据</div>
                    <p>3,456,789</p>
                </div>
            </div>
            <div class="left-center">
                <div class="title-box">
                    <h6>违法犯罪人员分析</h6>
                </div>
                <div class="chart-box pie-chart" style="">
                    <div id="pie_fanzui" style="width:100%;"></div>
                    
                </div>
            </div>
            <div class="left-bottom" class="select">
                <div class="title-box">
                    <h6>人口出入记录</h6>
                    
                </div>
                <div class="chart-box">
                    <table class="table3">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>角色</th>
                            <th>开门方式</th>
                            <th>时间</th>
                        </tr>
                    </thead>
                    <tbody id="tList">
<!--<tr><td colspan="4"><p style="width:9.6rem;">暂无数据</p></td></tr>-->
                 
                   <tr>
                       <td>刘壮</td>
                       <td>狱长</td>
                       <td>人脸</td>
                       <td>2018-11-01 13:51:23</td>
                   </tr>
                   <tr>
                       <td>刘滔</td>
                       <td>囚犯</td>
                       <td>指纹</td>
                       <td>2018-11-01 13:51:23</td>
                   </tr>
                   <tr>
                        <td>x1hy9(当值)</td>
                       <td>狱警</td>
                       <td>人脸</td>
                       <td>2018-11-01 13:51:23</td>
                   </tr>
                   <tr>
                       <td>吴世隆</td>
                       <td>囚犯</td>
                       <td>虹膜</td>
                       <td>2018-11-01 13:51:23</td>
                   </tr>
                  
                    </tbody>
                </table>
                
                </div>
            </div>
        </div>
        <div class="box-center">
            <div class="center-top">
                <h1><img src="images/jinghui.png" style="width:55px;margin-right:20px;"/>双流监狱平台</h1>
            </div>
            <div class="center-center">
                <div class="weather-box">
                    <div class="data">
                        <p class="time" id="time">00:00:00</p>
                        <p id="date"></p>
                    </div>
                    <div class="weather">
                        <img id="weatherImg" src="images/weather/weather_img01.png" alt="">
                        <div id="weather">
                            <p class="active">多云</p>
                            <p>16-22℃</p>
                            <p>成都市双流区</p>
                        </div>
                    </div>
                </div>
                <img src="images/line_bg.png" alt="">
                <div class="select-box" style="height: 0.3rem;">
                    
                    <div data-type="2">
                        <div class="select" tabindex="0" hidefocus="true" >
                           <p style="color:#FFFF00;font-weight:bold;">NO.1双~流大学：71人</p>
                           <p style="color:#7FFF00;font-weight:bold;">NO.2☘犯罪实验室：58人</p>
                           <p style="color:#7FFFD4;font-weight:bold;">NO.3四桶饭团伙: 34人</p>
                        </div>

                        
                        
                    </div>
                </div>
            </div>
            <div class="center-bottom">
                <div class="chart-box">
                    <div id="china_map" style="width:100%;height:95%;"></div>
                </div>
                
            </div>

        </div>
        <div class="box-right">
            <div class="right-top">
                <div class="title-box">
                    <h6 id="barTitle">违法犯罪人员年龄分布</h6>
                    
                </div>
                <p class="unit">单位：18岁</p>
                <div class="chart-box">
                    <div id="pie_age" style="width:100%;height:100%;"></div>
                </div>
                
            </div>
            <div class="right-center">
            	
                <div class="title-box">
                    <h6>违法犯罪人员地区分布</h6>
                </div>
                <div class="chart-box pie-chart">
                    
                    <div id="qufenbu_data"style="width:90%;height:120px;margin-left:10px;"></div>
                    
                </div>
            </div>
            <div class="right-bottom">
                <div class="title-box">
                	<p id="switchBtn"><a href="daily.txt"><span class="active" data-dataType="income">值班表(点我查看)</span></a></p>
                    
                </div>
                <div id="line_time" style="width:90%;height:160px;margin-left:10px;"></div>
                
            </div>
        </div>
    </div>

    
</body>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/layer/layer.min.js"></script>
<script type="text/javascript" src="js/layer/laydate/laydate.js"></script>
<script type="text/javascript" src="js/echarts.min.js"></script>
<script type="text/javascript" src="js/china.js"></script>
<script type="text/javascript" src="js/infographic.js"></script>
<script type="text/javascript" src="js/macarons.js"></script>
<script type="text/javascript" src="js/shine.js"></script>
<script type="text/javascript" src="js/base.js"></script>

<script type="text/javascript">
    $('document').ready(function () {
        $("body").css('visibility', 'visible');
        var localData = [$('#teacher').val(), $('#start').val() + '/' + $('#end').val(), $('#leader').val()]
        localStorage.setItem("data", localData);
        
    })
</script>



</html>