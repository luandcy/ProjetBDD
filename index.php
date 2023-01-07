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
				<hgroup>
					<img width="200"height="100" src="images/logo_zik.png" />200
				</hgroup>
			<!-- <header>
				<!-- Problème : je n'arrive pas à afficher le logo -->
				<!-- <hgroup>
					<h1>
						<a href="index.php">Blog de Musique</a>
					</h1>
					<h3>Nathanael et Luan</h3>
				</hgroup>
				-->
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

				<!--Recherche par nom d'artiste-->
				<form id="quick-search" method="get" action="index.html">
					<fieldset class="search">
						<label for="qsearch">Rechercher Artiste:</label>
						<input class="tbox" id="qsearch" type="text" name="recherche" value="Rechercher..." title="Rentrez le nom de l'artiste" />
						<button class="btn" title="Confirmer">Search</button>
					</fieldset>
				</form>

	<!-- /header -->
			</header></div>

	<!--Artiste du mois-->
	<div id="featured-wrap"><article id="featured" class="clearfix">
		<h2>Artiste du mois</h2>

		<div class="image-block">
			<a title="" href="#"><img width="335" height="240" alt="featured" src="images/BobMarley.jpg" /></a>
		</div>

		<div class="text-block">
			<h2><a href="#">Nom Artiste bdd</a></h2>
			<p class="post-meta">Posted by <a href="index.html">nath</a> date publication bdd</p>

			<p>texte de la bdd</p>

			<p><a href="index.html" class="more">Continuer la lecture</a></p>

		</div>

	</article></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">

	<h3>Publications récentes</h3>
	<?php
	//Affichage de tout les artistes par ordre de publication ("Date")
	
		$connexion=mysqli_connect("localhost", "root", "");
		mysqli_select_db($connexion, "projet_bdd");

		$req = 'SELECT * FROM artistes ORDER BY DatePublicationArtiste DESC;';
		$res = mysqli_query($connexion, $req);

		$i = 0;

			while ($enr_artiste=mysqli_fetch_array($res)){

				$num_artiste = $enr_artiste['IdArtiste'];

				//Récupération de l'image à partie de "IdArtiste"
				$req2 = 'SELECT NomImage FROM images WHERE IdArtiste = '.$num_artiste.'';
				$res2=mysqli_query($connexion, $req2);
				//Récupération de la 2ème requête (pas besoin de boucle car 1 seul enregistrement)
				$nom_image = mysqli_fetch_array($res2);

				//Récupération du nombre de commentaire sur une publication d'un artiste
				$req3 = 'SELECT * FROM avis WHERE IdArtiste = '.$num_artiste.';';
				$res3 = mysqli_query($connexion, $req3);
				$count = mysqli_num_rows($res3);

				if ($i % 2 == 0) {


					echo '<article class="col">';
						echo '<a href="index.php" title="photo de l\'artiste x"><img width="240" height="100" alt="img" class="thumbnail" src="images/'.$nom_image['NomImage'].'" /></a>';

						echo '<div class="top">';
						echo '<h4><a href="index.php">'.$enr_artiste['NomArtiste'].'</a></h4>';
						echo '<p><span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span><a class="comment" href="index.php">'.$count.' Commentaires</a></p>';
						echo '</div>';

						echo '<div class="content">';
							echo '<p>'.$enr_artiste['TexteArtiste'].'</p>';
							echo '<p><a href="#" class="more">continuer la lecture</a></p>';
						echo '</div>';
					echo '</article>';
				}
				if ($i % 2 != 0) {
					echo '<article class="col even">';
						echo '<a href="index.php" title="photo de l\'artiste x"><img width="240" height="100" alt="img" class="thumbnail" src="images/'.$nom_image['NomImage'].'" /></a>';

						echo '<div class="top">';
						echo '<h4><a href="index.php">'.$enr_artiste['NomArtiste'].'</a></h4>';
						echo '<p><span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span><a class="comment" href="index.php">'.$count.' Commentaires</a></p>';
						echo '</div>';

						echo '<div class="content">';
							echo '<p>'.$enr_artiste['TexteArtiste'].'</p>';
							echo '<p><a href="#" class="more">continuer la lecture</a></p>';
						echo '</div>';
					echo '</article>';
				}

				$i = $i + 1;
		}

		mysqli_close($connexion);

	?>
	
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