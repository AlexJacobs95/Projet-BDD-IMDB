<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
-->

<?php
include "extract.php";

session_start();
$id = urldecode($_GET['id']);
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    //fecth the Serie
    $querry = "SELECT Titre, AnneeSortie, Note
                FROM Oeuvre
                WHERE ID = '$id'";
    $oeuvre = $database->query($querry);

    //fetch the episodes
    $querry = "SELECT * 
               FROM Episode
               WHERE SID ='$id'
               order by Saison, NumeroE";
    $episodes = $database->query($querry);

    //fetch saisons number
    $querry = "SELECT Saison 
               FROM Episode
               WHERE SID = '$id'
               ORDER BY Saison DESC
               LIMIT 1";
    $numSaisons = $database->query($querry);


    //fetch the endDate
    $querry = "SELECT AnneeFin
                FROM Serie
                WHERE SerieID = '$id'";

    $serie = $database->query($querry);

    //fetch countries
    $querry = "SELECT Pays
                FROM Pays
                WHERE ID = '$id'";

    $pays = $database->query($querry);

    //fetch languages
    $querry = "SELECT Langue
                FROM Langue
                WHERE ID = '$id'";


}

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
if (isset($_SESSION['logged'])) {
    include 'menubar_admin.php';
} else {
    include 'menubar.php';
}
?>

<!-- Header -->
<?php
$_numSaisons = mysqli_fetch_array($numSaisons);
$num = $_numSaisons['Saison'];
$movie_infos = mysqli_fetch_array($oeuvre);
$serie_infos = mysqli_fetch_array($serie);
$date_fin = $serie_infos['AnneeFin'];
$tire = $movie_infos['Titre'];
$date = $movie_infos['AnneeSortie'];
$note = $movie_infos['Note'];
$saison_format = '%d saison(s)';
$titre_format1 = '%s (%d-%d)';
$titre_format2 = '%s (%d-)';

$note_fomat = '%g/10'
?>
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-heading"><?php
                if ($date_fin != 0) {
                    echo sprintf($titre_format1, $tire, $date, $date_fin);
                } else {

                    echo sprintf($titre_format2, $tire, $date);
                } ?>
            </div>
            <div class=intro-lead-in><?php if ($note != _ - 1) echo sprintf($note_fomat, $note); ?></div>
        </div>
    </div>


</header>

<section id="Details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Détails</h2>
            </div>
        </div>

        <div id="div_1">
            <div class="details-member">
                <h3><?php echo "Saison"; ?></h3>
                <h4><?php echo sprintf("%d", $num ); ?></h4>
            </div>
        </div>

        <div id="div_2">
            <div class="details-member">
                <h3><?php echo "Pays"; ?></h3>
                <h4><?php extractCoutries($pays) ?></h4>
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
