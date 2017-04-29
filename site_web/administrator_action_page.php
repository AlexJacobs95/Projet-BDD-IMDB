<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page de recherche avancé de site web.
-->
 <?php session_start(); ?>

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
			include 'menubar_admin.php';
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
                </style>
                    <div class="intro-heading">Panneau Administrateur</div> 
                    
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                       <a class="btn btn-xl" href="#op_compte_admin"> Comptes administrateur</a>
                    </div>


                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                    	<a class="btn btn-xl" href="#">Opérations sur Film</a>
                    </div>
                                  

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Série</a>
                    </div>    

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Directeur</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Ecrivain</a>
                    </div>
                              

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Producteur</a>
                    </div>
                              

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Acteur</a>
                    </div>
                              

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Genre</a>
                    </div>
                              

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Pays</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#">Opérations sur Langue</a>
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
                <form action="/action_administrator.php">
                    <div class="form-group text-center">
                        <input type="email" name="email" placeholder="Enter a email" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="password" name="pswd" placeholder="Enter a password" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl">Ajout</button>
                    </div>
                </form>
            </div>
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h4>Suppression</h4>
                </div>
                <form action="/action_administrator.php">
                    <div class="form-group text-center">
                        <input type="email" name="email" placeholder="Enter a email" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl">Suppression</button>
                    </div>
                </form>

            </div>
        </section>
    </body>
    <script src="./js/jquery-1.12.3.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</html>


<!--

<form action="/action_administrator.php">
    <h4>Ajout Admnistrateur</h4>
    <label><b>Email</b></label>
    <input type="email" name="email" placeholder="Enter a email" required>
    <label><b>Password</b></label>
    <input type="password" name="pswd" placeholder="Enter a password" required>
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator">
    <h4>Suppression Admnistrateur</h4>
    <label><b>Email</b></label>
    <input type="email" name="email" placeholder="Enter a email" required>
    <button type="submit">Suppression</button>
</form>



<form action="/action_administrator.php">
    <h4>Ajout Film</h4>
    <input type="text" name="film_reference" placeholder="Enter the reference" required>
    <input type="text" name="film_name" placeholder="Enter the name" required>
    <input type="text" name="genre_film" placeholder="Enter the genre" required> 
    <input type="text" name="year_film" placeholder="Enter the year(optional)">
    <input type="text" name="rating_note_film" placeholder="Enter a rating note (optional)">
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Suppression Film</h4>
    <input type="text" name="film_reference" placeholder="Enter the reference" required>
    <input type="text" name="film_name" placeholder="Enter the name" required>
    <button type="submit">Suppression</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Série</h4>
    <input type="text" name="serie_reference" placeholder="Enter the reference" required>
    <input type="text" name="serie_name" placeholder="Enter the name" required>
    <input type="text" name="genre_serie" placeholder="Enter the genre" required>
    <input type="text" name="begin_year" placeholder="Enter the begin year" required>
    <input type="text" name="end_year" placeholder="Enter the end year (optional)">
    <input type="text" name="rating_note_serie" placeholder="Enter a rating note(optional)">
    <button type="submit">Ajout</button>
</form>


<form action="/action_administrator.php">
    <h4>Suppression Série</h4>
    <input type="text" name="serie_reference" placeholder="Enter the reference" required>
    <input type="text" name="serie_name" placeholder="Enter the name" required>
    <button type="submit">Suppression</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Episode</h4>
    <input type="text" name="serie_name" placeholder="Enter the name of the serie" required>
    <input type="text" name="episode_name" placeholder="Enter the episode name" required>
    <input type="text" name="number_season" placeholder="Enter the number of the season" required>
    <input type="text" name="episode_number" placeholder="Enter the episode number" required>
    <input type="text" name="rating_note_episode" placeholder="Enter a rating note (optional)">
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Directeur</h4>
    <input type="text" name="director_firstname" placeholder="Enter the FirstName" required>
    <input type="text" name="director_secondname" placeholder="Enter the SecondName" required>
    <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Ecrivain</h4>
    <input type="text" name="writter_firstname" placeholder="Enter the FirstName" required>
    <input type="text" name="writter_secondname" placeholder="Enter the SecondName" required>
    <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">

    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Acteur/Actrice</h4>
    <input type="text" name="actor_firstname" placeholder="Enter the FirstName" required>
    <input type="text" name="actor_secondname" placeholder="Enter the SecondName" required>
    <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Genre</h4>
    <input type="text" name="genre" placeholder="Enter a genre" required>
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Pays</h4>
    <input type="text" name="country" placeholder="Enter a country" required>
    <button type="submit">Ajout</button>
</form>

<form action="/action_administrator.php">
    <h4>Ajout Langue</h4>
    <input type="text" name="language" placeholder="Enter a language" required>
    <button type="submit">Ajout</button>
</form>

 -->