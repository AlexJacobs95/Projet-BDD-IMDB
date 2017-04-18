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


$connexion = new mysqli("localhost","root","mamouche97");
$connexion->query("CREATE DATABASE projetDB;");
$connexion->close();
$database = new mysqli("localhost","root","mamouche97","projetDB");

createDB($database);
echo "db created";

fillDB($database);
echo "db filled";

$database->close();

?>