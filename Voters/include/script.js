$(document).ready(function(){
	$('#county').on('change',function(){
		var countyId=$(this).val();
		if (countyId) {
			$.ajax({
				type: 'POST',
				url: './functions.php',
				data: 'county_id='+countyId,
				success: function(html){
					$('#constituency').html(html);
				}
			});
		}else{
			$('#constituency').html('<option value="">Select county first</option>');
			$('#ward').html('<option value="">Select constituency first</option>');
		}
	});
	$('#constituency').on('change', function(){
		var constituencyId = $(this).val();
		if (constituencyId) {
			$.ajax({
				type: 'POST',
				url: './functions.php',
				data: 'constituency_id='+constituencyId,
				success: function(html){
					$('#ward').html(html);
				}
			});
		}else{
			$('#ward').html('<option value="">Select constituency first</option>');
		}
	});
});