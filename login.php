<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

    $sql = "SELECT id, username, password FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $stored_pass);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if ($pass === $stored_pass) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $id; // Store user ID in the session
            $_SESSION["username"] = $username;
            header("Location: user.php");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}

$conn->close();
?>
