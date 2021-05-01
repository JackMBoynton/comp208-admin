<?php

include_once '../config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

$id = $_REQUEST['id'];

// take the request information from the request
$stmt = $conn->prepare("SELECT * FROM request WHERE RequestNo = :rid");
$stmt->bindValue(':rid', $id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch();

// create the new product in the product table with the request information
$createProductStmt = $conn->prepare("INSERT INTO product (Barcode, Name) VALUES (:bcode, :name)");
$createProductStmt->bindValue(':bcode', $row['ProductBarcode'], PDO::PARAM_STR);
$createProductStmt->bindValue(':name', $row['ProductName'], PDO::PARAM_STR);
$status = $createProductStmt->execute();

// then delete the original request as it's been dealt with
$deleteReqStmt = $conn->prepare("DELETE FROM request WHERE RequestNo = :rid");
$deleteReqStmt->bindValue(':rid', $id, PDO::PARAM_INT);
$deleteReqStmt->execute();