<?php
session_start();


include "roman.php";

function get_all_nums_for_name($nom, $prenom, $db)
{
    $query = "SELECT Numero
              FROM Personne
              WHERE Nom = '$nom' AND Prenom = '$prenom'";
    return $db->query($query);
}

function get_numero($num_array)
{
    foreach ($num_array as $num) {
        $num = toNumber($num);

    }
    return toRoman(max($num) + 1);

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
    $check_if_person_exists_query = "SELECT *
                                     FROM Personne
                                     WHERE Nom = '$nom' AND Prenom = '$prenom'";
    return $db->query($check_if_person_exists_query);
}

function add_person($nom, $prenom, $numero, $db)
{
    $add_person_query = "INSERT INTO Personne(Nom, Prenom, Numero)
                         VALUE ('$nom', '$prenom', '$numero')";

    return $db->query($add_person_query);
}

function add_actor($nom, $prenom, $numero, $db)
{
    $add_actor_query = "INSERT INTO Acteur(Nom, Prenom, Numero)
                         VALUE ('$nom', '$prenom', '$numero')";

    return $db->query($add_actor_query);

}

function add_writer($nom, $prenom, $numero, $db)
{
    $add_writer_query = "INSERT INTO Auteur(Nom, Prenom, Numero)
                         VALUE ('$nom', '$prenom', '$numero')";

    return $db->query($add_writer_query);

}

function add_director($nom, $prenom, $numero, $db)
{
    $add_director_query = "INSERT INTO Directeur(Nom, Prenom, Numero)
                         VALUE ('$nom', '$prenom', '$numero')";

    return $db->query($add_director_query);

}

function add_role($nom, $prenom, $numero, $role, $db)
{
    $add_role_query = "INSERT INTO Role(Nom, Prenom, Numero, Role)
                         VALUE ('$nom', '$prenom', '$numero', '$role')";

    return $db->query($add_role_query);

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
    } elseif ($_GET['type'] === 'edit_actors') {
        //$nom = mysqli_real_escape_string($database, $_POST['name']);
        //$prenom = mysqli_real_escape_string($database, $_POST['fn']);


        //$res_check_query = check_for_person($nom, $prenom, $database);

        //if (mysqli_num_rows($res_check_query) !== 0){
        //echo json_encode("bonjour")
        //echo json_encode($res_check_query->fetch_all());
        //} else {
        //echo json_encode("not found");
        //}
        // echo json_encode("ok");


    } elseif ($_GET['type'] === 'add_person') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);

        $all_nums = get_all_nums_for_name($nom, $prenom, $database)->fetch_all();
        $numero = get_numero($all_nums);

        add_person($nom, $prenom, $numero, $database);

        echo json_encode($numero);

    } elseif ($_GET['type'] === 'add_in_tb_actor') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);

        add_actor($nom, $prenom, $numero, $database);

    } elseif ($_GET['type'] === 'add_role') {

        $nom = mysqli_real_escape_string($database, $_POST['name']);
        $prenom = mysqli_real_escape_string($database, $_POST['fn']);
        $role = mysqli_real_escape_string($database, $_POST['role']);

        add_role($nom, $prenom, $numero, $role, $database);

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
    }

}



?>


