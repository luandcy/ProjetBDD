<?php
session_start();
?>
<html>

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<meta charset="utf-8"/>
		<meta name="description" content="">
		<meta name="author" content="">
		<title>MUZIK</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	</head>
	
	<body id = "top">

		<div id="header-wrap">
			<header>

				<!--Menu-->
<?php
//L'utilisateur est connecté
if (isset($_SESSION['pseudo'])){
	$pseudo = $_SESSION['pseudo'];
				echo'<nav>';
					echo'<ul>';
						echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
						echo'<li><a href="index.php">Contact</a><span></span></li>';
						//Afficher si utilisateur est admin
						echo'<li><a href="publier.php">Publier</a><span></span></li>';
						echo'<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';

					echo'</ul>';
				echo'</nav>';

				echo'<div class="subscribe">';
					echo'<a href="#">Avatar</a> | <a href="#">'.$_SESSION['pseudo'].'</a>';
				echo'</div>';

}
else
{
				echo'<nav>';
					echo'<ul>';
						echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
						echo'<li><a href="connexion.php">Connexion</a><span></span></li>';
						echo'<li><a href="inscription.php">Inscription</a><span></span></li>';
						echo'<li><a href="index.php">Contact</a><span></span></li>';
						//Afficher si utilisateur est admin
					echo'</ul>';
				echo'</nav>';

				echo'<div class="subscribe">';
					echo'<a href="#">Avatar</a> | <a href="#">utilisateur</a>';
				echo'</div>';
}

?>

	
			</header></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">		
<?php
If (!isset($_SESSION['pseudo']) OR $_SESSION['pseudo'] == "") 
{
	die('Vous devez être connecté pour faire cette action.');
}

If (!empty($_POST["msg"]) and !empty($_POST["note"]))
{
 $msg = $_POST["msg"];
 $note = $_POST["note"];

	//Connexion à la base
	$connexion=mysqli_connect("localhost", "root", "") ;
	mysqli_select_db($connexion,"projet_bdd");

	//Création de la requête d'insertion du message avec la fonction date() pour l'ajout des informations temporelles 
	$req='INSERT INTO avis (IdUtilisateur, DateAvis, NoteAvis, IdArtiste, TexteAvis) VALUES ("'.$_SESSION['ID'].'", "'.date("Y/m/d H:i:s").'", '.$note.',"'.$_SESSION['artiste'].'", "'.$msg.'");'; 
	//echo $req;

	// Envoi de la requête 
	mysqli_query($connexion, $req); 

	//Fermeture de la connexion
	mysqli_close($connexion) ;
	
	// Affichage d'un message de confirmation
	echo "Votre commentaire a bien été envoyé.<br/>";
	echo'Le commentaire :'.$msg.'<br/><br/>';
}
else
{
 die("Vous n'avez pas mis votre avis sur cet artiste..");
}
?>
</section>
</body>

</html>