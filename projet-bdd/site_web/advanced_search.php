<?php
include 'menubar.php';
session_start();

$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    //get genres
    $query = "SELECT DISTINCT Genre FROM Genre";

    $all_genres_dirty = $database->query($query);
    $res_genres = array();
    while ($row = mysqli_fetch_assoc($all_genres_dirty)) {
        array_push($res_genres, $row['Genre']);
    }

    //get languages
    $query = "SELECT DISTINCT Langue FROM Langue";

    $all_langages_dirty = $database->query($query);
    $res_langages = array();
    while ($row = mysqli_fetch_assoc($all_langages_dirty)) {
        array_push($res_langages, utf8_encode($row['Langue']));
    }

    //get countries
    $query = "SELECT DISTINCT Pays FROM Pays";

    $all_countries_dirty = $database->query($query);
    $res_countries = array();
    while ($row = mysqli_fetch_assoc($all_countries_dirty)) {
        array_push($res_countries, $row['Pays']);
    }
}


?>
<head>

    <meta charset="utf-8">
    <title>Recherche avancée</title>

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
    <link href="css/advanced_search.css" rel="stylesheet">
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

    <script src="js/advanced_search.js"></script>

</head>

<body id="page-top" class="index">
<header style="background-color: #126a9d">

    <div class="container">
        <div class="intro-text">
            <div class="intro-heading" style="color: white">Recherche avancée</div>
        </div>
    </div>
</header>

<section style="background-color: white">
    <div class="container text-center">

        <form name="search" id="searchForm" novalidate>

            <div class="form-group text-left" id="form_section">
                <label for="title">Titre</label>
                <input type="text3" class="form-control" placeholder="Ex : Inception" id="title">
            </div>
            <div class="form-group text-left">
                <label for="title">Année</label>
                <input type="text3" class="form-control" placeholder="Ex : 2010" id="year">
            </div>

            <label for="title">Acteur</label>
            <div class="row">
                <div class="col-md-6">
                    <label>Prénom</label>
                    <input type="text2" class="form-control fn" placeholder="Ex : Bruce" id="actor_fn">
                </div>
                <div class="col-md-6">
                    <label for="title">Nom</label>
                    <input type="text2" class="form-control name" placeholder="Ex : Willis" id="actor_n">
                </div>
            </div>

            <label for="title">Directeur</label>
            <div class="row">
                <div class="col-md-6">
                    <label>Prénom</label>
                    <input type="text2" class="form-control fn" placeholder="Ex : Steven" id="director_fn">
                </div>
                <div class="col-md-6">
                    <label for="title">Nom</label>
                    <input type="text2" class="form-control name" placeholder="Ex : Spielberg" id="director_n">
                </div>
            </div>
            <label for="title">Auteur</label>
            <div class="row">
                <div class="col-md-6">
                    <label>Prénom</label>
                    <input type="text2" class="form-control fn" placeholder="Ex : Chritopher" id="writer_fn">
                </div>
                <div class="col-md-6">
                    <label for="title">Nom</label>
                    <input type="text2" class="form-control name" placeholder="Ex : Nolan" id="writer_n">
                </div>
            </div>

            <div class="form-group text-left">
                <label for="title">Categorie</label>
                <select class="form-control test" id="category_select" name="category">
                    <option>Toutes</option>
                    <option>Film</option>
                    <option>Serie</option>
                    <option>Episode</option>
                </select>
            </div>

            <div class="form-group text-left">
                <label for="title">Genres</label>
                <select class="form-control test" multiple="multiple" id="genre_select" name="genres[]">
                </select>
            </div>
            <div class="form-group text-left">
                <label for="title">Langues</label>
                <select class="form-control test" multiple="multiple" id="langage_select" name="langages[]">
                </select>
            </div>
            <div class="form-group text-left">
                <label for="title">Pays</label>
                <select class="form-control test" multiple="multiple" id="country_select" name="countries[]">
                </select>
            </div>

            <div class="clearfix"></div>
            <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button type="button" class="btn btn-xl" onclick="build_advanced_query()">Rechercher</button>
            </div>
        </form>

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
<script src="js/select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var array_genres = (<?php echo json_encode($res_genres); ?>);
        console.log("genres", array_genres);

        array_genres.forEach((entry) = > {
            $('#genre_select'
        ).
        append(
            $('<option>' + entry + '</option>')
        );

    })
        ;
        $("#genre_select").select2();

        var array_langages = (<?php echo json_encode($res_langages); ?>);
        console.log("langages", array_langages);

        array_langages.forEach((entry1) = > {
            $('#langage_select'
        ).
        append(
            $('<option>' + entry1 + '</option>')
        );

    })
        ;
        $("#langage_select").select2();


        var array_countries = (<?php echo json_encode($res_countries); ?>);
        console.log("countries", array_countries);
        array_countries.forEach((entry2) = > {
            $('#country_select'
        ).
        append(
            $('<option>' + entry2 + '</option>')
        );

    })
        ;
        $("#country_select").select2();

        $("#category_select").select2();

        $.extend(
            {
                redirectPost: function (location, args) {
                    var form = $('<form></form>');
                    form.attr("method", "post");
                    form.attr("action", location);

                    $.each(args, function (key, value) {
                        var field = $('<input></input>');

                        field.attr("type", "hidden");
                        field.attr("name", key);
                        field.attr("value", value);

                        form.append(field);
                    });
                    $(form).appendTo('body').submit();
                }
            });
    });

</script>