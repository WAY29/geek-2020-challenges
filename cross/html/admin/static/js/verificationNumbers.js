
  //上传      
function validate () {
	
	var form = new FormData();
	form.append('name',$("#name").val());
	form.append("file",$("#file")[0].files[0]);
	$.ajax({
		
		url:'./upload.php',
		type:'POST',
		data:form,
		contentType: false,
		processData: false,
		
		success:function(resp){
				
				alert(JSON.stringify(resp));
				if(resp.status == 'success'){
					var e = document.createElement('a');
					e.setAttribute('href', '../final/index.php');
					document.body.appendChild(e);
					e.click();	
					document.body.removeChild(e);
				}
		
		}
	})
	

}