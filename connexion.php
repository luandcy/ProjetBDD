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

				<!-- 
				Problème : je n'arrive pas à afficher le logo 
				<hgroup>
					<h1><a href="index.php">Blog de Musique</a></h1>
					<h3>Nathanael et Luan</h3>
				</hgroup>
				-->

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

				//Recherche par nom d'artiste
				echo'<form id="quick-search" method="get" action="index.php">';
					echo'<fieldset class="search">';
						echo'<label for="qsearch">Rechercher Artiste:</label>';
						echo'<input class="tbox" id="qsearch" type="text" name="recherche" value="Rechercher..." title="Rentrez le nom de l\'artiste" />';
						echo'<button class="btn" title="Confirmer">Search</button>';
					echo'</fieldset>';
				echo'</form>';
}
//L'utisateur n'est pas connecté
else{
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

				//Recherche par nom d'artiste
				echo'<form id="quick-search" method="get" action="index.html">';
					echo'<fieldset class="search">';
						echo'<label for="qsearch">Rechercher Artiste:</label>';
						echo'<input class="tbox" id="qsearch" type="text" name="recherche" value="Rechercher..." title="Rentrez le nom de l\'artiste" />';
						echo'<button class="btn" title="Confirmer">Search</button>';
					echo'</fieldset>';
				echo'</form>';
}

?>

	
			</header></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">		
<?php
if (isset($_session['pseudo'])and $_session['pseudo']!=""){
	$pseudo = $_session['pseudo']; 
echo'Vous êtes déjà connecté.';
echo'<br/><br/><a href="index.php">Retour à l\'index</a>';
}
else{
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


		<!--	<h3>Galerie de photos</h3>

			<ul class="photostream clearfix">
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
			</ul>
		-->

<!-- /sidebar -->
</aside>
</body>

</html>
		