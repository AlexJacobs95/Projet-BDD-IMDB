<?php
session_start();

function execute_add_query($query, $db)
{
    if ($db->query($query) === TRUE) {
        return ("Record added " . $db->error);
    } else {
        return ("Error updating record: " . $db->error);
    }
}


function count_nb_movies_by_year($db)
{
    $query = "select AnneeSortie, count(*)
              from(
                    SELECT ID, AnneeSortie
                    FROM Oeuvre INNER JOIN Film on Oeuvre.ID = Film.FilmID
                    ) t
              where AnneeSortie < 2017
              group by AnneeSortie";

    return $db->query($query);

}

function count_nb_series_by_year($db)
{
    $query = "select AnneeSortie, count(*)
              from(
                    SELECT ID, AnneeSortie
                    FROM Oeuvre INNER JOIN Serie on Oeuvre.ID = Serie.SerieID
                    ) t
              where AnneeSortie < 2017
              group by AnneeSortie";

    return $db->query($query);

}

function count_nb_man_and_women($db)
{
    $query = "select Genre, count(*)
              from(
                    SELECT Genre
                    FROM Personne INNER JOIN Acteur on Personne.Prenom = Acteur.Prenom AND Personne.Nom = Acteur.Nom AND Personne.Numero = Acteur.Numero) t
              group by Genre";

    return $db->query($query);

}

function count_movies_series_episodes($db)
{
    $query = "SELECT *
              FROM ( select count(*) from Film) A 
              CROSS JOIN (select count(*) from Episode) B 
              CROSS JOIN (select count(*) from Serie) c ";

    return $db->query($query);

}

function count_movies_by_country($db)
{
    $query = "SELECT distinct(Pays), count(*) as num 
              FROM Pays group by Pays
              ORDER BY num desc;";

    return $db->query($query);

}

function notes_evolution($db)
{
    $query = "select AnneeSortie, AVG(Note) 
              from Oeuvre 
              WHERE NOTE != -1 AND AnneeSortie >= 2000 
              group by AnneeSortie 
              Order by AnneeSortie ASC;";

    return $db->query($query);

}


$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo json_encode("Error: Unable to connect to MySQL." . PHP_EOL);
    echo json_encode("Debugging errno: " . mysqli_connect_errno() . PHP_EOL);
    echo json_encode("Debugging error: " . mysqli_connect_error() . PHP_EOL);
    exit;
} else {
    if ($_GET['type'] === 'nb_movies') {

        $res = count_nb_movies_by_year($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);

    } else if ($_GET['type'] === 'nb_series') {
        $res = count_nb_series_by_year($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);

    } else if ($_GET['type'] === 'nb_man_and_women') {
        $res = count_nb_man_and_women($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);

    } else if ($_GET['type'] === 'nb_movies_by_country') {
        $res = count_movies_by_country($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);

    } else if ($_GET['type'] === 'nb_movies_series_episodes') {
        $res = count_movies_series_episodes($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);
    } else if ($_GET['type'] === 'notes_evolution') {
        $res = notes_evolution($database);
        $data = mysqli_fetch_all($res);
        echo json_encode($data);
    }


    $database->close();

}
