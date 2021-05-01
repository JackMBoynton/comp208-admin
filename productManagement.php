<?php

include_once 'config/dbconfig.php';

$title = 'COMP208 Foodtracker - Product Management';
$rowIndex1 = 1;
$rowIndex2 = 1;

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
					<th scope="col">Product No</th>
					<th scope="col">Name</th>
					<th scope="col">Barcode</th>
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
					<a style="color: red" class="delete_admin" href="javascript:void(0)" data-admin-id="<?php echo $row['ProductNo']; ?>" data-username="<?php echo $row['Barcode']; ?>">Delete</a>
					<a style="color: blue" href="admins/editAdmin.php?id=<?php echo $row['ProductNo']; ?>">Edit</a>
					</td>
				</tr>

				<?php $rowIndex1++; ?>
			<?php 
			}
			?>
			</tbody>
		</table>


	

		
			<div class="row" style="justify-content: center; margin-top: 0.5%; margin-bottom: 0.5%;">
				<h1 style="color: #6C757D">Product Requests</h1>
			</div>
		
			<table class="table table-bordered" style="background-color: #fff">
			<thead>
				<tr>
					<th scope="col">Request No</th>
					<th scope="col">Name</th>
					<th scope="col">Barcode</th>
					<th scope="col">User</th>
				</tr>
				<?php
			while ($row = $requestsStmt->fetch()) { ?>

				<tr>
					<th scope="row"><?php echo $row['RequestNo'] ?></th>
					<td><?php echo $row['ProductName'] ?></td>
					<td><?php echo $row['ProductBarcode'] ?></td>
					<td><?php echo $row['UserID'] ?></td>
					<td>
					<a style="color: blue" href="admins/editAdmin.php?id=<?php echo $row['RequestNo']; ?>">Accept</a>
					<a style="color: red" class="delete_admin" href="javascript:void(0)" data-admin-id="<?php echo $row['RequestNo']; ?>" data-username="<?php echo $row['ProductName']; ?>">Delete</a>
				
					</td>
				</tr>

				<?php $rowIndex2++; ?>
			<?php 
			}
			?>
			</tbody>
		</table>
		</div>
	</body>
