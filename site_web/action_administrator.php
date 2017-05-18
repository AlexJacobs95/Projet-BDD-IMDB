<?php

session_start();
$query_succes_add = "Insertion Réussie";
$query_succes_delete = "Suppression Réussie";
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if ($database->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $database->connect_errno . ") " . $database->connect_error;
}

function addAdmin($email, $pswd)
{
    if (checkInDb($email, "admin")) {
        $_SESSION['error_add_admin'] = array("Admin Already Exist");
    } else {
        global $database;
        if (!$database->query("INSERT INTO Administrateur(AdresseMail, motDePasse) VALUES ('$email', '$pswd')")) {
            echo "Echec lors de l'insertion dans la table : (" . $database->errno . ") " . $database->error;
        } else {
            global $query_succes_add;
            $_SESSION["query_succes_add_admin"] = array($query_succes_add);
        }
    }
    header("Location: ./administrator_action_page.php#op_compte_admin");
}

function deleteAdmin($email)
{
    if (!checkInDb($email, "admin")) {
        $_SESSION['error_delete_admin'] = array("Admin Not Exist.");
    } else {
        global $database;
        if (!$database->query("DELETE FROM Administrateur WHERE AdresseMail = '$email'")) {
            echo "Echec lors de la Suppression dans la table : (" . $database->errno . ") " . $database->error;
        } else {
            global $query_succes_delete;
            $_SESSION["query_succes_delete_admin"] = array($query_succes_delete);
        }
    }
    header("Location: ./administrator_action_page.php#op_compte_admin");
}

function checkInDb($data, $type)
{
    global $database;
    $result = false;
    if ($type == "admin") {
        $requete = "SELECT  AdresseMail FROM Administrateur
						WHERE AdresseMail = \"$data\"";
    }
    $output = $database->query($requete);
    if ($row = $output->fetch_assoc()) {
        $result = true;
    }
    return $result;
}

if (isset($_POST['admin_add'])) {
    addAdmin($_POST["email"], md5($_POST["pswd"]));
} else if (isset($_POST['admin_delete'])) {
    deleteAdmin($_POST['email']);
}
$database->close();
?>