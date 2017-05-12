
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
    $query = "SELECT DISTINCT Genre FROM Genre";

    $all_genres_dirty = $database->query($query);
    $res = array();
    while ($row = mysqli_fetch_assoc($all_genres_dirty)) {
        array_push($res, $row['Genre']);
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
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="test_css/agency.css" rel="stylesheet">
    <link href="advanced_search.css" rel="stylesheet">
    <link href="select2.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->


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

            <form action="search.php" name="search" id="searchForm" novalidate>

                <div class="form-group text-left">
                    <label for="title">Titre</label>
                    <input type="text3" class="form-control" placeholder="Ex : Inception" name="title">
                </div>
                <div class="form-group text-left">
                    <label for="title">Année</label>
                    <input type="text3" class="form-control" placeholder="Ex : 2010" name="year">
                </div>
                <div class="form-group text-left">
                    <label for="title">Catégorie</label>
                    <span class="custom-dropdown custom-dropdown--white">
                            <select class="custom-dropdown__select custom-dropdown__select--white">
                                <option>Toutes</option>
                                <option>Film</option>
                                <option>Série</option>
                                <option>Episode</option>
                            </select>
                        </span>
                </div>
                <div class="form-group text-left">
                    <label for="title">Genres</label>
                    <select class="form-control test" multiple="multiple" id="genre_select" name="genres[]">
                    </select>
                </div>

                <label for="title">Acteur</label>
                <div class="row">
                    <div class="col-md-6">
                        <label>Prénom</label>
                        <input type="text2" class="form-control fn" placeholder="Ex : Bruce" name="actor_fn">
                    </div>
                    <div class="col-md-6">
                        <label for="title">Nom</label>
                        <input type="text2" class="form-control name" placeholder="Ex : Willis" name="actor_n">
                    </div>
                </div>

                <label for="title">Directeur</label>
                <div class="row">
                    <div class="col-md-6">
                        <label>Prénom</label>
                        <input type="text2" class="form-control fn" placeholder="Ex : Steven" name="director_fn">
                    </div>
                    <div class="col-md-6">
                        <label for="title">Nom</label>
                        <input type="text2" class="form-control name" placeholder="Ex : Spielberg" name="director_n">
                    </div>
                </div>
                <label for="title">Auteur</label>
                <div class="row">
                    <div class="col-md-6">
                        <label>Prénom</label>
                        <input type="text2" class="form-control fn" placeholder="Ex : Chritopher" name="autor_fn">
                    </div>
                    <div class="col-md-6">
                        <label for="title">Nom</label>
                        <input type="text2" class="form-control name" placeholder="Ex : Nolan" name="autor_n">
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                    <div id="success"></div>
                    <button type="submit" class="btn btn-xl">Rechercher</button>
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
<script src="test_js/agency.min.js"></script>
<script src="select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var array = (<?php echo json_encode($res); ?>);
        array.forEach(function (entry) {
            $('#genre_select').append(
                $('<option>'+entry+'</option>')
            );

        })

        $(".test").select2();
    });
</script>