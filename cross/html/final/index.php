<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>倒计时</title>
</head>
<body onload="">
    <form name="form1"> 
        <div align="center" align="center"> 
        <center>
        <p style="color:#FFFFFF" id="text" >距离被逮捕(上传文件被删除)还有至多:</p>
        <input type="textarea" name="left" id="left" size="35" style="text-align: center"> 
			<div style="margin-top:3.5%">
				<img style="border-radius: 50%" src='0.gif' >
			</div>
        </center> 
        </div> 
        </form> 
        <script LANGUAGE="javascript"> 
        var timer = null; 
        var Temp = "";
        var Second = 300;
        function showtime() {
            Second -= 1;
            if (Second == 0){
                window.clearInterval(timer);
                var leftObject = document.getElementById('left');
                if (leftObject != null)
                    leftObject.parentNode.removeChild(leftObject);
                var textObject = document.getElementById('text');
                if (textObject != null)
                    textObject.parentNode.removeChild(textObject);
                document.location.href = "fail.jpeg";
                return;
            }
            Temp=Second + '秒';
            document.form1.left.value=Temp;
        }
        timer = setInterval("showtime()",1000); 
        </script> 
        <style type="text/css">
            body {
            background-color: black;
        }
        </style>
        <audio id="muisc" autoplay="autoplay" loop="loop">
            <source src="warning.mp3" type="audio/mpeg" />
          Your browser does not support the audio element.
          </audio>
</body>
</html>