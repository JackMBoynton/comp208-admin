<?php

include_once '../config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

$id = $_REQUEST['id'];

$stmt = $conn->prepare("DELETE FROM product WHERE ProductNo = :pid");
$stmt->bindValue(':pid', $id, PDO::PARAM_INT);
$stmt->execute();