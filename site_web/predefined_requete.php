<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page avec menu déroulant pour requetes prédéfinies.
-->

<?php
include 'menubar.php';
?>

<head>

    <meta charset="utf-8">
    <title>IMD - International movie database</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/predefined_query.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

    <script src="js/dynamic_part.js"></script>



</head>

<body id="page-top" class="index">
<header style="background-color: #126a9d">
    <div class="container">
        <div class="intro-text">
            <div class="intro-heading" style="color: white">Requêtes prédéfinies</div>
            <form name="form_query" method = "post">
                <select class="form-control" name ="requete" id="requete">
                    <?php
                    for ($i=1; $i < 7; $i++) {
                        echo "<option id=".$i.">Requete ".$i."</option>";
                    }
                    ?>
                </select>
                </br>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</header>

</body>


<!-- jQuery -->

<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Theme JavaScript -->
<script src="js/agency.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('form[name=form_query]').submit(function(e) {
            e.preventDefault();
            var query = $('#requete').find(":selected").text();
            var num  = $('#requete').find(":selected").attr('id');
            console.log(num, query);
            execute_query(query, num);
        });
    });


    function execute_query(query, num) {
        createSection("Résultats de la requête " + num);
        var tableID = "table_container_Résultats de la requête " + num;

        var div = document.getElementById(tableID);
        var running = document.createElement("h3");
        running.setAttribute("id", "running_text"+num);
        running.innerHTML = "Requête en cours d'exécution..."

        div.appendChild(running);

        console.log("requetes_action.php?requete="+query);
        $.ajax({
            url: "requetes_action.php?requete="+query,
            type: "POST",
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data) {
                console.log(query + "termninée");
                console.log(data);
                data = (JSON.parse(data));
                output_query(num, data);


            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                console.log("hi")

            }

        });

    }

    function output_query(num, res) {
        table = document.createElement("table");
        table.setAttribute("id", "table_"+num);
        table.setAttribute("class", "display");
        if (num === "1"){
            create_table_query_1_2_3(res, "1")
        } else if (num === "2"){
            create_table_query_1_2_3(res, "2")

        } else if (num === "3"){
            create_table_query_1_2_3(res, "3")

        } else if (num === "4") {
            create_table_query_4(res)
        } else if (num === "5") {
            create_table_query_5(res)
        } else if (num === "6") {
            create_table_query_6(res)
        }
        $('#running_text'+num).css("display", "none");

    }


    function create_table_query_1_2_3(data, num) {
        document.getElementById("table_container_Résultats de la requête " + num).appendChild(table);
        $('#table_'+num).DataTable({
            "deferRender": true,
            "aaSorting": [],
            data: data,
            columns: [
                {title: "Prénom, Nom"},
                {title: "Numero"}
            ]
        });
    }

    function create_table_query_4(data) {
        document.getElementById("table_container_Résultats de la requête 4").appendChild(table);
        $('#table_4').DataTable({
            "deferRender": true,
            "aaSorting": [],
            data: data,
            columns: [
                {title: "ID de l'épisode"},

            ]
        });
    }

    function create_table_query_5(data) {
        document.getElementById("table_container_Résultats de la requête 5").appendChild(table);
        $('#table_5').DataTable({
            "deferRender": true,
            "aaSorting": [],
            data: data,
            columns: [
                {title: "Prénom, Nom"},
                {title: "Numero"},
                {title: "Nombre de séries"},


            ]
        });


    }

    function create_table_query_6(data) {
        document.getElementById("table_container_Résultats de la requête 6").appendChild(table);
        $('#table_6').DataTable({
            "deferRender": true,
            "aaSorting": [],
            data: data,
            columns: [
                {title: "ID de la série"},
                {title: "Nombre d'épisodes"},
                {title: "Nombre moyen d'épisodes par an"},
                {title: "Nombre moyen d'acteurs par saison"},

            ]
        });


    }


</script>