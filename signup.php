<?php
session_start();
$servername = "localhost";
$username = "hnaseeb1";
$password = "hnaseeb1";
$dbname = "hnaseeb1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $confirm_pass = $_POST["confirm-password"];

    if ($pass === $confirm_pass) {
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();

        header("Location: login.html");
    } else {
        echo "Passwords do not match.";
    }
}

$conn->close();
?>
