// Member of Parliamnet
$(document).ready(function(){
	$('#mp_county').on('change',function(){
		var countyId=$(this).val();
		if (countyId) {
			$.ajax({
				type: 'POST',
				url: './ajaxData.php',
				data: 'county_id='+countyId,
				success: function(html){
					$('#mp_constituency').html(html);
				}
			});
		}else{
			$('#mp_constituency').html('<option value="">Select county first</option>');
			$('#mp_ward').html('<option value="">Select constituency first</option>');
		}
	});
	$('#mp_constituency').on('change', function(){
		var constituencyId = $(this).val();
		if (constituencyId) {
			$.ajax({
				type: 'POST',
				url: './ajaxData.php',
				data: 'constituency_id='+constituencyId,
				success: function(html){
					$('#mp_ward').html(html);
				}
			});
		}else{
			$('#mp_ward').html('<option value="">Select constituency first</option>');
		}
	});
});

// member of county assembly
$(document).ready(function(){
	$('#mca_county').on('change',function(){
		var countyId=$(this).val();
		if (countyId) {
			$.ajax({
				type: 'POST',
				url: './ajaxData.php',
				data: 'county_id='+countyId,
				success: function(html){
					$('#mca_constituency').html(html);
				}
			});
		}else{
			$('#mca_constituency').html('<option value="">Select county first</option>');
			$('#mca_ward').html('<option value="">Select constituency first</option>');
		}
	});
	$('#mca_constituency').on('change', function(){
		var constituencyId = $(this).val();
		if (constituencyId) {
			$.ajax({
				type: 'POST',
				url: './ajaxData.php',
				data: 'constituency_id='+constituencyId,
				success: function(html){
					$('#mca_ward').html(html);
				}
			});
		}else{
			$('#mca_ward').html('<option value="">Select constituency first</option>');
		}
	});
});