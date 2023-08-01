<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "hnaseeb1";
    $password = "hnaseeb1";
    $dbname = "hnaseeb1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION["user_id"];
    $task = $_POST["task"];

    $sql = "INSERT INTO tasks (user_id, task) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();

    echo "Task saved.";

    $stmt->close();
    $conn->close();
}
?>
