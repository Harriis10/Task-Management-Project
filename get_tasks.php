<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("Location: login.html");
    exit;
}

$servername = "localhost";
$username = "hnaseeb1";
$password = "hnaseeb1";
$dbname = "hnaseeb1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT task FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($task);

$tasks = array();

while ($stmt->fetch()) {
    $tasks[] = $task;
}

header('Content-Type: application/json');
echo json_encode($tasks);

$stmt->close();
$conn->close();
?>
