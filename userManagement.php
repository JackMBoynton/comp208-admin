<?php

include_once 'config/dbconfig.php';

$title = 'COMP208 Foodtracker - User Management';
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
$userStmt = $conn->prepare("SELECT * FROM user");
$userStmt->execute();

?>

<body style="background-color: #DBDBDB">
	<div class="container">

		<div class="row" style="justify-content: center; margin-top: 0.5%; margin-bottom: 0.5%;">
			<h1 style="color: #6C757D">User Management</h1>
		</div>

		<table class="table table-bordered" style="background-color: #fff">
			<thead>
				<tr>
					<th scope="col">User ID</th>
					<th scope="col">Username</th>
					<th scope="col">Email</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php


			while ($row = $userStmt->fetch()) { ?>

				<tr>
					<th scope="row"><?php echo $row['UserID'] ?></th>
					<td><?php echo $row['Username'] ?></td>
					<td><?php echo $row['Email'] ?></td>
					<td><a style="color: red" class="delete_user" href="javascript:void(0)" data-user-id="<?php echo $row['UserID']; ?>" data-username="<?php echo $row['Username']; ?>">Delete</a></td>
				</tr>

				<?php $rowIndex++; ?>
			<?php 
			}
			?>

			</tbody>
		</table>

		<div class="row">
			<div class="col">
				<form action="users/adminCreateUser.php">
					<div class="col" style="padding: 0;">
						<button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%;"><b>Add a New User<b></button>
					</div>
				</form>
			</div>
		</div>

	</div>

<?php include('includes/managementPageEnd.php'); ?>

</body>