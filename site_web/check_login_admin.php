<!DOCTYPE html>
<html>
<body>
	<?php 
        $email = $_POST[mail];
        $password = $_POST[password];
        $db = mysqli_connect("localhost","root", "imdb", "IMBD");
	    if (!$db)
	    {
		    echo "Error: Unable to connect to MySQL." . PHP_EOL;
		    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		else{
	        $query = "SELECT * FROM Administrateur WHERE AdresseMail = '". mysqli_real_escape_string($email) ."' AND motDePasse = '". mysqli_real_escape_string(md5($password)) ."'" ;
	        $result = mysqli_query($db,$query);
	        mysqli_close($db);
	        if($result){
	            echo "Login Failed";
	            header("administrator_login_page.php");
	        }
	        else{
	            header("administrator_action_page.php");
	        }
	    }
	?>
</body>
</html>