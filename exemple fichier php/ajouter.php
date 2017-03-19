<html>
<body>
<?php
		$nom = $_POST["nom"];
		$prix = $_POST["prix"];

		$link = mysql_connect('localhost', 'root', 'root');
		mysql_select_db("projet",$link);

		$result = mysql_query("INSERT INTO Produit (ID,NOM,Prix) VALUES (NULL,'".$nom."',".$prix.")");
		if(!$result)
		{
			echo mysql_errno($link) . ": " . mysql_error($link) . "<br/>";
		}
		else
		{
			echo "Ajout OK<br/>" ;		
		}
		echo "<a href='/'>Retour</a>";
		mysql_close($con);

?>
</body>
</html>

