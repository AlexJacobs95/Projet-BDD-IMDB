<!DOCTYPE html>
<html>
<body>
	<?php
        $email = $_POST["mail"];
        $password = $_POST["password"];
        $password = md5($password);
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
			$query = "SELECT * FROM Administrateur 
			    WHERE AdresseMail=='$email' AND motDePasse=='$password'";
			$result = mysqli_query($db, $query);
	        mysqli_close($db);
	        if(!$result){
	        	echo "false";
	            // header("Location: ./administrator_login_page.php");
	        }
	        else{
	        	echo "logged";
	        	// header("Location: ./administrator_action_page.php");    
	        }
	    }
	?>
</body>
</html>