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
                    input[type=text]{
                        color: black;
                    }
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
                        <a class="btn btn-xl" href="#op_on_episode">Opérations sur Episode</a>
                    </div>    

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_dir">Opérations sur Directeur</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_writter">Opérations sur Auteur</a>
                    </div>  

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_actor">Opérations sur Acteur</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_genre">Opérations sur Genre</a>
                    </div>
                              

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_country">Opérations sur Pays</a>
                    </div>
                              
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-xl" href="#op_on_language">Opérations sur Langue</a>
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
                <?php if(isset($_SESSION['query_succes_add_admin'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add_admin'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add_admin"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add_admin'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add_admin'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add_admin"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="email" name="email" placeholder="Enter a email" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="password" name="pswd" placeholder="Enter a password" required>
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

                <?php if(isset($_SESSION['query_succes_delete'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_delete'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_delete"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_delete_admin'])) : ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_delete_admin'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_delete_admin"] = null;  ?>
                </div>
                <?php endif; ?>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="email" name="email" placeholder="Enter a email" required>
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
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="film_reference" placeholder="Enter the reference" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="film_name" placeholder="Enter the name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="genre_film" placeholder="Enter the genre" required> 
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="year_film" placeholder="Enter the year(optional)">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="rating_note_film" placeholder="Enter a rating note (optional)">
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

                <?php if(isset($_SESSION['query_succes_delete'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_delete'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_delete"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_delete'])) : ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_delete'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_delete"] = null;  ?>
                </div>
                <?php endif; ?>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="film_reference" placeholder="Enter the reference" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="film_name" placeholder="Enter the name" required>
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
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="serie_reference" placeholder="Enter the reference" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="serie_name" placeholder="Enter the name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="genre_serie" placeholder="Enter the genre" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="begin_year" placeholder="Enter the begin year" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="end_year" placeholder="Enter the end year (optional)">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="rating_note_serie" placeholder="Enter a rating note(optional)">
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

                <?php if(isset($_SESSION['query_succes_delete'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_delete'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_delete"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_delete'])) : ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_delete'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_delete"] = null;  ?>
                </div>
                <?php endif; ?>

                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="serie_reference" placeholder="Enter the reference" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="serie_name" placeholder="Enter the name" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name="serie_delete">Suppression</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_episode">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Episode</h2>
                    <h4>Ajout</h4>
                </div>    
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="serie_name" placeholder="Enter the name of the serie" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="episode_name" placeholder="Enter the episode name" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="episode_number" placeholder="Enter the episode number" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="rating_note_episode" placeholder="Enter a rating note (optional)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="episode_add">Ajout</button>
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
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                        <input type="text" name="director_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="director_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="director_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_writter">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Auteur</h2>
                    <h4>Ajout</h4>
                </div>    
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text" name="writter_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="writter_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="writter_add">Ajout</button>
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
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text" name="actor_firstname" placeholder="Enter the FirstName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="actor_secondname" placeholder="Enter the SecondName" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="text" name="gender" placeholder= "Enter the gender (optional if person already exist)">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="actor_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_genre">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Genre</h2>
                    <h4>Ajout</h4>
                </div>    
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add_genre'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add_genre'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add_genre"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text" name="genre" placeholder="Enter a genre" required>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="genre_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_country">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Pays</h2>
                    <h4>Ajout</h4>
                </div>    
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add_country'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add_country'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add_country"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text" name="country" placeholder="Enter a country" required>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="country_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="op_on_language">
            <div class="container text-center"> 
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Opérations sur Langues</h2>
                    <h4>Ajout</h4>
                </div>    
                <?php if(isset($_SESSION['query_succes_add'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['query_succes_add'] as $succes): ?>
                        <p><?php echo $succes ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["query_succes_add"] = null;  ?>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error_add_language'])): ?>
                <div class="form-errors">
                    <?php foreach($_SESSION['error_add_language'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                    <?php $_SESSION["error_add_language"] = null;  ?>
                </div>
                <?php endif; ?>
                <form action="/action_administrator.php" method="post">
                    <div class="form-group text-center">
                         <input type="text" name="language" placeholder="Enter a language" required>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl" name ="language_add">Ajout</button>
                    </div>
                </form>
            </div>
        </section>

    </body>
    <script src="./js/jquery-1.12.3.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</html>