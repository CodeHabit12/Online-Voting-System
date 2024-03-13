$(document).ready(function(){
	$('#president').on('click', function(){
		$('#presidentDiv').show();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').hide();
	});

	$('#governor').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').show();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').hide();
	});

	$('#senator').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').show();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').hide();
	});

	$('#w_rep').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').show();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').hide();
	});

	$('#mp').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').show();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').hide();
	});

	$('#mca').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').show();
		$('#messages').hide();
		$('#allDiv').hide();
	});
	$('#msgs').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').show();
		$('#allDiv').hide();
	});
	$('#viewAll').on('click', function(){
		$('#presidentDiv').hide();
		$('#governorDiv').hide();
		$('#senatorDiv').hide();
		$('#w_repDiv').hide();
		$('#mpDiv').hide();
		$('#mcaDiv').hide();
		$('#messages').hide();
		$('#allDiv').show();
	});
});