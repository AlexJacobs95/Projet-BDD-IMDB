<?php
session_start();
include 'menubar.php';
?>
<head>

    <meta charset="utf-8">
    <title>Statistiques</title>

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
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/statistics.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">
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
<header style="background-color: #126a9d">

    <div class="container">
        <div class="intro-text">
            <div class="intro-heading" style="color: white">Statistiques</div>
        </div>
    </div>
</header>

<section id=compare>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <h2 class="section-heading">Film - Serie - Episode</h2>
                <canvas id="compare_nb_work" width="100" height="100"></canvas>
                <image id="loader_oeuvres" src="ripple.svg" style="display: none"></image>
            </div>

            <div class="col-md-6 text-center" id="col_actices_acteurs">
                <h2 id="titre_acteur_actrices" class="section-heading">Acteur - Actrice</h2>
                <canvas id="compare_sex" width="100" height="100"></canvas>
                <image id="loader_act" src="ripple.svg" style="display: none"></image>
            </div>
            <div class="clearfix"></div>

        </div>

    </div>


</section>


<section id=workByCountries>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Nombre d'oeuvre par pays (Top 30)</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <canvas id="movies-by-country" width="100" height="50"></canvas>
                <image id="loader_movies_by_country" src="ripple.svg" style="display: none"></image>
            </div>

        </div>

    </div>

</section>

<section id=notesEvolution>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Evolution des notes fonction du temps </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <image id="loader_note_evol" src="ripple.svg" style="display: none"></image>
                <canvas id="note_evolution" width="100" height="50"></canvas>
            </div>

        </div>

    </div>

</section>


<section id=nbMoviesSeriesEvolution>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Evolution du nombre de films et series tournés chaque année </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <image id="loader_evol" src="ripple.svg" style="display: none"></image>
                <canvas id="evolution" width="100" height="50"></canvas>
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
<script src="js/agency.min.js"></script>

<script src="js/Chart.js"></script>
<script src="js/stat.js"></script>
<script>
    get_nb_movies_by_country();
    get_notes_evolution();
    get_nb_movies_series_episodes();
    get_nb_man_and_womman();
    get_nb_movies_between_2000_2016();
</script>