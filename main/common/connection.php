<?php

$servername = "localhost";
$username = "pay-man";
$password = "payman123";
$dbname = "payman";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

?>