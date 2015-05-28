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
//Requête base de données pour envoyer le message si bouton submit INSERT MESSAGE
if(isset($_POST['pseudo']) and $_POST['pseudo']!='' and isset($_POST['message']) and $_POST['message']!='')
{
	$req = $bdd->prepare('INSERT INTO message (pseudo,message) VALUES (?,?)');
	$req->execute(array($_POST['pseudo'],$_POST['message']));
	setcookie("pseudo_minichat",$_POST['pseudo'],time()+3600*24*15, null, null, false, true);
}
header('location:index.php');
?>