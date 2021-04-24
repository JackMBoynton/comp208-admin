<?php

include_once '../config/dbconfig.php';

session_start();

$title = 'COMP208 Foodtracker - Admin Edit';

$db = new dbconfig();
$conn = $db->getConnection();

$error = '';

// if isset $_SESSION['loggedIn'] and it also equals true, redirect to index.php else, see comment below
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	
	// initial load
	if (isset($_POST['email']) && !empty($_POST['email'])) {

		if (isset($_POST['username']) && !empty($_POST['username'])) {

			$updateStmt = $conn->prepare("UPDATE admin SET Username = :username, Email = :email WHERE AdminID = :aid");
			$updateStmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
			$updateStmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
			$updateStmt->bindValue(':aid', $_POST['id'], PDO::PARAM_INT);
			$updateStmt->execute();

			if ($updateStmt) {
				header('Location: ../adminManagement.php', TRUE, 301);
				exit();
			} else {
				header('Location: editAdmin.php?id=' . $_POST['id'], TRUE, 301);
				$error = 'Admin could not be updated successfully.';
				exit();
			}
			

		} else {

			$error = "Username is missing or invalid.";

		}

	} else {
		
		// the admin id
		$id = $_REQUEST['id'];

		$adminStmt = $conn->prepare("SELECT * FROM admin WHERE AdminID = :aid");
		$adminStmt->bindValue(':aid', $id, PDO::PARAM_INT);
		$adminStmt->execute();
	
		$admin = $adminStmt->fetch();
	
		$adminEmail = $admin['Email'];
		$adminUsername = $admin['Username'];	

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

			<h3>Admin Edit</h3>
			<hr />
			<form action="/admins/editAdmin.php" method="post">

				<input type="hidden" id="id" name="id" value="<?php echo $id ?>">

				<div class="form-group">
					<label for="email">Account Email</label>
					<input name="email" type="email" class="form-control" id="email" value="<?php echo $adminEmail ?>">
				</div>

				<div class="form-group">
					<label for="username">Account Username</label>
					<input name="username" type="text" class="form-control" id="username" value="<?php echo $adminUsername ?>">
				</div>

				<button type="submit" class="btn btn-primary btn-block">Confirm Edit</button>

				<small id="error" class="text-danger"><?php echo $error ?></small>      

			</form>

		</div>
	</div>

<?php include('../includes/pageEnd.php');