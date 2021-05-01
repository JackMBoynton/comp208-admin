<?php

include_once '../config/dbconfig.php';

session_start();

$title = 'COMP208 Foodtracker - Create Product';

$db = new dbconfig();
$conn = $db->getConnection();

$error = '';

// if isset $_SESSION['loggedIn'] and it also equals true
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	// initial load
	if (isset($_POST['name']) && !empty($_POST['name'])) {
		if (isset($_POST['barcode']) && !empty($_POST['barcode'])) {
			// preparing the statement and binding values
			$updateStmt = $conn->prepare("INSERT INTO product (Barcode, Name) VALUES (:bcode, :name)");

			$updateStmt->bindValue(':bcode', $_POST['barcode'], PDO::PARAM_STR);
			$updateStmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);

			$updateStmt->execute();

			if ($updateStmt) {
				header('Location: ../productManagement.php', TRUE, 301);
				exit();
			} else {
				$error = 'Product could not be created successfully.';
			}

		} else {
			$error = 'Product Name is missing or is invalid.';
		}
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

				<h3>Create a new Product</h3>
				<hr />
				<form action="/products/createProduct.php" method="post">

					<div class="form-group">
						<label for="name">Product Name</label>
						<input name="name" type="text" class="form-control" id="name" placeholder="Enter product name here">
					</div>

					<div class="form-group">
						<label for="barcode">Product Barcode</label>
						<input name="barcode" type="text" class="form-control" id="barcode" placeholder="Enter product barcode here">
					</div>

					<button type="submit" class="btn btn-primary btn-block">Add new Product</button>

					<small id="error" class="text-danger"><?php echo $error ?></small>      

				</form>

			</div>
		</div>
	</div>

<?php include('../includes/pageEnd.php'); ?>

</body>