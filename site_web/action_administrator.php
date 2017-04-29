<?php

	session_start();
	$query_succes_add = "Insertion Réussie";
	$query_succes_delete = "Suppression Réussie";
	$database = new mysqli("localhost", "root", "imdb", "IMDB");
	if ($database->connect_errno) {
	    echo "Echec lors de la connexion à MySQL : (" . $database->connect_errno . ") " . $database->connect_error;
	}

	function checkAdminExistDb($email){
		global $database;
		$result = false;
		$requete = "SELECT  AdresseMail FROM Administrateur
						WHERE AdresseMail = '$email'";
		$output = $database->query($requete);
		
		if($row = $output->fetch_assoc()){
			$result = true;
		}
		return $result;
	}

	function addAdmin($email, $pswd){
		if (checkAdminExistDb($email)){
			$_SESSION['error_add'] =array("Admin Already Exist");
		}
		else{
			global $database;
			if (!$database->query("INSERT INTO Administrateur(AdresseMail, motDePasse) VALUES ('$email', '$pswd')")){
				echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
			} 
			else{
				global $query_succes_add;
				$_SESSION["query_succes_add"] = array($query_succes_add);
			}
		}
		header("Location: ./administrator_action_page.php#op_compte_admin");
	}

	function deleteAdmin($email){
		if (!checkAdminExistDb($email)){
			$_SESSION['error_delete'] =array("Admin Not Exist.");
		}
		else{
			global $database;
			if (!$database->query("DELETE FROM Administrateur WHERE AdresseMail = '$email'")){
				echo "Echec lors de la Suppression dans la table : (" . $database->errno . ") " . $database->error;
			} 
			else{
			global $query_succes_delete;
			$_SESSION["query_succes_delete"] = array($query_succes_delete);
			}
		}
		header("Location: ./administrator_action_page.php#op_compte_admin");
	}

	if(isset($_POST['admin_add'])){
		addAdmin($_POST["email"], md5($_POST["pswd"]));
	}
	else if(isset($_POST['admin_delete'])){
		deleteAdmin($_POST['email']);
	}


	$database->close();
?>