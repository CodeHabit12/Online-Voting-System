<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<script type="text/javascript" src="jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript">
		function State(){
			$('#stateId').empty();
			$('#stateId').append("<option>Loading....</option>");
			$('#stateId').append("<option value='0'>--Select county--</option>");

			$.ajax({
				type: "POST",
				url: 'county.php',
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function(data){
					$('#stateId').empty();
					$('#stateId').append("<option value='0'>--Select county--</option>");
					$.each(data, function(i, item){
						$('#stateId').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
					});

				},
				complete: function(){

				}
			});
		}
		function District(sid){
			$('#subcountyId').empty();
			$('#subcountyId').append("<option>--Loading--</option>");

			$.ajax({
				type: "POST",
				url: "subcounty.php?sid="+sid,
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function(data){
					$('#subcountyId').empty();
					$('#subcountyId').append("<option value='0'>--Select sub county--</option>");
					$.each(data, function(i, item){
						$('#subcountyId').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
					});
				},
				complete: function(){

				}
			});
		}
		$(document).ready(function(){
			State();
			$('#stateId').change(function(){
				var stateid=$('#stateId').val();
				District(stateid);
			});
		});
	</script>
</head>
<body>
	<span>Counties</span>
	<select id="stateId"></select>
	<span>Sub-counties</span>
	<select id="subcountyId"></select>

</body>
</html>