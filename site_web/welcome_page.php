<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page d'acceuill de site web.
-->

 <?php session_start(); ?>

<!DOCTYPE html>
<html>
	<!-- Bootstrap CSS core -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/style.css" type="text/css">
	<head>
		<link href="media/icon_imdb.ico" rel="shortcut icon"/>
		<title>IMBD Welcome</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php 
			include 'menubar.php';
		?>
		<div class="billboard">
			<div class="text-wrapper">
				<h1>IMDB: Internet Movie Data Base</h1> 
				<p>Bienvenue sur le moteur de recherche cinématographique!</p> 
			</div>
		</div>
	</body>
</html>