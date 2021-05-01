<?php

include_once 'config/dbconfig.php';

$title = 'COMP208 Foodtracker - Product Management';
$productsRowIndex = 1;
$requestsRowIndex = 1;

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
$productStmt = $conn->prepare("SELECT * FROM product");
$productStmt->execute();

$requestsStmt = $conn->prepare("SELECT * FROM request");
$requestsStmt->execute();
?>

<body style="background-color: #DBDBDB">
	<div class="container">

			<div class="row" style="justify-content: center; margin-top: 0.5%; margin-bottom: 0.5%;">
				<h1 style="color: #6C757D">Product Management</h1>
			</div>
			

			<table class="table table-bordered" style="background-color: #fff">
				<thead>
					<tr>
						<th scope="col">Product #</th>
						<th scope="col">Product Name</th>
						<th scope="col">Product Barcode</th>
						<th scope="col">Product Actions</th>
					</tr>
				</thead>
			</tbody>
			<?php
				while ($row = $productStmt->fetch()) { ?>

					<tr>
						<th scope="row"><?php echo $row['ProductNo'] ?></th>
						<td><?php echo $row['Name'] ?></td>
						<td><?php echo $row['Barcode'] ?></td>
						<td>
						<a style="color: blue" href="products/editProduct.php?id=<?php echo $row['ProductNo']; ?>">Edit</a>
						<a style="color: red" class="delete_product" href="javascript:void(0)" data-product-id="<?php echo $row['ProductNo']; ?>" data-barcode="<?php echo $row['Barcode']; ?>">Delete</a>
						</td>
					</tr>

					<?php $productsRowIndex++; ?>
				<?php 
				}
				?>
				</tbody>
			</table>

			<div class="row">
				<div class="col">
					<form action="products/createProduct.php">
						<div class="col" style="padding: 0;">
							<button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%;"><b>Add a New Product<b></button>
						</div>
					</form>
				</div>
			</div>

			<div class="row" style="justify-content: center; margin-top: 0.5%; margin-bottom: 0.5%;">
				<h1 style="color: #6C757D">Request Management</h1>
			</div>
		
			<table class="table table-bordered" style="background-color: #fff">
			<thead>
				<tr>
					<th scope="col">Request #</th>
					<th scope="col">Product Name</th>
					<th scope="col">Product Barcode</th>
					<th scope="col">User ID Requesting</th>
					<th scope="col">Product Actions</th>
				</tr>
				<?php
			while ($row = $requestsStmt->fetch()) { ?>

				<tr>
					<th scope="row"><?php echo $row['RequestNo'] ?></th>
					<td><?php echo $row['ProductName'] ?></td>
					<td><?php echo $row['ProductBarcode'] ?></td>
					<td><?php echo $row['UserID'] ?></td>
					<td>
						<a style="color: green" class="accept_request" href="javascript:void(0)" data-request-id="<?php echo $row['RequestNo']; ?>" data-productName="<?php echo $row['ProductName']; ?>">Accept</a>
						<a style="color: red" class="decline_request" href="javascript:void(0)" data-request-id="<?php echo $row['RequestNo']; ?>" data-productName="<?php echo $row['ProductName']; ?>">Decline</a>
					</td>
				</tr>

				<?php $requestsRowIndex++; ?>
			<?php 
			}
			?>
			</tbody>
		</table>
		
	</div>

	<?php include('includes/managementPageEnd.php'); ?>

</body>
