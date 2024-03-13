$(document).ready(function(){
	$('#idno-error').hide();
	$('#pass-error').hide();
	$('#idno').keyup(function(){
		validateId();
	});
	$('#password').keyup(function(){
		validatePass();
	});
	function validateId(){
		var id=$('#idno').val();
		if (id.length='') {
			$('#idno-error').show();
			return false;
		}else if(id.length<8){
			$('#idno-error').show();
			$('#idno-error').html('Identity number too short');
			return false;
		}else{
			$('#idno-error').hide();
		}
	}
	function validatePass(){
		var pass=$('#password').val();
		if (pass.length='') {
			$('#pass-error').show();
			return false;
		}else if(pass.length<4){
			$('#pass-error').show();
			$('#pass-error').html('Password too short');
			return false;
		}else{
			$('#pass-error').hide();
		}
	}

})