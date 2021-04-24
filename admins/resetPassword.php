<?php

include_once '../config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

$id = $_REQUEST['id'];

$stmt = $conn->prepare("UPDATE admin SET Password = :pwd WHERE AdminID = :aid");

$password = password_hash("Password", PASSWORD_DEFAULT);

$stmt->bindValue(':aid', $id, PDO::PARAM_INT);
$stmt->bindValue(':pwd', $password, PDO::PARAM_STR);

$stmt->execute();

if ($stmt) {
	header('Location: ../adminManagement.php', TRUE, 301);
	exit();
}