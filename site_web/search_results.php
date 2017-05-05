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

    return $search;
}

$search_content = $_POST["search"];

$database = new mysqli("localhost", "root", "imdb", "IMDB");
$search_content = mysqli_real_escape_string($database, $_POST["search"]);

$start_time = round(microtime(true) * 1000);

if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

$search = build_search($search_content);


    $requete = "SELECT *
                FROM Oeuvre
                WHERE MATCH (Titre)
                AGAINST ('$search' IN BOOLEAN MODE)
                ORDER BY 
                MATCH(Titre) against('$search' IN BOOLEAN MODE)";

    
    $result_oeuvres = $database->query($requete);
    $nb_res_oeuvre = mysqli_num_rows($result_oeuvres);

    $requete = "SELECT *
             FROM Personne
             WHERE MATCH (Prenom, Nom)
             AGAINST ('$search' IN BOOLEAN MODE)";

    $result_personnes = $database->query($requete);
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
    $oeuvres_array[$i] = [
        "id" => utf8_encode($row['ID']),
        "titre" => utf8_encode($row['Titre']),
        "type" => getOeuvreType($row['ID']),
        "date" => utf8_encode($row['AnneeSortie']),
        "url" => urlencode($row['ID'])
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
        "nom" => $ln,
        "prenom" => $fn,
        "numero" => $num,
        "url" => urlencode($fn . ';' . $ln . ';' . $num)
    ];
    $i = $i + 1;

}

?>

<!-- Header -->
<header>
    Résultats (<?php
    echo $nb_res_oeuvre;
    echo ' Oeuvres | ';
    echo $nb_res_personnes;
    echo ' Personnes) ';
    echo $duration
    ?> s

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

</html>

<script type="text/javascript">

    var MAX_RESULT_NUMBER = 10;
    var current_result_p_counter = 0;
    var current_result_o_counter = 0;


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
        console.log(oeuvres_array.length)
        if (oeuvres_array.length > 0) {
            createSection("Oeuvres");
            table = document.createElement("table");
            table.setAttribute("id", "oeuvres_table");

            document.getElementById("table_container_Oeuvres").appendChild(table);
            $('#oeuvres_table').append("<tbody>...</tbody>");


            for (var i in oeuvres_array) {
                var data = oeuvres_array[i];
                var markup;
                if (oeuvres_array[i]["type"] == "film") {
                    markup = "<tr><td>" + "<a href=film.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Film" + "</a>" + "</td></tr>";
                } else if (oeuvres_array[i]["type"] == "episode"){
                    markup = "<tr><td>" + "<a href=episode.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Episode" + "</a>" + "</td></tr>";
                } else if (oeuvres_array[i]["type"] == "serie") {
                    markup = "<tr><td>" + "<a href=serie.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Serie" + "</a>" + "</td></tr>";

                }

                $('#oeuvres_table').find('tbody').append(markup);
                current_result_o_counter++;
                if (current_result_o_counter % MAX_RESULT_NUMBER == 0) break;
            }

            if (current_result_o_counter < oeuvres_array.length) {
                button = document.createElement("button");
                button.setAttribute("id", "more_oeuvres_button");
                button.setAttribute("class", "btn btn-xl");
                button.innerHTML = "Suivants";
                document.getElementById("table_container_Oeuvres").appendChild(button);


            }

        } if (personnes_array.length > 0) {
            createSection("Personnes")
            table = document.createElement("table");
            table.setAttribute("id", "personnes_table");

            document.getElementById("table_container_Personnes").appendChild(table);
            $('#personnes_table').append("<tbody>...</tbody>");

            for (var i in personnes_array) {
                var data = personnes_array[i];
                console.log(data)
                if (data["numero"] != "NA") {
                    var markup = "<tr><td>" + "<a href=personne.php?id=" + data["url"] + ">" + data["prenom"] + " " + data["nom"] + ' (' + data["numero"] + ')' + "</a>" + "</td></tr>";
                } else {
                    var markup = "<tr><td>" + "<a href=personne.php?id=" + data["url"] + ">" + data["prenom"] + " " + data["nom"] + "</a>" + "</td></tr>";
                }

                $('#personnes_table').find('tbody').append(markup);
                current_result_p_counter++;
                if (current_result_p_counter % MAX_RESULT_NUMBER == 0) break;
            }

            if (current_result_p_counter < personnes_array.length) {
                button = document.createElement("button");
                button.setAttribute("id", "more_personnes_button");
                button.setAttribute("class", "btn btn-xl");
                button.innerHTML = "Suivants";
                document.getElementById("table_container_Personnes").appendChild(button);


            }


        }

        $("#more_oeuvres_button").click(function() {

            $("#oeuvres_table").find("tr").remove();


            if (current_result_o_counter + MAX_RESULT_NUMBER > oeuvres_array.length) {
                num = oeuvres_array.length - current_result_o_counter;
            } else if (current_result_o_counter + MAX_RESULT_NUMBER <= oeuvres_array.length) {
                num = MAX_RESULT_NUMBER
            }


            var slice = oeuvres_array.slice(current_result_o_counter, current_result_o_counter + num)

            for (var i in slice) {
                var data = slice[i];
                var markup;
                if (oeuvres_array[i]["type"] == "film") {
                    markup = "<tr><td>" + "<a href=film.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Film" + "</a>" + "</td></tr>";
                } else if (oeuvres_array[i]["type"] == "episode"){
                    markup = "<tr><td>" + "<a href=episode.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Episode" + "</a>" + "</td></tr>";
                } else if (oeuvres_array[i]["type"] == "serie") {
                    markup = "<tr><td>" + "<a href=serie.php?id=" + data["url"] + ">" + data["titre"] + ' (' + oeuvres_array[i]["date"] + ')' + " - " + "Serie" + "</a>" + "</td></tr>";

                }

                $('#oeuvres_table').find('tbody').append(markup);
                current_result_o_counter++;

            }

            if (current_result_o_counter == oeuvres_array.length) {
                $("#more_oeuvres_button").remove();
            } else {
                console.log("nope")
            }

        });

        $("#more_personnes_button").click(function() {

            $("#personnes_tables").find("tr").remove();


            if (current_result_p_counter + MAX_RESULT_NUMBER > personnes_array.length) {
                num = oeuvres_array.length - current_result_o_counter;
            } else if (current_result_p_counter + MAX_RESULT_NUMBER <= personnes_array.length) {
                num = MAX_RESULT_NUMBER
            }


            var slice = personnes_array.slice(current_result_p_counter, current_result_p_counter + num)

            for (var i in slice) {
                var data = slice[i];
                if (data["numero"] != "NA") {
                    var markup = "<tr><td>" + "<a href=personne.php?id=" + data["url"] + ">" + data["prenom"] + " " + data["nom"] + ' (' + data["numero"] + ')' + "</a>" + "</td></tr>";
                } else {
                    var markup = "<tr><td>" + "<a href=personne.php?id=" + data["url"] + ">" + data["prenom"] + " " + data["nom"] + "</a>" + "</td></tr>";
                }
                $('#personnes_table').find('tbody').append(markup);
                current_result_p_counter++;

            }

            if (current_result_p_counter == oeuvres_array.length) {
                $("#more_oeuvres_button").remove();
            } else {
                console.log("nope")
            }

        });
    });



</script>
