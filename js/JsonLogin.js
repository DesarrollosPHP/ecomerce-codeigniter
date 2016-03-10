$(document).ready(function(){
	//Guardamos Formulario
	$("#email").focus();
	$("form#loginform").submit(function()
	{ 
		var Mail  = $('input#validamail').val();
		if(Mail=="1"){
				$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Correo es Incorrecto</div>");
				$("#email").focus();
				return false;
		}else{
			var Login 		 = new Object();
			Login.UserName   = $('input#email').val();
			Login.Password   = $('input#password').val();
			$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Iniciando Sessión...</center></div></div>");
			var DatosJson = JSON.stringify(Login);
			$.post(baseurl + 'login/ValidaAcceso',
			{ 
				LoginPost: DatosJson
			},
			function(data, textStatus) { 
				$("#"+data.campo+"").focus();
				$("#mensaje").html(data.error_msg);
			}, 
			"json"		
			);
			return false;
		}
	}); 

});