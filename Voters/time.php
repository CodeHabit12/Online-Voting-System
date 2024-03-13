<div id="countdown" class="countdown">
  <p style="font-size: 40px" id="timer"></p>
</div>

<script>
  // Get the timer element
  var timer = document.getElementById("timer");

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Send a GET request to the server to fetch the dates from the database
  xhr.open("GET", "get_dates.php", true);
  xhr.send();

  // Handle the response from the server
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Parse the JSON response from the server
      var data = JSON.parse(this.responseText);

      // Check if there are dates in the response
      if (data.startDate && data.endDate) {
        // Convert the dates to milliseconds
        var y = new Date(data.startDate).getTime();
        var z = new Date(data.endDate).getTime();

        // Update the timer every second
        var interval = setInterval(function() {
          // Get the current time in milliseconds
          var now = new Date().getTime();

          // Calculate the remaining time between now and z
          var remaining = z - now;

          // If the remaining time is positive, display it in hh:mm:ss format
          if (remaining > 0) {
            // Calculate the hours, minutes and seconds
            var hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remaining % (1000 * 60)) / 1000);

            // Add leading zeros if needed
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            // Display the timer
            timer.innerHTML = hours + ":" + minutes + ":" + seconds;
          }
          // If the remaining time is zero or negative, display another message and clear the interval
          else {
            timer.innerHTML = "Voting Period";
            clearInterval(interval);
          }
        }, 1000);
      }
    }
  };
</script>