<?php

session_start();
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {


    if ($_GET['type'] === "add_comment") {

        $OID = mysqli_real_escape_string($database, $_SESSION['id']);
        $pseudo = mysqli_real_escape_string($database, $_POST['pseudo']);
        $text = mysqli_real_escape_string($database, $_POST['text']);


        $query = "INSERT INTO Commentaires(OID, Texte, Auteur)
                  VALUES('$OID', '$text', '$pseudo')";

        $res = $database->query($query);
        echo json_encode($res === TRUE);
    }
}

?>