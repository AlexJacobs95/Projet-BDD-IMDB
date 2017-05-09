<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page d'acceuill de site web.
-->

<?php
session_start();

function build_search($content)
{
    $search = "";
    $terms = explode(" ", $content);
    foreach ($terms as $word) {
        $search .= '+' . $word . '* ';
    }

    return substr($search, 0, strlen($search) - 1);
}

function allOneLetter($content)
{
    $terms = explode(' ', $content);
    foreach ($terms as $word) {
        if (strlen($word) > 1) {

            return false;
        }
    }

    return true;
}

$search_content = $_POST["search"];

$database = new mysqli("localhost", "root", "imdb", "IMDB");
$search_content = mysqli_real_escape_string($database, $_POST["search"]);



if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    $start_time = round(microtime(true) * 1000);


    if (allOneLetter($search_content)) { // check if all words of the content have only one letter

        $requete_oeuvre = "SELECT *
                           FROM Oeuvre
                           WHERE Titre = '$search_content'
                           COLLATE LATIN1_GENERAL_CI";

        $requete_personne = "SELECT *
                             FROM Personne
                             WHERE fullname = '$search_content'
                             COLLATE LATIN1_GENERAL_CI";


    } else {
        $search = build_search($search_content);

        $requete_oeuvre = "SELECT *
                           FROM Oeuvre
                           WHERE MATCH (Titre)
                           AGAINST ('$search' IN BOOLEAN MODE)
                           ORDER BY 
                           MATCH(Titre) against('$search' IN BOOLEAN MODE)";


        $requete_personne = "SELECT *
                             FROM Personne
                             WHERE MATCH (Prenom, Nom)
                             AGAINST ('$search' IN BOOLEAN MODE)";




    }

    $result_oeuvres = $database->query($requete_oeuvre);
    $nb_res_oeuvre = mysqli_num_rows($result_oeuvres);

    $result_personnes = $database->query($requete_personne);
    $nb_res_personnes = mysqli_num_rows($result_personnes);


    $duration = (round(microtime(true) * 1000) - $start_time) / 1000;
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
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
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

<?php

include "type.php";

$oeuvres_array = array();
$i = 0;
while ($row = mysqli_fetch_array($result_oeuvres)) {
    $type = getOeuvreType($row['ID']);
    $titre = '<a href="' . $type . '.php?id=' . urlencode($row['ID']) . '">' . utf8_encode($row['Titre']) . '</a>';
    $oeuvres_array[$i] = [
        $titre,
        utf8_encode($row['AnneeSortie']),
        $type,
        urlencode($row['ID'])
    ];
    $i = $i + 1;


}

$personne_array = array();
$i = 0;
while ($row = mysqli_fetch_array($result_personnes)) {
    $fn = utf8_encode($row['Prenom']);
    $ln = utf8_encode($row['Nom']);
    $num = utf8_encode($row['Numero']);

    $personne_array[$i] = [
        '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $fn . " " . $ln . '</a>',
        $num,
        "url" => urlencode($fn . ';' . $ln . ';' . $num)
    ];
    $i = $i + 1;

}

?>

<!-- Header -->
<header>
    <div class="intro-text">
        <div class="intro-heading">
        <?php
        echo $nb_res_oeuvre;
        echo ' Oeuvres | ';
        echo $nb_res_personnes;
        echo ' Personnes ';

        ?>
        </div>
    </div>


</header>


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

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

</html>

<script type="text/javascript">

    var MAX_RESULT_NUMBER = 10;
    var current_result_p_counter = 0;
    var current_result_o_counter = 0;
    var prec_pers_added = false;
    var prec_oeuvre_added = false;
    var last_num_o;


    function createSection(titre) {
        var oeuvre_section = document.createElement("SECTION");
        oeuvre_section.setAttribute('id', titre);
        oeuvre_section.setAttribute('class', "blue");

        div_container = document.createElement('div');
        div_row = document.createElement('div');
        div_text = document.createElement('div');
        div_text.setAttribute("class", "col-lg-12 text-center");
        div_text.setAttribute("id", "table_container_" + titre);

        h2 = document.createElement('h2');
        h2.setAttribute("class", "titre-section");
        h2.innerHTML = titre;

        div_text.appendChild(h2);
        div_row.appendChild(div_text);
        div_container.appendChild(div_row);
        oeuvre_section.appendChild(div_container);
        document.body.appendChild(oeuvre_section);

    }


    $(document).ready(function () {

        var oeuvres_array = <?php echo json_encode(array_values($oeuvres_array)); ?>;
        var personnes_array = <?php echo json_encode(array_values($personne_array)); ?>;

        console.log(oeuvres_array);
        if (oeuvres_array.length > 0) {
            createSection("Oeuvres");
            table = document.createElement("table");
            table.setAttribute("id", "oeuvres_table");
            table.setAttribute("class", "display");

            document.getElementById("table_container_Oeuvres").appendChild(table);
            $('#oeuvres_table').DataTable({
                "aaSorting": [],
                data: oeuvres_array,
                columns: [
                    {title: "Titre"},
                    {title: "Date"},
                    {title: "Genre"}
                ]
            });
        }
        if (personnes_array.length > 0) {
            createSection("Personnes");
            table = document.createElement("table");
            table.setAttribute("id", "personnes_table");
            table.setAttribute("class", "display");

            document.getElementById("table_container_Personnes").appendChild(table);
            $('#personnes_table').DataTable({
                "aaSorting": [],
                data: personnes_array,
                columns: [
                    {title: "Prenom/Nom"},
                    {title: "Numero"},
                ]
            });
        }

    });



</script>
