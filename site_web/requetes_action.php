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
            $ln = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            $link = utf8_encode("<a href='personne.php?id=" . urlencode($fn . ";" . $ln . ";" . $num) . "'>" . $fn . ' ' . $ln . "</a>");
            array_push($rows, [$link, $num]);
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
            $ln = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            $link = utf8_encode("<a href='personne.php?id=" . urlencode($fn . ";" . $ln . ";" . $num) . "'>" . $fn . ' ' . $ln . "</a>");
            array_push($rows, [$link, $num]);
        }

        echo json_encode($rows);

    } else if ($_GET['requete'] == "Requete 3") {
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
            $ln = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            $link = utf8_encode("<a href='personne.php?id=" . urlencode($fn . ";" . $ln . ";" . $num) . "'>" . $fn . ' ' . $ln . "</a>");
            array_push($rows, [$link, $num]);
        }

        echo json_encode($rows);

    } else if ($_GET['requete'] == "Requete 4") {
        $requete = "SELECT DISTINCT EpisodeID
                        FROM Episode e
                        WHERE NOT EXISTS(
                            SELECT Genre, EpisodeID
                            FROM Role INNER JOIN Personne ON  Personne.Nom = Role.Nom AND Personne.Prenom = Role.Prenom AND Personne.Numero  = Role.Numero
                            WHERE genre = 'm' AND OID = e.EpisodeID)";

        $res = $database->query($requete);
        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $link = utf8_encode('<a href="' . "episode" . '.php?id=' . urlencode($row['EpisodeID']) . '">' . utf8_encode($row['EpisodeID']) . '</a>');
            array_push($rows, [$link]);
        }

        echo json_encode($rows);

    } else if ($_GET['requete'] == "Requete 5") {
        $requete = "select Prenom, Nom, Numero, count(*)nb
                        FROM(
                            select SID, Prenom, Nom, Numero
                            from Episode
                            inner join Role on OID = EpisodeID
                            group by  SID, Prenom, Nom, Numero)t
                        group by  Prenom, Nom, Numero
                        order by nb desc
                        LIMIT 1";

        $res = $database->query($requete);

        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $fn = utf8_encode($row["Prenom"]);
            $ln = utf8_encode($row["Nom"]);
            $num = utf8_encode($row["Numero"]);
            $nb = utf8_encode($row["nb"]);

            $link = utf8_encode("<a href='personne.php?id=" . urlencode($fn . ";" . $ln . ";" . $num) . "'>" . $fn . ' ' . $ln . "</a>");
            array_push($rows, [$link, $num, $nb]);
        }

        echo json_encode($rows);

    } else if ($_GET['requete'] == "Requete 6") {
        $requete = "SELECT T3.SID as SID, ep_num, avg_ep_by_year, avg_actor_by_season
                        FROM (
                            (SELECT ID, count(*) as ep_num
                            FROM(
                                SELECT ID, EpisodeID
                                FROM(
                                 SELECT ID
                                 FROM Serie INNER Join Oeuvre on Oeuvre.ID = Serie.SerieID
                                 WHERE note >(
                                     SELECT AVG(note)
                                     FROM(
                                     SELECT note
                                     FROM Serie INNER Join Oeuvre on Oeuvre.ID = Serie.SerieID
                                     WHERE note != -1 and AnneeSortie !=0) as t)) as Series_OK
                                 INNER JOIN Episode ON Series_OK.ID = Episode.SID) as t
                                 GROUP BY ID)T1
                        
                            inner join
                        
                             (
                                 SELECT SID, avg(num) as avg_actor_by_season
                                 FROM(
                                    SELECT SID, count(*) as num
                                    FROM(
                                        SELECT Nom, Prenom, Numero, SID, Saison
                                            FROM(
                                            SELECT SID, EpisodeID, Saison
                                            FROM Episode inner join Serie on SerieID = SID
                                            WHERE Saison != -1)t
                                        INNER Join Role on EpisodeID = OID
                                        Group by Nom, Prenom, Numero, SID, Saison)t2
                                    GROUP BY SID, Saison)t3
                                Group By SID)T2
                        
                            on T1.ID = T2.SID
                        
                            inner join
                        
                            (
                                SELECT t5.SID, AVG(num) as avg_ep_by_year
                                FROM(
                                 SELECT t6.SID, count(*) as num
                                 FROM(
                                     SELECT SID, ID, AnneeSortie
                                     FROM Oeuvre
                                     INNER Join Episode on EpisodeID = ID)t6
                                 WHERE AnneeSortie != 0
                                 GROUP BY t6.SID, AnneeSortie) as t5
                                Group by t5.SID)T3
                        
                            on T1.ID = T3.SID
                        )";

        $res = $database->query($requete);

        $rows = array();
        while ($row = mysqli_fetch_array($res)) {
            $serie = utf8_encode($row["SID"]);
            $ep_num = utf8_encode($row["ep_num"]);
            $avg_ep_by_year = utf8_encode($row["avg_ep_by_year"]);
            $avg_actor_by_season = utf8_encode($row["avg_actor_by_season"]);


            $link = utf8_encode('<a href="' . "serie" . '.php?id=' . urlencode($row['SID']) . '">' . utf8_encode($row['SID']) . '</a>');
            array_push($rows, [$link, $ep_num, $avg_ep_by_year, $avg_actor_by_season]);
        }

        echo json_encode($rows);
    }

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