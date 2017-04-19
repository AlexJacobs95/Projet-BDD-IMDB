<?php

function createDB($database){
    $tables = file_get_contents('ddl.sql');
    $database->multi_query($tables);
}

function fillDB($database){
    $load_data = file_get_contents('load_data.sql');
    echo $load_data;
    $database->multi_query($load_data);
}

$connexion = new mysqli("localhost","root","");
$connexion->query("CREATE DATABASE projetDB;");
$connexion->close();

//$conn = mysqli_init();
//mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);
//mysqli_real_connect($conn,"localhost","root","","projetDB");

$database = new mysqli("localhost","root","","projetDB");

createDB($database);
echo "db created";

fillDB($database);
echo "db filled";

$database->close();

?>