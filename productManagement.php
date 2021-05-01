<?php

include_once 'config/dbconfig.php';

$title = 'COMP208 Foodtracker - Product Management';
$rowIndex = 1;

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	$username = $_SESSION['username'];
} else {
	header('Location: login.php', TRUE, 301);
	exit();
}

include('includes/pageStart.php');

// this is how we get the user data
$userStmt = $conn->prepare("SELECT * FROM user");
$userStmt->execute();

?>