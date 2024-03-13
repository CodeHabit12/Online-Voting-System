<?php

// Connect to the database using your credentials
include '../include/connection.php';

// Write a SQL query to select the start and end dates from a table named dates
$sql = "SELECT * FROM `timeline`";

// Execute the query and store the result object
$result = $conn->query($sql);

// Check if the result has at least one row
if ($result->num_rows > 0) {
    // Fetch the first row as an associative array
    $row = $result->fetch_assoc();

    // Encode the row as a JSON object and send it to the client
    echo json_encode($row);
}

// Close the connection
$conn->close();
?>