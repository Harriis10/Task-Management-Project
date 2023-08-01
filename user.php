<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard - My To-Do List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<input type="hidden" id="loggedin" value="<?php echo $_SESSION['loggedin']; ?>">
	<?php
	session_start();
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	    header("Location: login.html");
	    exit;
	}
	$username = $_SESSION["username"];
	?>
	<p class="welcome-message">Welcome, <span class="username"><?php echo htmlspecialchars($username); ?></span>!</p>
	<div id="buttons">
		<button id="checklist-button"><a href="checklist.html">Checklist</a></button>
		<button id="site-button"><a href="site.html">Site</a></button>
		<button id="about-button"><a href="aboutus.html">About Us</a></button>
		<button id="saved-items-button"><a id="saved-items-link" href="saveditems.html">Saved Items</a></button>
		<button id="logout-button"><a href="logout.php">Logout</a></button>
	</div>
	<div id="container">
		<div id="topbar">
			<h1>User Dashboard - My To-Do List</h1>
		</div>
		<div id="todo-section">
			<input type="text" id="input-field" placeholder="Enter your task here...">
			<button id="add-button">Add Item</button>
			<ul id="list-container"></ul>
		</div>
	</div>

	<?php
		$loggedInJsValue = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] ? 1 : 0;
		echo "<script>const loggedIn = $loggedInJsValue;</script>";
	?>	
	<script src="script.js"></script>
</body>
</html>
