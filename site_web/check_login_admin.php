<!DOCTYPE html>
<html>
<body>
	<?php
		session_start();
        $email = $_POST["mail"];
        $password = md5($_POST["password"]);
        echo "$email";
        echo "$password";
        $db = mysqli_connect("localhost","root", "imdb", "IMBD");
	    if (!$db)
	    {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		else{
			$database = new mysqli("localhost","root","imdb","IMBD");
			$requete = "SELECT  AdresseMail, motDePasse FROM Administrateur
							WHERE AdresseMail = '$email'";
			$output = $database->query($requete);
			
			if($row = $output->fetch_assoc()){
				if ($row['motDePasse'] == $password){
					header("Location: ./administrator_action_page.php");
				}
				else{
					$_SESSION['errors'] = array("Your username or password was incorrect.");
					header("Location: ./administrator_login_page.php");
				}
			}
			else{
				$_SESSION['errors'] = array("Your username or password was incorrect.");
				header("Location: ./administrator_login_page.php");
			}
	    }
	?>
</body>
</html>