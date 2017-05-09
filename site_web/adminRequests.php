<?php
session_start();
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    if ($_GET['type'] === 'edit_plot') {


        $database = new mysqli("localhost", "root", "imdb", "IMDB");
        if (!$database) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        } else {

            $content = mysqli_real_escape_string($database, $_POST['content']);
            $id = $_SESSION['id'];
            echo $content;
            echo $id;

            $query = "UPDATE Plots
                      SET Plot = '$content'
                      WHERE ID = '$id'";


            if ($database->query($query) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $database->error;
            }
        }

    } elseif ($_GET['type'] === 'edit_actors') {


    }


}
?>







