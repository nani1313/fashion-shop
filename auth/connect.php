<?php
// connect to database
$servername = "localhost";
$_username = "root";
$_password = "";
$db = "fashion";

// Create connection
$conn = mysqli_connect($servername, $_username, $_password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully!";