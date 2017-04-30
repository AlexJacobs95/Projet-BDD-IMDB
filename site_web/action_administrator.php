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
			$_SESSION['error_add_admin'] =array("Admin Already Exist");
		}
		else{
			global $database;
			if (!$database->query("INSERT INTO Administrateur(AdresseMail, motDePasse) VALUES ('$email', '$pswd')")){
				echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
			} 
			else{
				global $query_succes_add;
				$_SESSION["query_succes_add_admin"] = array($query_succes_add);
			}
		}
		header("Location: ./administrator_action_page.php#op_compte_admin");
	}

	function deleteAdmin($email){
		if (!checkAdminExistDb($email)){
			$_SESSION['error_delete_admin'] =array("Admin Not Exist.");
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

	function addDirector($dataPerson)
    {
	    global $database;
	    $res_person = checkInDb($dataPerson, "Personne");
	    $res_dir = checkInDb($dataPerson, $dataPerson['typeofperson']);
	    if($res_dir){
	        $_SESSION['error_add_dir'] = array("Director Already In Db");
        }
        else{
	        if(!$res_person){
	            pass;
	            //add in table personne
            }
            //add in table directeur
        }
        header("Location: ./administrator_action_page.php#op_on_dir");
    }

    function addActor($data){
	    global $database;
	    $res_person = checkInDb($data, "Personne");
	    $res_actor = checkInDb($data, $data["typeofperson"]);
        if($res_actor){
            $_SESSION['error_add_actor'] = array("Actor Already In Db");
        }
        else{
            if(!$res_person){
                pass;
                //add in table personne
            }
            //add in table acteur
        }
        header("Location: ./administrator_action_page.php#op_on_actor");
    }

    function addWriter($data){
        global $database;
        $res_person = checkInDb($data, "Personne");
        $res_writer = checkInDb($data, $data["typeofperson"]);
        if($res_writer){
            $_SESSION['error_add_writer'] = array("Writer Already In Db");
        }
        else{
            if(!$res_person){
                pass;
                //add in table personne
            }
            //add in table auteur
        }
        header("Location: ./administrator_action_page.php#op_on_writer");
    }
    
	function checkInDb($data, $type){
		global $database;
		$result = false;
		if($type == "director"){
		    $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
		    $requete = "SELECT d.Prenom, d.Nom, d.Numero, p.Numero, p.Genre From Directeur d, Personne p WHERE '$prenom' = d.Prenom and d.Nom = '$nom'"; // and p.Numero = d.Numero and p.Genre = '$gender'";
        }
        else if($type == "writer"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
            $requete = "SELECT a.Prenom, a.Nom, a.Numero From Auteur a, Personne p WHERE '$prenom' = a.Prenom and a.Nom = '$nom' and a.Prenom = p.Prenom and a.Nom = p.Nom and p.Numero = a.Numero and p.Genre = '$gender'";
        }
        else if($type == "actor"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
            $requete = "SELECT a.Prenom, a.Nom, a.Numero From Acteur a, Personne p WHERE '$prenom' = a.Prenom and a.Nom = '$nom' and a.Prenom = p.Prenom and a.Nom = p.Nom and p.Numero = a.Numero and p.Genre = '$gender'";
        }
        else if($type == "Personne"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $genre = $data['gender'];
            $requete = "SELECT Prenom, Nom, Genre From Personne WHERE '$prenom' = Prenom and Nom = '$nom' and Genre = '$genre' ";
        }
		if($type == "language"){
			$requete = "SELECT  Langue FROM Langue
						WHERE Langue = '$data'";
		}
		else if($type == "genre"){
			$requete = "SELECT  Genre FROM Genre
						WHERE Genre = '$data'";
		}
		else if($type == "country"){
			$requete = "SELECT  Pays FROM Pays
						WHERE Pays = '$data'";
		}
		$output = $database->query($requete);
		if($row = $output->fetch_assoc()){
			$result = true;
		}
		return $result;
	}

	function addGenre($genre){
		global $database;
		if(checkInDb($genre, "genre")){
			$_SESSION["error_add_genre"]=array("Genre Already in Db");
		}
		else{
			pass;
		}
		header("Location: ./administrator_action_page.php#op_on_genre");
	}

	function addCountry($country){
		global $database;
		if(checkInDb($country, "country")){
			$_SESSION["error_add_country"]=array("Country Already in Db");
		}
		else{
			pass;
		}
		header("Location: ./administrator_action_page.php#op_on_country");
	}

	function addLanguage($language){
		global $database;
		if(checkInDb($language, "language")){
			$_SESSION["error_add_language"]=array("language Already in Db");
		}
		else{
			pass;
		}
		header("Location: ./administrator_action_page.php#op_on_language");
	}

	if(isset($_POST['admin_add'])){
		addAdmin($_POST["email"], md5($_POST["pswd"]));
	}
	else if(isset($_POST['admin_delete'])){
		deleteAdmin($_POST['email']);
	}
	else if(isset($_POST['film_add'])){
		addFilm();
	}
	else if(isset($_POST['film_delete'])){
		deleteFilm();
	}
	else if(isset($_POST['serie_add'])){
		addSerie();
	}
	else if(isset($_POST['serie_delete'])){
		deleteSerie();
	}
	else if(isset($_POST['episode_add'])){
		addEpisode();
	}
	else if(isset($_POST['director_add'])){
        $dataPerson = array(
            'firstName' => $_POST['director_firstname'],
            'secondName' => $_POST['director_secondname'],
            'gender' => "None",
            'typeofperson' => 'director'
        );
        if($_POST['gender'] != ""){
            $dataPerson['gender'] = $_POST['gender'];
        }
		addDirector($dataPerson);
	}
	else if(isset($_POST['writer_add'])){
        $dataPerson = array(
            'firstName' => $_POST['writer_firstname'],
            'secondName' => $_POST['writer_secondname'],
            'gender' => "None",
            'typeofperson' => 'writer'
        );
        if($_POST['gender'] != ""){
            $dataPerson['gender'] = $_POST['gender'];
        }
		addWriter($dataPerson);
	}
	else if(isset($_POST['actor_add'])){
        $dataPerson = array(
            'firstName' => $_POST['actor_firstname'],
            'secondName' => $_POST['actor_secondname'],
            'gender' => "None",
            'typeofperson' => 'actor'
        );
        if($_POST['gender'] != ""){
            $dataPerson['gender'] = $_POST['gender'];
        }
		addActor($dataPerson);
	}
	else if(isset($_POST['genre_add'])){
		addGenre($_POST['genre']);
	}
	else if(isset($_POST['country_add'])){
		addCountry($_POST['country']);
	}
	else if(isset($_POST['language_add'])){
		addLanguage($_POST['language']);
	}
	$database->close();
?>