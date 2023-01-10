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
				//Affichage du mot "utilisateur" quand l'utilisateur n'est pas connecté
				else 
				{
					echo'<a href="#">Avatar</a> | <a href="#">utilisateur</a>';
				}
				?>
			
			</div>	
			
			</header>
		</div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">		

<?php
	if (isset($_session['pseudo'])and $_session['pseudo']!="")
	{
		$pseudo = $_session['pseudo']; 
		echo'Vous êtes déjà connecté.';
		echo'<br/><br/><a href="index.php">Retour à l\'index</a>';
	}
	else
	{
		echo'<h1>Connectez-vous.</h1>';
		echo'<form action="connexion2.php" method="POST">';
		echo'<input type="text" size="" name="pseudo"/>Pseudo<br/><br/>'; 
		echo'<input type="text" size="" name="mail"/>Adresse e-mail<br/><br/>'; 
		echo'<input type="password" size="" name="pass"/>Mot de passe<br/><br/>'; 
		echo'Administrateur <br/>';
		echo'<input type="radio" name="confirm"  value="oui"/> OUI<br/>';
		echo'<input type="radio" name="confirm"  value="non"/> NON<br/><br/>';
		echo'<center>';
		echo'<input type="submit" value="VALIDER"/>';
		echo'<input type="reset" value="ANNULER"/>';
		echo'</center>';
		echo'</form>';
	}
?>

</section>


<!-- sidebar -->
<aside id="sidebar">

<?php
//L'utilisateur est connecté
if (isset($_SESSION['pseudo'])){
	$pseudo = $_SESSION['pseudo'];
	echo'<div class="sidemenu">';
				echo'<h3>Menu Latéral</h3>';
				echo'<ul>';
					echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
					//ajouter page de contact?
					echo'<li><a href="index.php">Contact</a><span></span></li> ';
					echo'<li><a href="publier.php">Publier</a><span></span></li>';
					echo'<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';

				echo'</ul>';
	echo'</div>';
}
//L'utisateur n'est pas connecté
else{
	echo'<div class="sidemenu">';
				echo'<h3>Menu Latéral</h3>';
				echo'<ul>';
					echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
					echo'<li><a href="connexion.php">Connexion</a><span></span></li>';
					echo'<li><a href="inscription.php">Inscription</a><span></span></li>';
					//ajouter page de contact?
					echo'<li><a href="index.php">Contact</a><span></span></li> ';
				echo'</ul>';
	echo'</div>';

}
?>

</aside>
</body>

</html>
		