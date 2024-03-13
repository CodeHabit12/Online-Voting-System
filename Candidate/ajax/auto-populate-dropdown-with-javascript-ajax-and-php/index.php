<?php 
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>How to Auto populate Dropdown with JavaScript AJAX and PHP</title>
</head>
<body>
	<?php
	// Fetch countries
	$sql = "SELECT * from countries order by name";
    $stmt = $con->prepare($sql); 
    $stmt->execute();
    $result = $stmt->get_result();

	?>
	<table>
	   <tr>
	      <td>Country</td>
	      <td>
	         <select id="country" onchange="getStates(this.value);">
	            <option value="0" >– Select Country –</option>
	            <?php
	            while ($row = $result->fetch_assoc() ){

	               $id = $row['id'];
	               $name = $row['name'];

	               echo "<option value='".$id."' >".$name."</option>";
	            }
	            ?>
	         </select>
	      </td>
	   </tr>

	   <tr>
	      <td>State</td>
	      <td>
	         <select id="state" onchange="getCities(this.value);" >
	            <option value="0" >– Select State –</option>
	         </select>
	      </td>
	   </tr>

	   <tr>
	      <td>City</td>
	      <td>
	         <select id="city" >
	            <option value="0" >– Select City –</option>
	         </select>
	      </td>
	   </tr>
	</table>

	<script type="text/javascript">
		
		function getStates(country_id){
			
			// Empty the dropdown
			var stateel = document.getElementById('state');
			var cityel = document.getElementById('city');
			
			stateel.innerHTML = "";
			cityel.innerHTML = "";

			var stateopt = document.createElement('option');
			stateopt.value = 0;
			stateopt.innerHTML = '-- Select State --';
			stateel.appendChild(stateopt);

			var cityopt = document.createElement('option');
			cityopt.value = 0;
			cityopt.innerHTML = '-- Select City --';
			cityel.appendChild(cityopt);

		    // AJAX request
		    var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "ajaxfile.php", true); 
			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.onreadystatechange = function() {
			   	if (this.readyState == 4 && this.status == 200) {
			     	// Response
			     	var response = JSON.parse(this.responseText);
			     	
			     	var len = 0;
		            if(response != null){
		               len = response.length;
		            }
		           
		            if(len > 0){
		               	// Read data and create <option >
		               	for(var i=0; i<len; i++){

		                  	var id = response[i].id;
		                  	var name = response[i].name;

		                  	// Add option to state dropdown
		                  	var opt = document.createElement('option');
						    opt.value = id;
						    opt.innerHTML = name;
						    stateel.appendChild(opt);

		               	}
		            }
			   	}
			};
			var data = {request:'getStates',country_id: country_id};
			xhttp.send(JSON.stringify(data));
		    
		}

		function getCities(state_id){

			// Empty the dropdown
			var cityel = document.getElementById('city');
			
			cityel.innerHTML = "";

			var cityopt = document.createElement('option');
			cityopt.value = 0;
			cityopt.innerHTML = '-- Select City --';
			cityel.appendChild(cityopt);

		    // AJAX request
		    var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "ajaxfile.php", true); 
			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.onreadystatechange = function() {
			   	if (this.readyState == 4 && this.status == 200) {
			     	// Response
			     	var response = JSON.parse(this.responseText);
			     	
			     	var len = 0;
		            if(response != null){
		               len = response.length;
		            }
		           
		            if(len > 0){
		               	// Read data and create <option >
		               	for(var i=0; i<len; i++){

		                  	var id = response[i].id;
		                  	var name = response[i].name;

		                  	// Add option to city dropdown
		                  	var opt = document.createElement('option');
						    opt.value = id;
						    opt.innerHTML = name;
						    cityel.appendChild(opt);

		               	}
		            }
			   	}
			};
			var data = {request:'getCities',state_id: state_id};
			xhttp.send(JSON.stringify(data));
		}
	</script>
</body>
</html>