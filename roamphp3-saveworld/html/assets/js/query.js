
function feedback() { 

	var form = new FormData();
	form.append("name",$("#name").val());
	form.append("email",$("#email").val());
	form.append("questions",$("#subject").val());
	form.append("messages",$("#message").val());
	$.ajax({
		url:'./index.php',
		type:'POST',
		data:form,
		contentType: false,
		processData: false,
		success:function(resp){
			if(resp.status == 'success'){
				var json = {data:resp.content};
				$.post("./feedback.php",
				json,function(data,status){
					if(status == 'success'){
							$("#message").val(data.status + "\n" + data.contents);
					}
				});
			}
		}
	})
	
}