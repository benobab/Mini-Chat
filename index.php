<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Mini Chat</title>
</head>
<?php
//connexion PDO
try
{
	$bdd= new PDO('mysql:host=localhost;dbname=mini_chat;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(exception $e)
{
	die('Erreur : ' . $e.getMessage());
}
?>
<body>
		<form action="index_post.php" method="post">
		<?php if(isset($_COOKIE['pseudo_minichat']))
	{?>
		<p><label>Votre pseudo</label><input type="text" name="pseudo" value=<?php echo $_COOKIE['pseudo_minichat'];?>></p>
	<?php
	}else
	{
	?>
		<p><label>Votre pseudo</label><input type="text" name="pseudo"/></p>
	<?php
	}
	?>
		<p><label>Votre message</label><input type="text" name="message" /></p>
		<input type="submit" value="Envoyer le message" />
	</form>
</body>

<?php
//session start ? avec sauvegarde du pseudo prérentré par exemple ? 

//Requête pour afficher les dix derniers messages quoi qu'il arrive SELECT * from MESSAGE
$reponse = $bdd->query('SELECT * FROM message ORDER BY id DESC LIMIT 10');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
	<p><strong><?php echo htmlspecialchars($donnees['pseudo'])?> :</strong> <?php echo htmlspecialchars($donnees['message'])?>.</p>
<?php

}
?>

<footer>
	<a href="index.php">Rafraichir la page.</a>
</footer>
</html>