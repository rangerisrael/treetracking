<?php
date_default_timezone_set("Asia/Manila");
$date_time = date('Y-m-d h:i:s');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "treetracking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
