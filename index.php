<?php

include_once 'config/dbconfig.php';

session_start();

$db = new dbconfig();
$conn = $db->getConnection();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	$username = $_SESSION['username'];
} else {
	header('Location: login.php', TRUE, 301);
	exit();
}

// get the number of users signed up
$signedUpStmt = "SELECT count(UserID) as userCount FROM user";
$userCountRow = $conn->prepare($signedUpStmt);
$userCountRow->execute();

$userCount = $userCountRow->fetchColumn();

// get the most popular product
$popularStmt = "SELECT Name, count(Name) as ProductCount FROM grocery GROUP BY Name ORDER BY ProductCount DESC LIMIT 1";
$popularProductRow = $conn->prepare($popularStmt);
$popularProductRow->execute();

$popularProduct = $popularProductRow->fetchColumn();

// get the distinct barcode count
$distinctBarcodesStmt = "SELECT count(DISTINCT Barcode) as barcodeCount FROM grocery";
$barcodeCountRow = $conn->prepare($distinctBarcodesStmt);
$barcodeCountRow->execute();

$barcodeCount = $barcodeCountRow->fetchColumn();

// get the products in our data store
$productsStmt = "SELECT count(ProductNo) as productCount FROM product";
$productCountRow = $conn->prepare($productsStmt);
$productCountRow->execute();

$productCount = $productCountRow->fetchColumn();

// get the current number of admins
$adminsStmt = "SELECT count(AdminID) as adminCount FROM admin";
$adminCountRow = $conn->prepare($adminsStmt);
$adminCountRow->execute();

$adminCount = $adminCountRow->fetchColumn();

// get the number of pending requests
$requestCountStmt = "SELECT count(RequestNo) as reqCount FROM request";
$requestCountRow = $conn->prepare($requestCountStmt);
$requestCountRow->execute();

$requestCount = $requestCountRow->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>COMP208 Foodtracker - Admin Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
	
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <a class="navbar-brand" href="#">Expiration Tracker - Admin Backend</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>

	<?php
	if ($_SESSION['loggedIn']) {
		echo '
			<form class="form-inline my-2 my-lg-0" action="logout.php">
				<button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
			</form>
		';
	} else {
		echo '
			<form class="form-inline my-2 my-lg-0" action="login.php">
      			<button class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
    		</form>
		';
	}
	?>

  </div>

</nav>

<!-- Beginning of Cards and layout -->
<div class="container-fluid" style="padding-top: 1.5%;">
	<div class="row">

		<div class="col">
			<div class="card text-white bg-primary mb-3" style="text-align: center;">
			<div class="card-header">Number of Users Signed Up</div>
			<div class="card-body">
				<h5 class="card-title"><?php echo $userCount ?></h5>
				<p class="card-text">The current amount of Users on our platform. Access them individually via User Management.</p>
			</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-danger mb-3" style="text-align: center;">
				<div class="card-header">Most Popular Product</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $popularProduct ?></h5>
					<p class="card-text">This is the most popular item that individual people are holding mostly in their product storages.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-success mb-3" style="text-align: center;">
				<div class="card-header">Unique Barcodes Held by Users</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $barcodeCount ?></h5>
					<p class="card-text">This is the amount of unique barcodes held in the groceries storage by all individuals combined.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-black bg-warning mb-3" style="text-align: center;">
				<div class="card-header">Products in our Data Store</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $productCount ?></h5>
					<p class="card-text">The amount of products we currently hold. Access them from your Product Management below.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-info mb-3" style="text-align: center;">
				<div class="card-header">Current Number of Admins</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $adminCount ?></h5>
					<p class="card-text">This is the amount of admins in our database. You can access them via Admin Management.</p>
				</div>
			</div>
		</div>


	</div>

<div class="row">

		<div class="col">
			<div class="card text-white bg-dark mb-3" style="text-align: center;">
				<div class="card-header">Number of Pending Requests</div>
				<div class="card-body">
					<h5 class="card-title"><?php echo $requestCount ?></h5>
					<p class="card-text">The amount of pending requests for products to be added to our data store. Access via Product Management.</p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col">
		<form action="adminManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%;"><b>Admin Management<b></button>
			</div>
		</form>
	</div>
</div>

<div class="row" style="margin-top: 0.5%">
	<div class="col">
		<form action="userManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-danger btn-lg btn-block" style="width: 100%;"><b>User Management<b></button>
			</div>
		</form>
	</div>
</div>

<div class="row" style="margin-top: 0.5%">
	<div class="col">
		<form action="productManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-success btn-lg btn-block" style="width: 100%;"><b>Product Management<b></button>
			</div>
		</form>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>