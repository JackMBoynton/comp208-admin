<?php

include_once 'config/dbconfig.php';

$title = 'COMP208 Foodtracker - Admin Management';
$rowIndex = 1;

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
$userStmt = $conn->prepare("SELECT * FROM admin");
$userStmt->execute();

?>

<body style="background-color: #DBDBDB">
	<div class="container">

		<div class="row" style="justify-content: center; margin-top: 0.5%; margin-bottom: 0.5%;">
			<h1 style="color: #6C757D">Administrator Management</h1>
		</div>

		<table class="table table-bordered" style="background-color: #fff">
			<thead>
				<tr>
					<th scope="col">Admin ID</th>
					<th scope="col">Username</th>
					<th scope="col">Email</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php


			while ($row = $userStmt->fetch()) { ?>

				<tr>
					<th scope="row"><?php echo $row['AdminID'] ?></th>
					<td><?php echo $row['Username'] ?></td>
					<td><?php echo $row['Email'] ?></td>
					<td>
					<a style="color: red" class="delete_admin" href="javascript:void(0)" data-admin-id="<?php echo $row['AdminID']; ?>" data-username="<?php echo $row['Username']; ?>">Delete</a>
					<a style="color: blue" href="admins/editAdmin.php?id=<?php echo $row['AdminID']; ?>">Edit</a>
					<a style="color: green" href="admins/resetPassword.php?id=<?php echo $row['AdminID']; ?>">Reset Password</a>
					</td>
				</tr>

				<?php $rowIndex++; ?>
			<?php 
			}
			?>

			</tbody>
		</table>
	</div>

<?php include('includes/managementPageEnd.php'); ?>

</body>