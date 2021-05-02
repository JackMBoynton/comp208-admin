<?php

include_once '../config/dbconfig.php';

session_start();

$title = 'COMP208 Foodtracker - Create User';

$db = new dbconfig();
$conn = $db->getConnection();

$error = '';

// if isset $_SESSION['loggedIn'] and it also equals true, redirect to index.php else, see comment below
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	// initial load
	if (isset($_POST['email']) && !empty($_POST['email'])) {
		if (isset($_POST['username']) && !empty($_POST['username'])) {

			// preparing the statement and binding values
			$updateStmt = $conn->prepare("INSERT INTO user (Email, Username, Password) VALUES (:email, :user, :pwd)");

			$defaultPassword = password_hash("Password", PASSWORD_DEFAULT);

			$updateStmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
			$updateStmt->bindValue(':user', $_POST['username'], PDO::PARAM_STR);
			$updateStmt->bindValue(':pwd', $defaultPassword, PDO::PARAM_STR);
			$updateStmt->execute();

			if ($updateStmt) {
				header('Location: ../userManagement.php', TRUE, 301);
				exit();
			} else {
				$error = 'User could not be created successfully.';
			}

		} else {
			$error = "Username / Email is missing or invalid.";
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

				<h3>Create a new User</h3>
				<hr />
				<form action="/users/adminCreateUser.php" method="post">

					<div class="form-group">
						<label for="email">Account Email</label>
						<input name="email" type="email" class="form-control" id="email" placeholder="Enter email here">
					</div>

					<div class="form-group">
						<label for="username">Account Username</label>
						<input name="username" type="text" class="form-control" id="username" placeholder="Enter username here">
					</div>

					<button type="submit" class="btn btn-primary btn-block">Add new User</button>

					<small id="error" class="text-danger"><?php echo $error ?></small>      

				</form>

			</div>
		</div>
	</div>

<?php include('../includes/pageEnd.php');