

function buy(commodity){
	$.post("./home.php",{buy:commodity},function(data,status){
		if(status == 'success'){
			if(data.result == 'flag'){
				$("#FLAGISHERE").text(data.flag);
				console.log(data.flag);
				alert(data.flag);
			}else{
				alert(data.contents);	
			}
			$("#money").text("￥" + data.money);
		}
	});
}