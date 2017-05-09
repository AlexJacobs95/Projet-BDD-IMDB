<?php
session_start();

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
    } elseif ($_GET['type'] === 'edit_actors') {}

}
?>





