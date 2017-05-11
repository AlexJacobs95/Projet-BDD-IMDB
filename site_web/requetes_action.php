<?php
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if ($database->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $database->connect_errno . ") " . $database->connect_error;

} else {

        if ($_GET['requete'] == "Requete 1") {
            $requete = "SELECT Nom, Prenom, Numero
                      FROM (
	                  SELECT AnneeSortie, Nom, Prenom, Numero
	                  FROM Oeuvre o INNER JOIN Role r
	                  ON ID = OID
	                  WHERE AnneeSortie BETWEEN 2003 AND 2007) t
                    GROUP BY Nom, Prenom, Numero
                    HAVING count(DISTINCT AnneeSortie) = 5";

            $res = $database->query($requete);
            echo json_encode($res->fetch_all());
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
            echo json_encode($res->fetch_all());
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
                                        WHERE Nom = 'Willis' AND Prenom = 'Bruce' AND Numero = 'NA') AS T
                                        JOIN Role R1 ON T.OID = R1.OID) AS T2
                                INNER JOIN Film F ON F.FilmID = T2.OID) AS T3
                            JOIN Role R2 ON T3.Prenom = R2.Prenom AND T3.Nom = R2.Nom AND T3.Numero = R2.Numero) AS T4
                        INNER JOIN Film F2 ON F2.FilmID = T4.OID) AS T5
                    JOIN Role R3 ON T5.OID = R3.OID";

            $res = $database->query($requete);
            echo json_encode($res->fetch_all());
        }
        if ($_GET['requete'] == "Requete 4") {
            $requete = "SELECT DISTINCT EpisodeID
                    FROM Episode e
                    WHERE NOT EXISTS(
                        SELECT Genre, EpisodeID
                        FROM Role INNER JOIN Personne ON  Personne.Nom = Role.Nom AND Personne.Prenom = Role.Prenom AND Personne.Numero  = Role.Numero
                        WHERE genre = 'm' AND OID = e.EpisodeID)";

            $res = $database->query($requete);
            echo json_encode($res->fetch_all());
        }

}

?>