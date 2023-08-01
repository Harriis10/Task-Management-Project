<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}
header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    echo json_encode([]);
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

$sql = "SELECT t.id, t.task FROM tasks t INNER JOIN user u ON t.user_id = u.id WHERE u.username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["username"]);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $task);

$items = [];

while ($stmt->fetch()) {
    $items[] = [
        'id' => $id,
        'task' => $task
    ];
}

$stmt->close();
$conn->close();

echo json_encode($items);
?>
