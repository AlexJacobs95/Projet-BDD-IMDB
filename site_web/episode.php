<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
-->

<?php
include "tools.php";

session_start();
$id = urldecode($_GET['id']);
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
    $id = mysqli_real_escape_string($database, $id);

    //fecth the movie
    $query = "SELECT Titre, AnneeSortie, Note
                FROM Oeuvre
                WHERE ID = '$id'";
    $movie = $database->query($query);

    //fecth the roles
    $query = "SELECT Prenom, Nom, Numero, Role 
                FROM Role
                WHERE OID = '$id'";

    $roles = $database->query($query);

    //fecth the writers
    $query = "SELECT Prenom, Nom, Numero 
                FROM EcritPar
                WHERE OID = '$id'";

    $writers = $database->query($query);

    //fecth the directors
    $query = "SELECT Prenom, Nom, Numero
                FROM DirigePar
                WHERE OID = '$id'";

    $directors = $database->query($query);

    //fetch countries
    $query = "SELECT Pays
                FROM Pays
                WHERE ID = '$id'";

    $pays = $database->query($query);

    //fetch languages
    $query = "SELECT Langue
                FROM Langue
                WHERE ID = '$id'";

    $languages = $database->query($query);

    //fetch genres
    $query = "SELECT Genre
                FROM Genre
                WHERE ID = '$id'";

    $genres = $database->query($query);

    //fetch ep infos
    $query = "SELECT TitreS, NumeroE, Saison, SID
              FROM Episode
              WHERE EpisodeID = '$id'";

    $ep_infos = $database->query($query);

    //fetch plot
    $querry = "SELECT Plot
               FROM Plots
               WHERE ID = '$id'";

    $plot_res = $database->query($querry);

}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <title>IMD - International movie database</title>

    <!-- Bootstrap Core CSS -->

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="test_css/film.css" rel="stylesheet">

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


<?php
$movie_infos = mysqli_fetch_array($movie);
$plot_info = mysqli_fetch_array($plot_res);
$titre = $movie_infos['Titre'];
$date = $movie_infos['AnneeSortie'];
$note = $movie_infos['Note'];
$titre_format = '%s (%d)';
$note_fomat = '%g/10';
$plot = $plot_info['Plot'];
$nb_roles = mysqli_num_rows($roles);
$havePlot = mysqli_num_rows($plot_res);
?>

<header>
    <div class="container">
        <div class="intro-text" id = "intro">
            <div class="intro-heading"><?php echo sprintf($titre_format, $titre, $date); ?></div>
            <div class="infos"><?php extractEpInfos($ep_infos); ?></div>

            <div class=infos><?php extractGenres($genres) ?></div>
            <div class=intro-lead-in><?php if ($note != -1) echo sprintf($note_fomat, $note); ?></div>
            <div class=infos><?php sprintf($ep_infos_format, $titreS, $epNum, $saisonNum); ?></div>

        </div>
    </div>


</header>

<section id="Resume">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id=resume_block>
                <h2 class="section-heading">Résumé</h2>
                <div class="content hideContent-plot" id="plot"><span> <?php echo $plot ?> </span></div>

            </div>
        </div>
    </div>
</section>

<section id="Acteurs" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id="actors">
                <h2 class="section-heading" id="actor-title">Acteurs</h2>
                <?php
                echo "<table border=1 frame=void rules=rows id = \"actors_table\">";

                while ($actors_row = mysqli_fetch_array($roles)) {
                    $fn = $actors_row['Prenom'];
                    $ln = $actors_row['Nom'];
                    $num = $actors_row['Numero'];
                    $role = $actors_row['Role'];
                    $nom = sprintf('%s %s', $fn, $ln);
                    echo "<tr>";
                    echo "<td >";
                    echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
                    echo "</td>";
                    echo "<td >" . $role . "</td></tr>";
                    //echo '<a href="film.php?id='.urlencode($actors_row['Prenom']).'">'.$actors_row['ID'].'</a>';
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</section>


<section id="Directeurs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="director-title">Directeurs</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' border=1 frame=void rules=rows>";

        while ($directors_row = mysqli_fetch_array($directors)) {
            $fn = $directors_row['Prenom'];
            $ln = $directors_row['Nom'];
            $num = $directors_row['Numero'];
            $nom = sprintf('%s %s', $fn, $ln); //prenom + nom
            echo "<tr>";
            echo "<td >";
            echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
            echo "</td>";
            echo "</tr>";
            //echo '<a href="film.php?id='.urlencode($actors_row['Prenom']).'">'.$actors_row['ID'].'</a>';
        }
        echo "</table>";
        ?>
    </div>
</section>


<section id="Auteurs" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="writer-title">Auteurs</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' >";

        while ($writers_row = mysqli_fetch_array($writers)) {
            $fn = $writers_row['Prenom'];
            $ln = $writers_row['Nom'];
            $num = $writers_row['Numero'];
            $nom = sprintf('%s %s', $fn, $ln); //prenom + nom
            echo "<tr>";
            echo "<td >";
            echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</section>

<section id="Details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="detail-title">Détails</h2>
            </div>
        </div>
        <div id="div_1">
            <div class="details-member">
                <h3><?php echo "Pays"; ?></h3>
                <h4><?php extractCoutries($pays) ?></h4>
            </div>
        </div>

        <div id="div_2">
            <div class="details-member">
                <h3><?php echo "Langues"; ?></h3>
                <h4><?php extractLanguages($languages) ?></h4>
            </div>
        </div>

    </div>
</section>

<?php
include "popUpForm.php";
?>

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

<script type="text/javascript">
    $(document).ready(function () {
        $("#intro").fadeIn(2000);
    });

</script>

<script src="dynamic_part.js"></script>

<script>
    var havePlot = "<?php echo $havePlot;?>";
    var number_roles = "<?php echo $nb_roles;?>";
    add_dynamic_part_filmAndEp(havePlot, number_roles, 'hideContent-plot', 'hideContent-actors')
</script>

<?php
if (isset($_SESSION['logged'])) {
    echo "<script>";
    echo "addAdminElementsFilmEpisode()";
    echo "</script>";
}

?>


</html>
