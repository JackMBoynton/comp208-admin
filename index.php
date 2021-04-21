<?php

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

    <form class="form-inline my-2 my-lg-0" action="login.php">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
    </form>

  </div>

</nav>

<!-- Beginning of Cards and layout -->
<div class="container-fluid" style="padding-top: 1.5%;">
	<div class="row">

		<div class="col">
			<div class="card text-white bg-primary mb-3" style="text-align: center;">
			<div class="card-header">Number of Users Signed Up</div>
			<div class="card-body">
				<h5 class="card-title">Primary card title</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-danger mb-3" style="text-align: center;">
				<div class="card-header">Most Popular Product</div>
				<div class="card-body">
					<h5 class="card-title">Primary card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-success mb-3" style="text-align: center;">
				<div class="card-header">Product Expiring Quickest</div>
				<div class="card-body">
					<h5 class="card-title">Primary card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-black bg-warning mb-3" style="text-align: center;">
				<div class="card-header">Products in our Data Store</div>
				<div class="card-body">
					<h5 class="card-title">Primary card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
		</div>

		<div class="col">
			<div class="card text-white bg-info mb-3" style="text-align: center;">
				<div class="card-header">Current Number of Admins</div>
				<div class="card-body">
					<h5 class="card-title">Primary card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
		</div>


	</div>

<div class="row">

		<div class="col">
			<div class="card text-white bg-dark mb-3" style="text-align: center;">
				<div class="card-header">Number of Pending Requests</div>
				<div class="card-body">
					<h5 class="card-title">Primary card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col">
		<form action="adminManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-primary" style="width: 100%;">Admin Management</button>
			</div>
		</form>
	</div>
</div>

<div class="row" style="margin-top: 0.5%">
	<div class="col">
		<form action="userManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-danger" style="width: 100%;">User Management</button>
			</div>
		</form>
	</div>
</div>

<div class="row" style="margin-top: 0.5%">
	<div class="col">
		<form action="productManagement.php">
			<div class="col">
				<button type="submit" class="btn btn-success" style="width: 100%;">Product Management</button>
			</div>
		</form>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>