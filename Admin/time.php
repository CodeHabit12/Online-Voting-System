<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time</title>
</head>
<body>
	<?php
	$date=date('2023-04-28');
	$time=date('12:00:00');
	$date_today=$date.' '.$time;
	echo "Showing time till ". $date_today;
	?>
	<script type="text/javascript">
		var count_id="<?php echo $date_today; ?>";
		var countDownDate=new Date(count_id).getTime();
		var x=setInterval(function(){
			var now=new Date().getTime();
			var distance=countDownDate-now;

			var days=Math.floor(distance/(1000*60*60*24));
			var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
			var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
			var seconds=Math.floor((distance%(1000*60))/1000);

			document.getElementById('demo').innerHTML=days + "d " + hours + "h " + minutes + "mins " + seconds + "secs";

			if (distance<0) {
				clearInterval(x);
				document.getElementById('demo').innerHTML="Expired";
			}
		}, 1000);
	</script>
	<p id="demo" style="font-size: 30px; "></p>

</body>
</html>