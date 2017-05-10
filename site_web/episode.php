<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
-->

<?php
include "tools.php";

session_start();
$id = urldecode($_GET['id']);
$_SESSION['id'] = $id;
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

<?php include "commonMovieEpisode.php"; ?>

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
$logged = 0;
if (isset($_SESSION['logged'])) {
    $logged = 1;
}
?>

<script>

    var plot = "<?php echo addslashes($plot);?>";
    var logged = <?php echo $logged;?>;
    if (logged === 1) {
        addAdminElementsFilmEpisode(plot);
    }
</script>

</html>
