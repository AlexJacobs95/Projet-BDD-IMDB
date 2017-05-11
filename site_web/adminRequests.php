<?php
session_start();


include "roman.php";


function execute_add_query($query, $db) {
    if ($db->query($query) === TRUE) {
        return ("Record added " . $db->error);
    } else {
        return ("Error updating record: " . $db->error);
    }
}

function remove_role($nom, $prenom, $numero, $oid, $db)
{
    $query = "Delete
              FROM Role
              WHERE Prenom = '$prenom' AND Nom = '$nom' AND Numero = '$numero' AND OID = '$oid'";

    if ($db->query($query) === TRUE) {
        return ("success " . $db->error);
    } else {
        return ("Error:" . $db->error);
    }
}

function remove_isDirectedBy($nom, $prenom, $numero, $oid, $db)
{
    $query = "Delete
              FROM DirigePar
              WHERE Prenom = '$prenom' AND Nom = '$nom' AND Numero = '$numero' AND OID = '$oid'";

    if ($db->query($query) === TRUE) {
        return ("Success " . $db->error);
    } else {
        return ("Error: " . $db->error);
    }
}

function remove_isWrittenBy($nom, $prenom, $numero, $oid, $db)
{
    $query = "Delete
              FROM EcritPar
              WHERE Prenom = '$prenom' AND Nom = '$nom' AND Numero = '$numero' AND OID = '$oid'";

    if ($db->query($query) === TRUE) {
        return ("Success" . $db->error);
    } else {
        return ("Error: " . $db->error);
    }
}

function get_all_nums_for_name($nom, $prenom, $db)
{
    $query = "SELECT Numero
              FROM Personne
              WHERE Nom = '$nom' AND Prenom = '$prenom'";
    return $db->query($query);
}

function get_numero($num_array)
{
    $cleaned_nums = array();
    foreach ($num_array as $num) {
        if ($num != "NA"){
            $num = toNumber($num);
            array_push($cleaned_nums, $num);
        }

    }

    if (sizeof($cleaned_nums) > 0){
        return toRoman(max($cleaned_nums) + 1);
    } else {
        return "NA";
    }

}

function query_res_to_array($query_res)
{
    $res = array();
    while ($row = mysqli_fetch_assoc($query_res)) {
        $new_array[] = $row; // Inside while loop
        array_push($res, $new_array);
    }
    return $res;

}

function check_for_person($nom, $prenom, $db)
{
    $query = "SELECT *
              FROM Personne
              WHERE Nom = '$nom' AND Prenom = '$prenom'";

    return $db->query($query);
}

function add_person($nom, $prenom, $numero, $genre, $db)
{
    $fullname = $prenom . ' ' . $nom;
    if ($genre == "Homme"){
        $genre = "m";
    } else {
        $genre = "f";
    }
    $query = "INSERT INTO Personne(Nom, Prenom, Numero, Genre, fullname)
              VALUE ('$nom', '$prenom', '$numero', '$genre','$fullname')";

    return execute_add_query($query, $db);

}

function add_actor($nom, $prenom, $numero, $db)
{
    $query = "INSERT INTO Acteur(Nom, Prenom, Numero)
              VALUE ('$nom', '$prenom', '$numero')";

    return execute_add_query($query, $db);

}

function add_writer($nom, $prenom, $numero, $db)
{
    $query = "INSERT INTO Auteur(Nom, Prenom, Numero)
              VALUE ('$nom', '$prenom', '$numero')";

    return execute_add_query($query, $db);

}

function add_director($nom, $prenom, $numero, $db)
{
    $query = "INSERT INTO Directeur(Nom, Prenom, Numero)
              VALUE ('$nom', '$prenom', '$numero')";

    return execute_add_query($query, $db);


}

function add_directedBy($nom, $prenom, $numero,$OID, $db) {
    $query = "INSERT INTO DirigePar(OID, Nom, Prenom, Numero)
              VALUE ('$OID', '$nom', '$prenom', '$numero')";

    return execute_add_query($query, $db);
}

function add_writtenBy($nom, $prenom, $numero, $OID, $db) {
    $query = "INSERT INTO EcritPar(OID, Nom, Prenom, Numero)
              VALUE ('$OID', '$nom', '$prenom', '$numero')";

    return execute_add_query($query, $db);
}

function add_role($nom, $prenom, $numero, $role,$OID, $db)
{
    $query = "INSERT INTO Role(OID, Nom, Prenom, Numero, Role)
              VALUE ('$OID', '$nom', '$prenom', '$numero','$role')";

    return execute_add_query($query, $db);

}

function remove_work($id, $db)
{
    $query = "Delete
              FROM Oeuvre
              WHERE ID = '$id'";

    return execute_add_query($query, $db);

}

$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo json_encode("Error: Unable to connect to MySQL." . PHP_EOL);
    echo json_encode("Debugging errno: " . mysqli_connect_errno() . PHP_EOL);
    echo json_encode("Debugging error: " . mysqli_connect_error() . PHP_EOL);
    exit;
} else {
    if ($_GET['type'] === 'edit_plot') {


        $content = mysqli_real_escape_string($database, $_POST['content']);
        $id = $_SESSION['id'];

        $query = "UPDATE Plots
                  SET Plot = '$content'
                  WHERE ID = '$id'";


        if ($database->query($query) === TRUE) {
            echo json_encode("Record added " . $database->error);
        } else {
            echo json_encode("Error updating record: " . $database->error);
        }
    } elseif ($_GET['type'] === 'check_person') {
        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);


        $res_check_query = check_for_person($nom, $prenom, $database);

        if (mysqli_num_rows($res_check_query) !== 0) {
            echo json_encode($res_check_query->fetch_all());
        } else {
            echo json_encode("not found");
        }


    } elseif ($_GET['type'] === 'add_person') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $genre = mysqli_real_escape_string($database, $_POST['genre']);
        $all_nums = get_all_nums_for_name($nom, $prenom, $database)->fetch_all();
        $numero = get_numero($all_nums);

        add_person($nom, $prenom, $numero, $genre, $database);
        echo json_encode($numero);


    } elseif ($_GET['type'] === 'add_in_tb_actor') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        echo json_encode(add_actor($nom, $prenom, $numero, $database));

    } elseif ($_GET['type'] === 'add_role') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $role = mysqli_real_escape_string($database, $_POST['role']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);

        echo json_encode(add_role($nom, $prenom, $numero, $role, $OID, $database));

    } elseif ($_GET['type'] === 'add_plot') {


        $content = mysqli_real_escape_string($database, $_POST['content']);
        $id = $_SESSION['id'];
        echo json_encode($id);

        $query = "INSERT INTO Plots(ID, Plot)
                  VALUE ('$id', '$content')";


        if ($database->query($query) === TRUE) {
            //echo json_encode("Record added " . $database->error);
        } else {
            //echo json_encode("Error updating record: " . $database->error);
        }
    } elseif ($_GET['type'] === 'remove_actor_from_work') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);


        echo json_encode(remove_role($nom, $prenom, $numero, $OID, $database));

    } elseif ($_GET['type'] === 'remove_director_from_work') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);


        echo json_encode(remove_isDirectedby($nom, $prenom, $numero, $OID, $database));

    } elseif ($_GET['type'] === 'remove_writer_from_work') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);


        echo json_encode(remove_isWrittenBy($nom, $prenom, $numero, $OID, $database));

    } elseif ($_GET['type'] === 'add_in_tb_director') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        echo json_encode(add_director($nom, $prenom, $numero, $database));

    } elseif ($_GET['type'] === 'add_in_tb_directedBy') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);

        echo json_encode(add_directedBy($nom, $prenom, $numero, $OID, $database));

    } elseif ($_GET['type'] === 'add_in_tb_writer') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        echo json_encode(add_writer($nom, $prenom, $numero, $database));

    } elseif ($_GET['type'] === 'add_in_tb_writtenBy') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $numero = mysqli_real_escape_string($database, $_POST['num']);
        $OID = mysqli_real_escape_string($database, $_SESSION['id']);

        echo json_encode(add_writtenBy($nom, $prenom, $numero, $OID, $database));

    } elseif ($_GET['type'] === 'remove_work') {


        $ID = mysqli_real_escape_string($database, $_SESSION['id']);

        echo json_encode(remove_work($ID, $database));
    }
}



?>


