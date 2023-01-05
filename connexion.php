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

	<body >
	
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

				<!-- Problème : je n'arrive pas à afficher le logo -->
				<hgroup>
					<h1><a href="index.php">Blog de Musique</a></h1>
					<h3>Nathanael et Luan</h3>
				</hgroup>

				<!--Menu-->
				<nav>
					<ul>
						<li id="current"><a href="index.php">Accueil</a><span></span></li>
						<li><a href="connexion.php">Connexion</a><span></span></li>
						<li><a href="inscription.php">Inscription</a><span></span></li>
						<li><a href="index.php">Contact</a><span></span></li> <!--ajouter page de contact?-->
						<!--Afficher déconnexion si utilisateur connecté-->
						<li><a href="">Déconnexion</a><span></span></li>
						<!--Afficher si utilisateur est admin-->
						<li><a href="publier.php">Publier</a><span></span></li>
					</ul>
				</nav>

				<div class="subscribe">
					<a href="#">Avatar</a> | <a href="#">utilisateur</a>
				</div>
	
			</header></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">
		<form action="connexion2.php" method="POST">
			<input type="text" size="" name="pseudo"/> Pseudo<br/><br/>
			<input type="text" size="" name="mail"/> Mail<br/><br/>
			<input type="password" size="" name="pass"/> Mot de passe<br/><br/>
			Administrateur <br/>
			<input type="radio" name="confirm"  value="oui"/> OUI<br/>
			<input type="radio" name="confirm"  value="non"/> NON<br/><br/>
			<input type="submit" value="ENVOYER"/>
		</form>
</section>

<!-- sidebar -->
<aside id="sidebar">

			<div class="sidemenu">
				<h3>Menu Latéral</h3>
				<ul>
					<li id="current"><a href="index.php">Accueil</a><span></span></li>
					<li><a href="connexion.php">Connexion</a><span></span></li>
					<li><a href="inscription.php">Inscription</a><span></span></li>
					<li><a href="index.php">Contact</a><span></span></li> <!--ajouter page de contact?-->
					<!--Afficher déconnexion si utilisateur connecté-->
					<li><a href="">Déconnexion</a><span></span></li>
					<!--Afficher si utilisateur est admin-->
					<li><a href="publier.php">Publier</a><span></span></li>
				</ul>
			</div>


			<h3>Galerie de photos</h3>

			<ul class="photostream clearfix">
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
				<li><a href="index.html"><img width="50" height="50" alt="thumbnail" src="images/thumb.jpg"></a></li>
			</ul>


<!-- /sidebar -->
</aside>
</body>

</html>
		