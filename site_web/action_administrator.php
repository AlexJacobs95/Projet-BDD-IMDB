<?php

	session_start();
	$query_succes_add = "Insertion Réussie";
	$query_succes_delete = "Suppression Réussie";
	$database = new mysqli("localhost", "root", "imdb", "IMDB");
	if ($database->connect_errno) {
	    echo "Echec lors de la connexion à MySQL : (" . $database->connect_errno . ") " . $database->connect_error;
	}

	function addAdmin($email, $pswd){
		if (checkInDb($email, "admin")){
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
		if (!checkInDb($email, "admin")){
			$_SESSION['error_delete_admin'] =array("Admin Not Exist.");
		}
		else{
			global $database;
			if (!$database->query("DELETE FROM Administrateur WHERE AdresseMail = '$email'")){
				echo "Echec lors de la Suppression dans la table : (" . $database->errno . ") " . $database->error;
			} 
			else{
			global $query_succes_delete;
			$_SESSION["query_succes_delete_admin"] = array($query_succes_delete);
			}
		}
		header("Location: ./administrator_action_page.php#op_compte_admin");
	}

	function addFilm($data){
	    global $database;
	    $res_film = checkInDb($data, $data["type"]);
	    if($res_film){
	        $_SESSION["error_add_film"] = array("Film Already in Db");
        }
        else{
	        //add query insert table film
        }
        header("Location: ./administrator_action_page.php#op_on_film");
    }

    function deleteFilm($data){
        global $database;
        $res_film = checkInDb($data, $data["type"]);
        if(!$res_film){
            $_SESSION["error_delete_film"] = array("Film not exist in Db");
        }
        else{
            //add query delete in table film
        }
        header("Location: ./administrator_action_page.php#op_on_film");
    }

    function addSerie($data){
        global $database;
        $res_serie = checkInDb($data, $data["type"]);
        if($res_serie){
            $_SESSION["error_add_serie"] = array('Serie already in Db');
        }
        else{
            // insert into serie
        }
        header("Location: ./administrator_action_page.php#op_on_serie");
    }

    function deleteSerie($data){
        global $database;
        $res_serie = checkInDb($data, $data['type']);
        if(!$res_serie){
            $_SESSION["error_delete_serie"] = array("Serie not exist in Db");
        }
        header("Location: ./administrator_action_page.php#op_on_serie");
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
		if ($type == "admin"){
            $requete = "SELECT  AdresseMail FROM Administrateur
						WHERE AdresseMail = '$data'";
        }
        else if($type == "film"){
		    $id = $data["ID"];
            $title = $data["title"];
		    $requete = "select * from Film f, Oeuvre o where f.FilmID = \"$id\" and f.FilmID = o.ID and o.Titre = \"$title\"";
        }
        else if ($type = "serie"){
            $id = $data["ID"];
            $requete = "select * from Serie s, Oeuvre o where s.SerieID = '$id' and s.SerieID = o.ID";
        }

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
	    $id = $_POST['film_name']." (".$_POST["year_film"].")";
	    $data = array(
	      "title" => $_POST["film_name"],
            "year" => $_POST["year_film"],
            "genre" => $_POST["genre_film"],
          "rating" => $_POST["rating_note_film"],
          "ID" => $id,
          "type" => "film"
        );
		addFilm($data);
	}
	else if(isset($_POST['film_delete'])){
        $id = $_POST['film_name']." (".$_POST["year_film"].")";
        $data = array(
            "title" => $_POST["film_name"],
            "year" => $_POST["year_film"],
            "ID" => $id,
            "type" => "film"
        );
		deleteFilm($data);
	}
	else if(isset($_POST['serie_add'])){
	    $name = $_POST['serie_name'];
        $id = "\"$name\""." (".$_POST["begin_year"].")";
        $data = array(
            "title" => $_POST["serie_name"],
            "beginyear" => $_POST["begin_year"],
            "endyear" => "0",
            "genre" => $_POST["genre_serie"],
            "rating" => $_POST["rating_note_serie"],
            "ID" => $id,
            "type" => "serie"
        );
        if($_POST["end_year"] !=""){
            $data['endyear'] = $_POST["end_year"];
        }
		addSerie($data);
	}
	else if(isset($_POST['serie_delete'])){
        $name = $_POST['serie_name'];
        $id = "\"$name\""." (".$_POST["begin_year"].")";
        $data = array(
            "title" => $_POST["serie_name"],
            "beginyear" => $_POST["begin_year"],
            "ID" => $id,
            "type" => "serie"
        );
		deleteSerie($data);
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