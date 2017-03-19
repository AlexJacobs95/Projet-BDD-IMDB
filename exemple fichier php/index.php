<html>
<body>
<?php 
$link = mysql_connect('localhost', 'root', 'root');

mysql_select_db("projet",$link);

$result = mysql_query("SELECT * FROM Produit");

while($row = mysql_fetch_array($result)) {
	echo $row['NOM'] . " " . $row['Prix']; 
	echo "<br />"; 
}

mysql_close($con);
?>

<form action="ajouter.php" method="post"> 
Ajouter un produit. 
Nom : <input type="text" name="nom" /> 
Prix : <input type="text" name="prix" /> 
<input type="submit" value="Ajouter" />
</form>

</body>
</html>