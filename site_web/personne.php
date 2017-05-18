<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page d'acceuill de site web.
-->

<?php
include "type.php";
include "tools.php";
session_start();
$id = urldecode($_GET['id']);
$_SESSION['id'] = $id;

$database = new mysqli("localhost", "root", "imdb", "IMDB");
$id = mysqli_real_escape_string($database, $id);
$keywords = preg_split('[;]', $id);
$firstname = $keywords[0];
$lastname = $keywords[1];
$firstname_escape = mysqli_real_escape_string($database, $keywords[0]);
$lastname_escape = mysqli_real_escape_string($database, $keywords[1]);
$numero = $keywords[2];

if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    //fetch his roles
    $querry = "SELECT OID, Role 
              FROM Role 
              WHERE Prenom = '$firstname_escape' AND Nom = '$lastname_escape'AND Numero = '$numero'";
    $roles = $database->query($querry);


    // fetch his directed movies
    $querry = "SELECT OID 
               FROM DirigePar 
               WHERE Prenom = '$firstname_escape' AND Nom = '$lastname_escape'AND Numero = '$numero'";
    $directed = $database->query($querry);


    // fetch his written movies
    $querry = "SELECT OID 
               FROM EcritPar 
               WHERE Prenom = '$firstname_escape' AND Nom = '$lastname_escape'AND Numero = '$numero'";
    $written = $database->query($querry);

}


function printCategories($roles, $directed, $written)
{
    /* print les differentes categories auquelles la personne appartient (acteurs, auteur, directeur)*/
    $string = "";
    $categories = [];
    if (mysqli_num_rows($roles) != 0) {
        array_push($categories, 'Acteur');
    }
    if (mysqli_num_rows($directed) != 0) {
        array_push($categories, 'Directeur');
    }
    if (mysqli_num_rows($written) != 0) {
        array_push($categories, 'Auteur');
    }

    $i = 0;
    foreach ($categories as $elem) {
        if ($i != sizeof($categories) - 1) {
            $string .= $elem . ' - ';
        } else {
            $string .= $elem;
        }

        $i++;
    }

    echo $string;
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
    <link href="css/film.css" rel="stylesheet">

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
    <script src="./js/dynamic_part.js"></script>


</head>

<body id="page-top" class="index">

<!-- Navigation -->
<?php
include 'menubar.php';


$nb_roles = mysqli_num_rows($roles);
$nb_written = mysqli_num_rows($written);
$nb_directed = mysqli_num_rows($directed);
?>

<!-- Header -->

<header>
    <div class="container">
        <div class="intro-text" id="intro">

            <div class="col-lg-4" style="display: block; margin: auto">
                <img class="profil_pic"
                     src="https://www.velvetjobs.com/assets/noavatar-profile.jpg" style="height: 300px; width:auto">
            </div>

            <div class="intro-heading">
                <?php echo $firstname . ' ' . $lastname;

                if ($numero != 'NA') {
                    echo ' (' . $numero . ')';
                }
                ?>
            </div>
            <div class=infos><?php printCategories($roles, $directed, $written) ?></div>
            <div class=intro-lead-in><?php ?></div>
        </div>
    </div>


</header>

<script>
    add_navbar([["Acteur", "Roles"],
        ["Auteur", "Written"], ["Directeur", "Directed"]])
</script>

<section id="Roles" class="bg-light-gray">
    <div class="container" id="roles-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="roles-title">Roles</h2>
            </div>
        </div>

        <?php
        echo "<table id = \"roles_table\">";

        while ($roles_row = mysqli_fetch_array($roles)) {
            $id = $roles_row['OID'];
            $role = $roles_row['Role'];
            $title = titleFromID($id, $database);
            $date = dateFromID($id, $database);
            if ($date === 0) {
                $date = '?';
            }
            echo "<tr class = 'row_t'>";
            echo "<td >";

            if (isFilm($id)) {
                echo '<a href="film.php?id=' . urlencode($id) . '">' . $title . ' (' . $date . ')' . '</a>';
            } elseif (isSerie($id)) {
                echo '<a href="serie.php?id=' . urlencode($id) . '">' . $title . ' (' . $date . ')' . '</a>';
            } else {
                echo '<a href="episode.php?id=' . urlencode($id) . '">' . $title . ' (' . $date . ')' . '</a>';
            }
            echo "</td>";
            echo "<td >" . $role . "</td>";
            echo "</td>";
            echo "<td class ='hidden'>$id</td>";
            echo "</tr>";
            //echo '<a href="film_episode.php?id='.urlencode($actors_row['Prenom']).'">'.$actors_row['ID'].'</a>';
        }
        echo "</table>";
        ?>
    </div>
</section>


<section id="Written">
    <div class="container" id="written-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="writer-person-title">Auteur</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' id = \"written_table\" > ";

        while ($written_row = mysqli_fetch_array($written)) {
            $id = $written_row['OID'];
            $title = titleFromID($id, $database);
            echo "<tr class = 'row_t'>";
            echo "<td >";

            if (isFilm($id)) {
                echo '<a href="film.php?id=' . urlencode($id) . '">' . $title . '</a>';
            } elseif (isSerie($id)) {
                echo '<a href="serie.php?id=' . urlencode($id) . '">' . $title . '</a>';
            } else {
                echo '<a href="episode.php?id=' . urlencode($id) . '">' . $title . '</a>';
            }
            echo "</td>";
            echo "<td class ='hidden'>$id</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</section>

<section id="Directed" class="bg-light-gray">
    <div class="container" id="directed-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="director-person-title">Directeur</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' id = \"directed_table\" >";

        while ($directed_row = mysqli_fetch_array($directed)) {
            $id = $directed_row['OID'];
            $title = titleFromID($id, $database);
            echo "<tr class = 'row_t'>";
            echo "<td >";

            if (isFilm($id)) {
                echo '<a href="film.php?id=' . urlencode($id) . '">' . $title . '</a>';
            } elseif (isSerie($id)) {
                echo '<a href="serie.php?id=' . urlencode($id) . '">' . $title . '</a>';
            } else {
                echo '<a href="episode.php?id=' . urlencode($id) . '">' . $title . '</a>';
            }
            echo "</td>";
            echo "<td class ='hidden'>$id</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
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
<script src="js/agency.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#intro").fadeIn(2000);
        $(window).scroll(function () {

            if ($(window).scrollTop() > 892 - 171) {
                $('#nav_bar').addClass('navbar-top');
            }

            if ($(window).scrollTop() < 892 - 170) {
                $('#nav_bar').removeClass('navbar-top');
            }
        });
    });

</script>

<script src="./js/themoviedb.js"></script>
<script src="./js/API.js"></script>

<script>

    var firstname = "<?php echo $firstname;?>";
    var lastname = "<?php echo $lastname;?>";
    $(document).ready(function () {
        getPersonPic(firstname, lastname)
    });

</script>

<script>
    var number_roles = "<?php echo $nb_roles;?>";
    var number_written = "<?php echo $nb_written;?>";
    var number_directed = "<?php echo $nb_directed;?>";
    add_dynamic_part_person(number_roles, number_written, number_directed);
</script>


<?php
$logged = 0;
if (isset($_SESSION['logged'])) {
    $logged = 1;
}

$database->close();
?>

<script>

    var logged = <?php echo $logged;?>;
    console.log(logged);
    if (logged == 1) {
        addAdminElementsPerson();
        modifyRows();
        addheaderOptions("person")
    }
</script>

</html>
