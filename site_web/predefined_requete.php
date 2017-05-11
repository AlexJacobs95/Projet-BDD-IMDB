<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page avec menu déroulant pour requetes prédéfinies.
-->

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
    <link href="test_css/agency.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->


</head>

<body id="page-top" class="index" style="background-color: #2D3E50">

<!-- Navigation -->
<?php
include 'menubar.php';
?>


<section id ="query_section">
<div class="container text-center">
    <div class="col-lg-12 text-center">
        <h2 style="color: white" class="section-heading">Requêtes Prédéfinies</h2>
    </div>
        <form action="./requetes_action.php" name="form_query" method = "post">
            <select class="form-control" name ="requete" id="requete">
                <?php
                for ($i=1; $i < 7; $i++) {
                    echo "<option>Requete ".$i."</option>";
                }
                ?>
            </select>
            </br>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>
</section>
</body>


<!-- jQuery -->

<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Theme JavaScript -->
<script src="test_js/agency.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('form[name=form_query]').submit(function(e) {
            e.preventDefault();
            var query_num = $('#form_query').find(":selected").text();
            execute_query(query_num);
        });
    });


    function execute_query(num) {
        $.ajax({
            url: "requetes_action.php?requete="+num,
            type: "POST",
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data, textStatus, xhr) {
                alert("done");

            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }

        });

    }
</script>