<?php

include_once '../config/dbconfig.php';

session_start();

$title = 'COMP208 Foodtracker - Product Edit';

$db = new dbconfig();
$conn = $db->getConnection();

$error = '';

// if isset $_SESSION['loggedIn'] and it also equals true, redirect to index.php else, see comment below
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	
	// initial load
	if (isset($_POST['name']) && !empty($_POST['name'])) {

		if (isset($_POST['barcode']) && !empty($_POST['barcode'])) {

			$updateStmt = $conn->prepare("UPDATE product SET Barcode = :barcode, Name = :name WHERE ProductNo = :pid");
			$updateStmt->bindValue(':barcode', $_POST['barcode'], PDO::PARAM_STR);
			$updateStmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
			$updateStmt->bindValue(':pid', $_POST['id'], PDO::PARAM_INT);
			$updateStmt->execute();

			if ($updateStmt) {
				header('Location: ../productManagement.php', TRUE, 301);
				exit();
			} else {
				header('Location: editProduct.php?id=' . $_POST['id'], TRUE, 301);
				$error = 'Product could not be updated successfully.';
				exit();
			}
			

		} else {

			$error = "Product Name is missing or invalid.";

		}

	} else {
		
		// the admin id
		$id = $_REQUEST['id'];

		$productStmt = $conn->prepare("SELECT * FROM product WHERE ProductNo = :pid");
		$productStmt->bindValue(':pid', $id, PDO::PARAM_INT);
		$productStmt->execute();
	
		$product = $productStmt->fetch();
	
		$productName = $product['Name'];
		$productBarcode = $product['Barcode'];

	}

} else {

	header('Location: ../index.php', TRUE, 301);
	exit();
	
}

include('../includes/formPageStart.php');

?>



<body>
	
	<!-- Login Page below here -->
	<div class="back">


  <div class="div-center">
		<div class="content">

			<h3>Product Edit</h3>
			<hr />
			<form action="/products/editProduct.php" method="post">

				<input type="hidden" id="id" name="id" value="<?php echo $id ?>">

				<div class="form-group">
					<label for="name">Product Name</label>
					<input name="name" type="text" class="form-control" id="name" value="<?php echo $productName ?>">
				</div>

				<div class="form-group">
					<label for="barcode">Product Barcode</label>
					<input name="barcode" type="text" class="form-control" id="barcode" value="<?php echo $productBarcode ?>">
				</div>

				<button type="submit" class="btn btn-primary btn-block">Confirm Edit</button>

				<small id="error" class="text-danger"><?php echo $error ?></small>      

			</form>

		</div>
	</div>

<?php include('../includes/pageEnd.php');