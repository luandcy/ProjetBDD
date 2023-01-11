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
        	<nav>
			<ul>
				<li id="current"><a href="index.php">Accueil</a><span></span></li>
				<li><a href="index.php">Contact</a><span></span></li>
				
				<?php
				
				//Utilisateur est connecté
					if (isset($_SESSION['pseudo'])and isset($_SESSION['admin']))
					{
						echo '<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';	
						//Utilisateur connecté et administrateur
						if ($_SESSION['admin'] == 1)
						{
							echo '<li><a href="publier.php">Publier</a><span></span></li>';	
						}
					}
				//Utilisateur n'est pas connecté
					else 
					{
						echo '<li><a href="connexion.php">Connexion</a><span></span></li>';
						echo '<li><a href="inscription.php">Inscription</a><span></span></li>';					
					}
					
				?>
			</ul>
			</nav>
					
			<div class="subscribe">
			
				<?php 
				//Affichage du pseudo quand l'utilisateur est connecté
				if (isset($_SESSION['pseudo'])) 
				{
					echo'<a href="#">Avatar</a> | <a href="#">'.$_SESSION['pseudo'].'</a>';
				}
				//Affichage du mot"utilisateur" quand l'utilisateur n'est pas connecté
				else 
				{
					echo'<a href="#">Avatar</a> | <a href="#">utilisateur</a>';
				}
				?>
				
			</div>
						
			<form id="quick-search" method="get" action="recherche.php">
				<fieldset class="search">
					<label for="qsearch">Rechercher Artiste:</label>
					<input class="tbox" id="qsearch" type="text" name="recherche" value="Michael Jackson" title="Rentrez le nom de l'artiste" />
					<button class="btn" title="Confirmer">Search</button>
				</fieldset>
			</form>	
		</header>
	</div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">		
<?php
If (!isset($_SESSION['pseudo']) OR $_SESSION['pseudo'] == "") 
{
	echo'<center>';
	echo'<h1>';
		die('Vous devez être connecté pour faire cette action.');
	echo'</h1>';
 	echo'</center>';
}

If (!empty($_POST["msg"]) and !empty($_POST["note"]))
{
 $msg = $_POST["msg"];
 $note = $_POST["note"];

	//Connexion à la base
	$connexion=mysqli_connect("localhost", "root", "") ;
	mysqli_select_db($connexion,"projet_bdd");

	//Création de la requête d'insertion du message avec la fonction date() pour l'ajout des informations temporelles 
	$req='INSERT INTO avis (IdUser, DateAvis, NoteAvis, IdArtiste, TexteAvis) VALUES ("'.$_SESSION['ID'].'", "'.date("Y/m/d").'", '.$note.',"'.$_SESSION['artiste'].'", "'.$msg.'");'; 
	//echo $req;

	// Envoi de la requête 
	mysqli_query($connexion, $req); 

	//Fermeture de la connexion
	mysqli_close($connexion) ;
	
	// Affichage d'un message de confirmation
	echo'<center>';
	echo'<h1>';
		echo "Votre commentaire a bien été envoyé.<br/>";
	echo'</h1>';
 	echo'</center>';
}
else
{
 	echo'<center>';
	echo'<h1>';
		die("Vous n'avez pas mis votre avis sur cet artiste..");
	echo'</h1>';
 	echo'</center>';
}
?>
</section>
</body>

</html>