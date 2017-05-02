<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page d'acceuill de site web.
-->

<?php
session_start();
include "type.php";
?>



<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <title>IMD - International movie database</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="test_css/search_results.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"
            integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY"
            crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"
            integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo"
            crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

<!-- Navigation -->
<?php
include 'menubar.php';
?>

<!-- Header -->
<header>
    Résultats

</header>

<section id="Oeuvres" class="blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="titre-section">Oeuvres</h2>
                <?php

                if (isset($_POST['requete'])) {
                    if ($_POST['requete'] == "Requete 4") {
                        $requete = "select distinct e.EpisodeID, e.SID From Episode e where no exists( Select * from Acteur a, Personne p where p.Numero = a.Numero and p.Genre = 'm' and a.OID = e.SID";
                    }
                    if ($_POST['requete'] == "Requete 6") {
                    }
                }
                else {
                    $search_content = $_POST["search"];

                    $database = new mysqli("localhost", "root", "imdb", "IMDB");
                    if (!$database) {
                        echo "Error: Unable to connect to MySQL." . PHP_EOL;
                        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                        exit;
                    } else {
                        $requete = "SELECT ID
                                    FROM Oeuvre
                                    WHERE Titre = '$search_content'";

                        $oeuvres = $database->query($requete);
                        echo "<table>
                        <tr>
                        <th>ID</th>
                        </tr>";

                        while ($row = mysqli_fetch_array($oeuvres)) {
                            echo "<tr>";
                            echo "<td>";

                            if (isFilm($row['ID'])) {
                                echo '<a href="film.php?id=' . urlencode($row['ID']) . '">' . $row['ID'] . '</a>';
                            } elseif (isEpisode($row['ID'])) {
                                echo '<a href="episode.php?id=' . urlencode($row['ID']) . '">' . $row['ID'] . '</a>';
                            } else {
                                echo '<a href="serie.php?id=' . urlencode($row['ID']) . '">' . $row['ID'] . '</a>';
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                ?>
            </div>
        </div>

    </div>
</section>

<section id="Personnes" class="blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="titre-section">Personnes</h2>
                <?php
                if (isset($_POST['requete'])) {
                    if ($_POST['requete'] == "Requete 1") {
                        $requete = "Select distinct a.Nom, a.Prenom, a.Numero From Acteur a where 5 = (Select count(*) From Oeuvre o where o.AnneeSortie >='2003' and o.AnneeSortie <= '2007' and a.OID = o.ID)";
                    }
                    if ($_POST['requete'] == "Requete 2") {
                        $requete = "Select distinct a.Nom, a.Prenom, a.Numero From Auteur a, Oeuvre o where a.OID = o.ID having by count(a.OID) >= 2";
                    }
                    if ($_POST['requete'] == "Requete 3") {
                    }
                    if ($_POST['requete'] == "Requete 5") {
                    }
                }
                ?>
            </div>
        </div>

    </div>
</section>

</body>
<!-- jQuery -->

<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"
        integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb"
        crossorigin="anonymous"></script>

<!-- Theme JavaScript -->
<script src="test_js/agency.min.js"></script>

</html>
