<?php


function createDB($database){
    $tables = file_get_contents('ddl.sql');
    echo $tables;
    $database->multi_query($tables);
}

function fillDB($database){
    $load_data = file_get_contents('load_data.sql');
    echo $load_data;
    $database->multi_query($load_data);
}


$connexion = new mysqli("localhost","root","");
$connexion->query("CREATE DATABASE database;");
$connexion->close();
$database = new mysqli("localhost","root","","database");

createDB($database);
echo "db created";

fillDB($database);
echo "db filled";

$database->close();

?>