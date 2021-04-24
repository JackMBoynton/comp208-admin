<?php

include_once '../config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

$id = $_REQUEST['id'];

$stmt = $conn->prepare("DELETE FROM user WHERE UserID = :uid");
$stmt->bindValue(':uid', $id, PDO::PARAM_INT);
$stmt->execute();