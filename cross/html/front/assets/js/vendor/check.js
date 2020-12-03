/*
//
// created by Morouu
// 
*/
function getDate_(date){
	
	var year=date.getFullYear(); 
    var month=date.getMonth()+1;  
    var day=date.getDate();  
    var hours=date.getHours();   
    var minutes=date.getMinutes();   
    var seconds=date.getSeconds();  
	
	return year + '_' + month + '_' + day + '_' + hours + '_' + minutes + '_' + seconds
}

function getRandomchars(n){
	var str="",
		font = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']; 
	for(var i=0;i<n;i++){
		str += font[Math.round(Math.random()*(font.length-1))]
	}
	return str;
}

function getRandom(){
	var json={
		get_code:true,
		length:300
	}
	$.post("./index.php",
	json,function(data,status){
		if(status == 'success'){
			result=data;
			if(result.result != 'request failed'){
				content = result.content;
				if(content != "" ){
					var e = document.createElement('a');
					e.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
					e.setAttribute('download', getDate_(new Date()) + '.txt');
					document.getElementById('get').appendChild(e);
					e.click();	
					document.getElementById('get').removeChild(e);
				}
			}
		}
	});
}

function check() { 
	var form = new FormData();
	var timestamp = new Date().getTime();
	form.append("token",getRandomchars(128));
	form.append("rand",$("#random").val());
	form.append("timestamp",timestamp);
	$.ajax({
		url:'./index.php',
		type:'POST',
		data:form,
		contentType: false,
		processData: false,
		success:function(resp){
			if(resp.status != '' && resp.content != ''){
				alert(resp.content);
			}
		}
	})
	
}

