<?php
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if ($database->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $database->connect_errno . ") " . $database->connect_error;

} else {

    if ($_GET['requete'] == "Requete 1") {
        $requete = "SELECT Nom, Prenom, Numero
                    FROM Acteur a
                    WHERE (SELECT count(distinct AnneeSortie)
                           FROM (
                                SELECT AnneeSortie, Nom, Prenom, Numero
                                FROM Oeuvre o INNER JOIN Role r
                                ON ID = OID
                                WHERE AnneeSortie BETWEEN 2003 AND 2007) t
                           WHERE t.Prenom = a.Prenom and t.Nom = a.Nom and t.Numero = a.Numero) = 5";

        $res = $database->query($requete);
        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $fn = utf8_encode($row["Prenom"]);
            $n = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            array_push($rows, [$fn, $n, $num]);
        }

        echo json_encode($rows);
    }
    if ($_GET['requete'] == "Requete 2") {
        $requete = "SELECT DISTINCT Nom, Prenom, Numero
                FROM(
                  SELECT AnneeSortie, Nom,Prenom, Numero
                  FROM Oeuvre o
                  INNER JOIN Film f ON o.ID = f.FilmID
                  INNER JOIN EcritPar ON ID = OID
                  GROUP BY AnneeSortie, Nom, Prenom, Numero
                  HAVING count(*) >=2 )t";

        $res = $database->query($requete);
        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $fn = utf8_encode($row["Prenom"]);
            $n = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            array_push($rows, [$fn, $n, $num]);
        }

        echo json_encode($rows);
    }
    if ($_GET['requete'] == "Requete 3") {
        $requete = "SELECT DISTINCT Nom, Prenom, Numero
                FROM(
                    SELECT OID
                    FROM(
                        SELECT 	R2.OID
                        FROM(
                            SELECT T2.Nom, T2.Prenom, T2.Numero, T2.OID
                            FROM(
                                SELECT R1.Prenom, R1.Nom, R1.Numero, R1.OID
                                FROM (
                                    SELECT *
                                    FROM Role
                                    WHERE Nom = 'Elliott' AND Prenom = 'Missy' AND Numero = 'NA') AS T
                                    JOIN Role R1 ON T.OID = R1.OID) AS T2
                            INNER JOIN Film F ON F.FilmID = T2.OID) AS T3
                        JOIN Role R2 ON T3.Prenom = R2.Prenom AND T3.Nom = R2.Nom AND T3.Numero = R2.Numero) AS T4
                    INNER JOIN Film F2 ON F2.FilmID = T4.OID) AS T5
                JOIN Role R3 ON T5.OID = R3.OID";

        $res = $database->query($requete);
        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $fn = utf8_encode($row["Prenom"]);
            $n = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            array_push($rows, [$fn, $n, $num]);
        }

        echo json_encode($rows);
    }
    if ($_GET['requete'] == "Requete 4") {
        $requete = "SELECT DISTINCT EpisodeID
                FROM Episode e
                WHERE NOT EXISTS(
                    SELECT Genre, EpisodeID
                    FROM Role INNER JOIN Personne ON  Personne.Nom = Role.Nom AND Personne.Prenom = Role.Prenom AND Personne.Numero  = Role.Numero
                    WHERE genre = 'm' AND OID = e.EpisodeID)";


        $res = $database->query($requete);

        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $id = utf8_encode($row["EpisodeID"]);
            array_push($rows, [$id]);
        }

        echo json_encode($rows);
    }


    $database->close();

}
/*
"SELECT DISTINCT EpisodeID
                    FROM Episode e
                    WHERE NOT EXISTS(
                        SELECT Genre, EpisodeID
                        FROM Role INNER JOIN Personne ON  Personne.Nom = Role.Nom AND Personne.Prenom = Role.Prenom AND Personne.Numero  = Role.Numero
                        WHERE genre = 'm' AND OID = e.EpisodeID)";

*/
?>