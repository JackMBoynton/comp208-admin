<?php

include_once '../config/dbconfig.php';

session_start();

$title = 'COMP208 Foodtracker - Create Admin';

$db = new dbconfig();
$conn = $db->getConnection();

$error = '';

// if isset $_SESSION['loggedIn'] and it also equals true, redirect to index.php else, see comment below
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
	// initial load
	if (isset($_POST['email']) && !empty($_POST['email'])) {
		if (isset($_POST['username']) && !empty($_POST['username'])) {
			if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {
				if (isset($_POST['surname']) && !empty($_POST['surname'])) {

					// preparing the statement and binding values
					$updateStmt = $conn->prepare("INSERT INTO admin (FirstName, Surname, Email, Username, Password) VALUES (:fn, :sn, :email, :user, :pwd)");

					$defaultPassword = password_hash("Password", PASSWORD_DEFAULT);

					$updateStmt->bindValue(':fn', $_POST['firstName'], PDO::PARAM_STR);
					$updateStmt->bindValue(':sn', $_POST['surname'], PDO::PARAM_STR);
					$updateStmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
					$updateStmt->bindValue(':user', $_POST['username'], PDO::PARAM_STR);
					$updateStmt->bindValue(':pwd', $defaultPassword, PDO::PARAM_INT);
					$updateStmt->execute();

					if ($updateStmt) {
						header('Location: ../adminManagement.php', TRUE, 301);
						exit();
					} else {
						$error = 'Admin could not be created successfully.';
					}

				} else {
					$error = 'Surname is missing or is invalid.';
				}
			} else {
				$error = 'First Name is missing or is invalid.';
			}
		} else {
			$error = "Username is missing or invalid.";
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

				<h3>Create a new Admin</h3>
				<hr />
				<form action="/admins/createAdmin.php" method="post">

					<div class="form-group">
						<label for="firstName">Account First Name</label>
						<input name="firstName" type="text" class="form-control" id="firstName" placeholder="Enter first name here">
					</div>

					<div class="form-group">
						<label for="surname">Account Surname</label>
						<input name="surname" type="text" class="form-control" id="surname" placeholder="Enter surname here">
					</div>

					<div class="form-group">
						<label for="email">Account Email</label>
						<input name="email" type="email" class="form-control" id="email" placeholder="Enter email here">
					</div>

					<div class="form-group">
						<label for="username">Account Username</label>
						<input name="username" type="text" class="form-control" id="username" placeholder="Enter username here">
					</div>

					<button type="submit" class="btn btn-primary btn-block">Add new Admin</button>

					<small id="error" class="text-danger"><?php echo $error ?></small>      

				</form>

			</div>
		</div>
	</div>

<?php include('../includes/pageEnd.php');