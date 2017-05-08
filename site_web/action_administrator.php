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
            $id = $data["ID"];
            $title = $data["title"];
            $year = $data["year"];
            $rate = $data["rating"];
            $genre = $data["genre"];
            $requete = "INSERT INTO Oeuvre(ID, Titre,  AnneeSortie, Note) VALUES ('$id', '$title', '$year', '$rate')";
            if(!$database->query($requete)){
                echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
            }
            $requete = "INSERT INTO Film(FilmID) VALUES ('$id')";
            if(!$database->query($requete)){
                echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
            }
            if($genre !="NA" ){
                if(!$database->query("INSERT INTO Genre(ID, Genre) VALUES ('$id', '$genre')")){
                    echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
                }
            }
            global $query_succes_add;
            $_SESSION["query_succes_add_film"] = array($query_succes_add);
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
            $id = $data["ID"];
            $requete = "Delete From Film WHERE  FilmID = \"$id\"";
            if(!$database->query($requete)){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            if(!$database->query("Delete From Genre WHERE  ID = \"$id\"")){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            $requete = "Delete From Oeuvre WHERE  ID = \"$id\"" ;
            if(!$database->query($requete)){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            global $query_succes_add;
            $_SESSION["query_succes_delete_film"] = array($query_succes_add);
        }
        header("Location: ./administrator_action_page.php#op_on_film");
    }

    function addSerie($data){
        global $database;
        $id = $data["ID"];
        $title = $data["title"];
        $by = $data["beginyear"];
        $ey = $data["endyear"];
        $genre = $data["genre"];
        $rating = $data["rating"];
        $res_serie = checkInDb($data, $data["type"]);
        if($res_serie){
            $_SESSION["error_add_serie"] = array('Serie already in Db');
        }
        else{
            $requete = "INSERT INTO Oeuvre(ID, Titre,  AnneeSortie, Note) VALUES ('$id', '$title', '$by', '$rating')";
            if(!$database->query($requete)){
                echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
            }
            $requete = "INSERT INTO Serie(SerieID, AnneeFin) VALUES ('$id', '$ey')";
            if(!$database->query($requete)){
                echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
            }
            if($genre !="NA" ){
                if(!$database->query("INSERT INTO Genre(ID, Genre) VALUES ('$id', '$genre')")){
                    echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
                }
            }
            global $query_succes_add;
            $_SESSION["query_succes_add_serie"] = array($query_succes_add);
        }
        header("Location: ./administrator_action_page.php#op_on_serie");
    }

    function deleteSerie($data){
        global $database;
        $id = $data["ID"];
        $res_serie = checkInDb($data, $data['type']);
        if(!$res_serie){
            $_SESSION["error_delete_serie"] = array("Serie not exist in Db");
        }
        else{
            $requete = "Delete From Serie WHERE  SerieID = \"$id\"";
            if(!$database->query($requete)){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            if(!$database->query("Delete From Genre WHERE  ID = \"$id\"")){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            $requete = "Delete From Oeuvre WHERE  ID = \"$id\"" ;
            if(!$database->query($requete)){
                echo "Echec lors de la suppression dans la table : (" . $database->errno . ") " . $database->error;
            }
            global $query_succes_add;
            $_SESSION["query_succes_delete_serie"] = array($query_succes_add);
        }
        header("Location: ./administrator_action_page.php#op_on_serie");
    }

    function addEpisode($data){
        global $database;
        $res_episode = checkInDb($data, $data["type"]);
        if($res_episode){
            $_SESSION["error_add_episode"] = array("Episode Already in Db");
        }
        else{

        }
        header("Location : ./administrator_action_page.php#op_on_episode");
    }

    function checkSameData($dataPerson){
        global $database;
        $result = "NA";
        $nom = $dataPerson['secondName'];
        $prenom = $dataPerson['firstName'];
        $requete = "Select * From Personne p  WHERE p.Nom = \"$nom\" and p.Prenom = \"$prenom\" ";
        $output = $database->query($requete);
        if($row = $output->fetch_assoc()){
            $num = $row['Numero'];
            while($row = $output->fetch_assoc()){
                $num = $row['Numero'];
            }
            echo $num;
            if($num == "NA"){
                $requete = "UPDATE Personne SET Numero  = 'I' WHERE Nom = \"$nom\" and Prenom = \"$prenom\" ";
                if(!$database->query($requete)) {
                    echo "Echec lors de l'update dans la table : (" . $database->errno . ") " . $database->error;
                }
                $result  = "II";
            }
            else {
                $result = $num."I";
            }
        }
        return $result;
    }

    function getNumero($data){
        global $database;
        $prenom = $data['firstName'];
        $nom = $data['secondName'];
        $genre = $data['gender'];
        $requete = "SELECT * From Personne WHERE \"$prenom\" = Prenom and Nom = \"$nom\" and Genre = \"$genre\"";
        $output = $database->query($requete);
        $row = $output->fetch_assoc();
        $num = $row['Numero'];
        return $num;
    }

	function addDirector($dataPerson)
    {
	    global $database;
        $prenom = $dataPerson['firstName'];
        $nom = $dataPerson['secondName'];
        $genre = $dataPerson['gender'];
	    $res_person = checkInDb($dataPerson, "Personne");
	    $res_dir = checkInDb($dataPerson, $dataPerson['typeofperson']);
        if($res_dir){
	        $_SESSION['error_add_dir'] = array("Director Already In Db");
        }
        else{
	        if(!$res_person){
	            $result = checkSameData($dataPerson);
	            $requete = "INSERT INTO Personne(Prenom, Nom, Numero, Genre) VALUES ('$prenom', '$nom','$result', '$genre')";
	            $database->query($requete);
            }
            else{
                $result = getNumero($dataPerson);
            }
            $requete = "INSERT INTO Directeur(Prenom, Nom, Numero) VALUES ('$prenom', '$nom','$result')";
            $database->query($requete);
            global $query_succes_add;
            $_SESSION["query_succes_add_dir"] = array($query_succes_add);

        }
        header("Location: ./administrator_action_page.php#op_on_dir");
    }

    function addActor($data){
	    global $database;
        $prenom = $data['firstName'];
        $nom = $data['secondName'];
        $genre = $data['gender'];
	    $res_person = checkInDb($data, "Personne");
	    $res_actor = checkInDb($data, $data["typeofperson"]);
        if($res_actor){
            $_SESSION['error_add_actor'] = array("Actor Already In Db");
        }
        else{
            if(!$res_person){
                $result = checkSameData($data);
                $requete = "INSERT INTO Personne(Prenom, Nom, Numero, Genre) VALUES ('$prenom', '$nom','$result', '$genre')";
                $database->query($requete);
            }
            else{
                $result = getNumero($data);
            }
            $requete = "INSERT INTO Acteur(Prenom, Nom, Numero) VALUES ('$prenom', '$nom','$result')";
            $database->query($requete);
            global $query_succes_add;
            $_SESSION["query_succes_add_actor"] = array($query_succes_add);
        }
        header("Location: ./administrator_action_page.php#op_on_actor");
    }

    function addWriter($data){
        global $database;
        $prenom = $data['firstName'];
        $nom = $data['secondName'];
        $genre = $data['gender'];
        $res_person = checkInDb($data, "Personne");
        $res_writer = checkInDb($data, $data["typeofperson"]);
        if($res_writer){
            $_SESSION['error_add_writer'] = array("Writer Already In Db");
        }
        else{
            if(!$res_person){
                $result = checkSameData($data);
                $requete = "INSERT INTO Personne(Prenom, Nom, Numero, Genre) VALUES ('$prenom', '$nom','$result', '$genre')";
                $database->query($requete);
            }
            else{
                $result = getNumero($data);
            }
            $requete = "INSERT INTO Auteur(Prenom, Nom, Numero) VALUES ('$prenom', '$nom','$result')";
            $database->query($requete);
            global $query_succes_add;
            $_SESSION["query_succes_add_writer"] = array($query_succes_add);
        }
        header("Location: ./administrator_action_page.php#op_on_writer");
    }
    
	function checkInDb($data, $type){
        global $database;
		$result = false;
		if ($type == "admin"){
            $requete = "SELECT  AdresseMail FROM Administrateur
						WHERE AdresseMail = \"$data\"";
        }
        else if($type == "film"){
		    $id = $data["ID"];
            $title = $data["title"];
		    $requete = "select f.FilmID from Film f, Oeuvre o where f.FilmID = \"$id\" and f.FilmID = o.ID and o.Titre = \"$title\"";
        }
        else if ($type == "serie"){
            $id = $data["ID"];
            $requete = "select s.SerieID from Serie s, Oeuvre o where s.SerieID = \"$id\" and s.SerieID = o.ID";
        }
        else if($type == "episode"){
            $title = $data['episodetitle'];
            $serie = $data['serietitle'];
            $requete = "select e.EpisodeID from Serie s, Episode e, Oeuvre o where s.SerieID = e.SID and e.TitreS = \"$serie\" and o.ID = e.EpisodeID and o.Titre = \"$title\"";
        }
		else if($type == "director"){
		    $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
            echo "genre \n $gender \n";
		    $requete = "SELECT d.Prenom, d.Nom, d.Numero From Directeur d, Personne  p WHERE \"$prenom\" = d.Prenom and d.Nom = \"$nom\" and d.Prenom = p.Prenom and d.Nom = p.Nom and p.Numero = d.Numero and p.Genre = \"$gender\"";
        }
        else if($type == "writer"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
            $requete = "SELECT a.Prenom, a.Nom, a.Numero From Auteur a, Personne p WHERE \"$prenom\" = a.Prenom and a.Nom = \"$nom\" and a.Prenom = p.Prenom and a.Nom = p.Nom and p.Numero = a.Numero and p.Genre = \"$gender\"";
        }
        else if($type == "actor"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $gender = $data['gender'];
            $requete = "SELECT a.Prenom, a.Nom, a.Numero From Acteur a, Personne p WHERE \"$prenom\" = a.Prenom and a.Nom = \"$nom\" and a.Prenom = p.Prenom and a.Nom = p.Nom and p.Numero = a.Numero and p.Genre = \"$gender\"";
        }
        else if($type == "Personne"){
            $prenom = $data['firstName'];
            $nom = $data['secondName'];
            $genre = $data['gender'];
            $requete = "SELECT Prenom, Nom, Genre From Personne WHERE \"$prenom\" = Prenom and Nom = \"$nom\" and Genre = \"$genre\"";
        }
		$output = $database->query($requete);
		if($row = $output->fetch_assoc()){
			$result = true;
		}
		return $result;
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
            "genre" => "NA",
          "rating" => "-1",
          "ID" => $id,
          "type" => "film"
        );
	    if($_POST["genre_film"] != ""){
	        $data["genre"] = $_POST["genre_film"];
        }
        if($_POST["rating_note_film"] != ""){
            $data["rating"] = $_POST["rating_note_film"];
        }
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
            "genre" => "NA",
            "rating" => "-1",
            "ID" => $id,
            "type" => "serie"
        );
        if($_POST["end_year"] !=""){
            $data['endyear'] = $_POST["end_year"];
        }
        if($_POST["genre_serie"] != ""){
            $data["genre"] = $_POST["genre_serie"];
        }
        if($_POST["rating_note_serie"] != ""){
            $data["rating"] = $_POST["rating_note_serie"];
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
        $name = $_POST['serie_name'];
        $id = "\"$name\""." (".$_POST["begin_year"].")";
	    $data = array(
	        "serieID" => $id,
            "episodeID" =>"", // ne vois pas comment le recréer
            "episodeNumber" => "NA",
            "seasonNumber" => "NA",
            "type" => "episode"
        );
	    if($_POST["episode_number"] != ""){
	        $data['episodeNumber'] = $_POST['episode_number'];
        }
        if($_POST["season_number"]!=""){
	        $data['seasonNumber'] = $_POST['season_number'];
        }
		addEpisode($data);
	}
	else if(isset($_POST['director_add'])){
        $dataPerson = array(
            'firstName' => $_POST['director_firstname'],
            'secondName' => $_POST['director_secondname'],
            'gender' => "NA",
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
            'gender' => "NA",
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
            'gender' => "NA",
            'typeofperson' => 'actor'
        );
        if($_POST['gender'] != ""){
            $dataPerson['gender'] = $_POST['gender'];
        }
		addActor($dataPerson);
	}
	$database->close();
?>