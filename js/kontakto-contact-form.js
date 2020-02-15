$(document).ready(function(e) {
	var formH = $('.col.form').outerHeight();
	$('.col.map').css('height',formH+'px');
	$("#kontakto-form").validate({
	  rules:{
			captchaField:{
				equalTo : "#captchaValue"
			}
	  },
	  submitHandler: function(form) {
		$( "#form-sending" ).removeClass( "hidden" );
		//var formData = new FormData($('#kontakto-form'));
			//data: $('#kontakto-form').serialize(),
		$.ajax({
			type: "POST",
			url: "../phpmyadmin/enviodemail.php",
			data: new FormData(form),
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
			success : function(res){
				if (res == "success"){
					formSuccess();
				}else{
					formError();
				}
			},
			error : function(){
				formError();
			}
		});
		return false;
	  }
	 });
	function formSuccess(){
		$("#kontakto-form").trigger("reset");
		$( "#form-sending" ).addClass( "hidden" );
		$( "#form-success" ).removeClass( "hidden" );
	}
	function formError(){
		$( "#form-sending" ).addClass( "hidden" );
		$( "#form-error" ).removeClass( "hidden" );
	}
	
	function captcha(){
		var $rand_1 = Math.floor((Math.random() * 9) + 1);
		var $rand_2 = Math.floor((Math.random() * 9) + 1);
		var $result = $rand_1 + $rand_2;
		$('span.captcha').html($rand_1+' + '+$rand_2);
		$('input#captchaValue').val($result);
	}
	captcha();
	
	//binds to onchange event of your input field
	$('#file').bind('change', function() {
		var $fileSize = this.files[0].size/1024;
		if($fileSize>10000)
	  		alert((this.files[0].size)/1024);
	
	});
});


