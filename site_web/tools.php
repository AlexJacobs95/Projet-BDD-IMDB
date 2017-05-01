<?php

function extractGenres($array)
{
    $genres = "";
    $i = 0;
    $len = mysqli_num_rows($array);
    while ($table = mysqli_fetch_assoc($array)) {

        if ($i != $len - 1) {
            $genres .= $table['Genre'] . ' - ';
        } else {
            $genres .= $table['Genre'];
        }

        $i++;
    }

    echo $genres;
}

function extractLanguages($array)
{
    $languages = "";
    $i = 0;
    $len = mysqli_num_rows($array);
    while ($table = mysqli_fetch_array($array)) {

        if ($i != $len - 1) {
            $languages .= $table['Langue'] . ' - ';
        } else {
            $languages .= $table['Langue'];
        }

        $i++;
    }

    echo $languages;
}

function extractCoutries($array)
{
    $countries = "";
    $i = 0;
    $len = mysqli_num_rows($array);
    while ($table = mysqli_fetch_array($array)) {

        if ($i != $len - 1) {
            $countries .= $table['Pays'] . ' - ';
        } else {
            $countries .= $table['Pays'];
        }

        $i++;
    }

    echo $countries;
}

function titleFromID($id, $db)
{


    $id_ok = mysqli_real_escape_string($db, $id);

    $querry = "SELECT Titre 
               FROM Oeuvre 
               WHERE ID = '$id_ok'";
    $result = $db->query($querry);
    $row = mysqli_fetch_array($result);

    return $row['Titre'];
}
?>