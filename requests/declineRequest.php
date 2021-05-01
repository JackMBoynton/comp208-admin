<?php

include_once '../config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

$id = $_REQUEST['id'];

$stmt = $conn->prepare("DELETE FROM request WHERE RequestNo = :rid");
$stmt->bindValue(':rid', $id, PDO::PARAM_INT);
$stmt->execute();