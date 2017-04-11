<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page de recherche avancé de site web.
-->
 <?php session_start(); ?>

 <!DOCTYPE html>
<html>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/style.css" type="text/css">
	<head>
		<link href="media/icon_imdb.ico" rel="shortcut icon"/>
		<title>Login Administrateur</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			include 'menubar.php';
		?>
		<form action="/check_login.php">

			<div class="container">
			    <label><b>Username</b></label>
			    <input type="text" placeholder="Enter Username" name="uname" required>

			    <label><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="psw" required>

			    <button type="submit">Login</button>
		  	</div>
		</form>
	</body>
	<script src="./js/jquery-1.12.3.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
</html>