<!DOCTYPE html>
<html>
<body>
	<?php 
        $email = $_POST["mail"];
        $password = $_POST["password"];
        $password = md5($password);
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
			    WHERE AdresseMail=$email AND motDePasse=$password";
			    
			echo "$query";
			$result = mysqli_query($db, $query);
	        mysqli_close($db);
	        if($result){
	        	while($row = mysqli_fetch_assoc($result)){
				    foreach($row as $cname => $cvalue){
				        print "$cname: $cvalue\t";
				    }
				    print "\r\n";
				}
	            // echo "$query";
	            // echo "$email";
	            // echo md5($password);
	            // echo "Login Failed";
	            header("administrator_login_page.php");
	        }
	        else{
	        	echo "ici";
	            header("administrator_action_page.php");
	        }
	    }
	?>
</body>
</html>