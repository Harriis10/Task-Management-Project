<?php
$servername = "localhost";
$username = "hnaseeb1";
$password = "hnaseeb1";
$dbname = "hnaseeb1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
