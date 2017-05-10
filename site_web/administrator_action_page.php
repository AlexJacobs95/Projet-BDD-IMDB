<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page de recherche avancé de site web.
-->
 <?php session_start();
 function displayMessage($key){
     if(isset($_SESSION[$key])) {
         foreach ($_SESSION[$key] as $succes) {
             echo "<p> $succes </p>";
         }
         $_SESSION[$key] = null;
     }
 }
 ?>

 <!DOCTYPE html>
<html>
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
	<body id="page-top" class="index">
		<?php
			include 'menubar.php';
		?>
		<header>
    		<div class="container">
                <div class="intro-text">
                <style type="text/css">
                	.btn{
                		margin: 8px 0; 
                		border: none;
                		cursor: pointer;
                		border-radius: 4px;
                	}
                    input[type="text_field"]{
                        width: 500px;
                        height: 50px;
                        box-sizing: border-box;
                        border: 2px solid #fed136;
                        font-size: 16px;
                        color: black;
                        background-color: white;
                        background-position: 10px 10px;
                        background-repeat: no-repeat;
                        padding: 0px 20px 0px 40px;
                        -webkit-transition: width 0.4s ease-in-out;
                        transition: width 0.4s ease-in-out;
                    }
                </style>
                    <div class="intro-heading">Panneau Administrateur</div> 
                    
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                       <a class="btn btn-xl" href="#op_compte_admin"> Comptes administrateur</a>
                    </div>


                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                    	<a class="btn btn-xl" href="#op_on_film">Opérations sur Film</a>
                    </div>
                                  

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_serie">Opérations sur Série</a>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_dir">Opérations sur Directeur</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_writer">Opérations sur Auteur</a>
                    </div>  

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_actor">Opérations sur Acteur</a>
                    </div>
                </div>
            </div>
        </header>
        <section id= "op_compte_admin">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Comptes Administrateur</h2>
                    <h4>Ajout</h4>
                </div>
                <div class="form-errors">
                    <?php displayMessage("query_succes_add_admin"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_add_admin") ?>
                </div>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="email" class="form-control" name="email" placeholder="Enter a email" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="password" class="form-control" name="pswd" placeholder="Enter a password" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="admin_add">Ajout</button>
                    </div>
                </form>
            </div>
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h4>Suppression</h4>
                </div>

                <div class="form-errors">
                    <?php displayMessage("query_succes_delete_admin"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_delete_admin") ?>
                </div>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="email" class="form-control" name="email" placeholder="Enter a email" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name="admin_delete">Suppression</button>
                    </div>
                </form>

            </div>
        </section>

        <section id="op_on_film">
             <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Film</h2>
                    <h4>Ajout</h4>
                </div>
                 <div class="form-errors">
                     <?php displayMessage("query_succes_add_film"); ?>
                 </div>
                 <div class="form-errors">
                     <?php  displayMessage("error_add_film") ?>
                 </div>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="film_name" placeholder="Enter the name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="year_film" placeholder="Enter the year" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="genre_film" placeholder="Enter the genre(optional)">
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="rating_note_film" placeholder="Enter a rating note (optional)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="film_add">Ajout</button>
                    </div>
                </form>
            </div>
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h4>Suppression</h4>
                </div>

                <div class="form-errors">
                    <?php displayMessage("query_succes_delete_film"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_delete_film") ?>
                </div>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="film_name" placeholder="Enter the name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="year_film" placeholder="Enter the year" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name="film_delete">Suppression</button>
                    </div>
                </form>
            </div>
        </section>

        <section id ="op_on_serie">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Série</h2>
                    <h4>Ajout</h4>
                </div>
                <div class="form-errors">
                    <?php displayMessage("query_succes_add_serie"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_add_serie") ?>
                </div>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="serie_name" placeholder="Enter the name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="begin_year" placeholder="Enter the begin year" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="genre_serie" placeholder="Enter the genre (optional)">
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="end_year" placeholder="Enter the end year (optional)">
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="rating_note_serie" placeholder="Enter a rating note(optional)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="serie_add">Ajout</button>
                    </div>
                </form>
            </div>
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h4>Suppression</h4>
                </div>

                <div class="form-errors">
                    <?php displayMessage("query_succes_delete_serie"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_delete_serie") ?>
                </div>

                <form action="/action_administrator.php" method="post">

                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="serie_name" placeholder="Enter the name" required>
                    </div>

                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="begin_year" placeholder="Enter the begin year" required>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name="serie_delete">Suppression</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_dir">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Directeur</h2>
                    <h4>Ajout</h4>
                </div>
                <div class="form-errors">
                    <?php displayMessage("query_succes_add_dir"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_add_dir") ?>
                </div>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="director_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="director_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="director_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_writer">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Auteur</h2>
                    <h4>Ajout</h4>
                </div>
                <div class="form-errors">
                    <?php displayMessage("query_succes_add_writer"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_add_writer") ?>
                </div>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text_field" class="form-control" name="writer_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="writer_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="writer_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_actor">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Acteur/Actrice</h2>
                    <h4>Ajout</h4>
                </div>
                <div class="form-errors">
                    <?php displayMessage("query_succes_add_actor"); ?>
                </div>
                <div class="form-errors">
                    <?php  displayMessage("error_add_actor") ?>
                </div>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text_field" class="form-control" name="actor_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="actor_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text_field" class="form-control" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="actor_add">Ajout</button>
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

</html>

