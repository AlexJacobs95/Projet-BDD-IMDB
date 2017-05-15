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
    //fecth the Serie
    $querry = "SELECT Titre, AnneeSortie, Note
                FROM Oeuvre
                WHERE ID = '$id'";
    $oeuvre = $database->query($querry);

    //fetch the episodes
    $querry = "SELECT * 
               FROM Episode
               WHERE SID ='$id'"
;
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

    $languages = $database->query($querry);


    //fetch genres
    $querry = "SELECT Genre
                FROM Genre
                WHERE ID = '$id'";

    $genres = $database->query($querry);

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
    <script src="dynamic_part.js"></script>



</head>

<body id="page-top" class="index">

<!-- Navigation -->
<?php

include 'menubar.php';

?>

<!-- Header -->
<?php
$_numSaisons = mysqli_fetch_array($numSaisons);
$movie_infos = mysqli_fetch_array($oeuvre);
$plot_info = mysqli_fetch_array($plot_res);
$serie_infos = mysqli_fetch_array($serie);
$num = $_numSaisons['Saison'];
$date_fin = $serie_infos['AnneeFin'];
$titre = $movie_infos['Titre'];
$date = $movie_infos['AnneeSortie'];
$dateAndTitre = $date . "|" . $titre;
$note = $movie_infos['Note'];
$saison_format = '%d saison(s)';
$date_format1 = '%d-%d';
$date_format2 = '%d-';

$note_fomat = '%g/10';
$plot = $plot_info['Plot'];
$havePlot = mysqli_num_rows($plot_res);

$i = 0;
while ($episodes_row = mysqli_fetch_array($episodes)) {
    $sn = $episodes_row['Saison'];
    $eID = $episodes_row['EpisodeID'];
    $eNum = $episodes_row['NumeroE'];
    if ($sn != -1 ) {
        $title = titleFromID($eID, $database);
        $res[$sn][(string)$eNum] = array();
        $res[$sn][(string)$eNum]["id"] = utf8_encode($eID);
        $res[$sn][(string)$eNum]["title"] = utf8_encode($title);
    } else {
        $i++;
        $inconnue = true;
        $res["inconnue"][(string)$i] = array();
        $res["inconnue"][(string)$i]["id"] = utf8_encode($eID);
        $res["inconnue"][(string)$i]["title"] = utf8_encode($title);

    }


}
?>
<header>

    <div class="container">
        <div class="row">
            <div class="col-lg-4" style="text-align: center">
                <img class="poster"
                     src="https://s-media-cache-ak0.pinimg.com/originals/f3/5a/d9/f35ad9427be01af5955e6a6ce803f5dc.jpg">
            </div>
            <div class="col-lg-8">
                <div class="intro-text" id="intro" style="display: none">
                    <div class="intro-heading-with-no-margin" id="titre"><?php echo $titre; ?></div>
                    <div class="intro-heading" id="date"><?php
                        if ($date_fin != 0) {
                            echo sprintf($date_format1, $date, $date_fin);
                        } else {

                            echo sprintf($date_format2, $date);
                        }
                        ?>
                    </div>
                    <div class=infos><?php extractGenres($genres) ?></div>
                    <div class=intro-lead-in><?php if ($note != '_' - 1) echo sprintf($note_fomat, $note); ?></div>
                    <a href="https://twitter.com/share"
                       class="twitter-share-button"
                       data-show-count="false"
                       data-text="Hey jetez un coups d'oeil à cette série"
                       data-hashtags="imdb"
                       data-related="twitterapi,twitter">Tweet</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>


</header>

<script>
add_navbar([["Résumé", "Resume"], ["Détails","Details"], ["Saisons", "Saisons"]]);
</script>

<section id="Resume">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id=resume_block>
                <h2 class="section-heading" id="resume-title">Résumé</h2>
                <div class="content hideContent-plot" id="plot"><span> <?php echo $plot ?> </span></div>

            </div>
        </div>
    </div>
</section>

<section id="Details" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Détails</h2>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="details-member">
                <h3>Saisons</h3>
                <h4><?php if ($num != -1){echo sprintf("%d", $num );} else {echo "1";} ?></h4>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="details-member">
                <h3>Pays</h3>
                <h4><?php extractCoutries($pays) ?></h4>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="details-member">
                <h3>Langues</h3>
                <h4><?php extractLanguages($languages) ?></h4>
            </div>
        </div>


    </div>
</section>


<section id="Saisons">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Saisons</h2>
            </div>
        </div>

        <?php
        if ($num != 0) {
            echo "<ul class=\"nav nav-pills nav-justified\">";
            $i = 0;
            foreach (range(1, $num) as $current) {

                echo "<li><a data-toggle=\"pill\" onClick=getEpisodes($current)>$current</a></li>";

            }
            if ($inconnue){
                echo "<li><a data-toggle=\"pill\" onClick=getEpisodes(\"inconnue\")>Inconnue</a></li>";


            }
        } else echo "<div style='font-family: \"Roboto Slab\", \"Helvetica Neue\", Helvetica, Arial, sans-serif;
    font-size: 20px;' align='center'>Aucune Saison disponible</div>";
        echo "</ul>";

        ?>

        <div id="episodes_place"></div>


        <script>

            console.log(<?php echo json_encode($res); ?>);
            function getEpisodes(saison)
            {

                var array = <?php echo json_encode($res); ?>;
                console.log(array[saison]);

                var div = document.getElementById('episodes_place');

                ul = document.createElement('ul'); // create an arbitrary ul element
                ul.setAttribute("class", "list-group text-center");

                var i = 0;
                for (var i in array[saison]) {
                    // create an arbitrary li element
                    console.log(array[saison][i]['title']);
                    var li = document.createElement('li'),
                        content = document.createTextNode(Number(i) + " - " + array[saison][i]["title"]); // create a textnode to the document
                    li.setAttribute("class", "list-group-item");

                    li.appendChild(content);
                    var a = document.createElement('a'),
                        content2 = li;
                    a.setAttribute("href", "episode.php?id=" + encodeURIComponent(array[saison][i]["id"]));
                    a.appendChild(content2)
                    a.setAttribute("class", "episode");

                    ul.appendChild(a); // append the created li element above to the ul element
                }
                div.innerHTML = '';
                div.appendChild(ul); // finally the ul element to the div with an id of placeholder

            }
        </script>



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
<script src="themoviedb.js"></script>
<script src="API.js"></script>

<?php include "commentSection.php" ?>


<script>

    var titre = "<?php echo $titre;?>";
    var date = "<?php echo $date;?>";
    $(document).ready(function () {
        $("#intro").fadeIn(2000);
        getImagesTvShow(titre, date);
        $(window).scroll(function () {

            if ($(window).scrollTop() > 892 - 61) {
                $('#nav_bar').addClass('navbar-top');
            }

            if ($(window).scrollTop() < 892 -60) {
                $('#nav_bar').removeClass('navbar-top');
            }
        });

    });

    var havePlot = "<?php echo $havePlot;?>";
    add_dynamic_part_series(havePlot, 'hideContent-plot');

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
    console.log(logged);
    if (logged == 1) {
        addAdminElementsSerie(plot);

    }
</script>


</html>
