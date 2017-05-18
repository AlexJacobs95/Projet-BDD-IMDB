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

function extractEpInfos($ep_infos, $serie_title)
{
    $episode_infos = mysqli_fetch_array($ep_infos);
    $serie_ID = $episode_infos['SID'];
    $epNum = $episode_infos['NumeroE'];
    $saisonNum = $episode_infos['Saison'];

    $titre = mysqli_fetch_array($serie_title);
    $titreS = $titre['Titre'];


    $string = '<a style= "color: white;" href="serie.php?id=' . urlencode($serie_ID) . '">' . $titreS . '</a>';
    if ($epNum != -1) {
        $string .= ' | episode ' . $epNum;
    }
    if ($saisonNum != -1) {
        $string .= ' | saison ' . $saisonNum;
    }
    echo $string;
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

    return utf8_encode($row['Titre']);
}

function DateFromID($id, $db)
{


    $id_ok = mysqli_real_escape_string($db, $id);

    $querry = "SELECT AnneeSortie 
               FROM Oeuvre 
               WHERE ID = '$id_ok'";
    $result = $db->query($querry);
    $row = mysqli_fetch_array($result);

    return $row['AnneeSortie'];
}

?>