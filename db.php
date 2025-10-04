<?php
$servername = "localhost";
$username = "root";   // or your DB username
$password = "";       // your DB password
$dbname = "green_Wellness";  // replace with your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


