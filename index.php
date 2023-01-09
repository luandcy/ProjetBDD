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
				<!--<
				hgroup>
					<img width="20"height="100" src="images/logo_zik.png" />
				</hgroup>
				-->
				
				<!--Menu-->
			<?php
			//L'utilisateur est connecté
			if (isset($_SESSION['pseudo'])AND isset($_SESSION['admin']))
				{
				$pseudo = $_SESSION['pseudo'];
				$amdin = $_SESSION['admin']; 
				//Si utilisateur est admin (avec bouton publier)
				if ($amdin == 1)
				{
					echo'<nav>';
						echo'<ul>';
							echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
							echo'<li><a href="index.php">Contact</a><span></span></li>';
							echo'<li><a href="publier.php">Publier</a><span></span></li>';
							echo'<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';
						echo'</ul>';
					echo'</nav>';
				}
				else
				//Si utilisateur n'est pas admin (sans bouton publier)
				{
					echo'<nav>';
						echo'<ul>';
							echo'<li id="current"><a href="index.php">Accueil</a><span></span></li>';
							echo'<li><a href="index.php">Contact</a><span></span></li>';
							echo'<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';
						echo'</ul>';
					echo'</nav>';
				}

					echo'<div class="subscribe">';
						echo'<a href="#">Avatar</a> | <a href="#">'.$_SESSION['pseudo'].'</a>';
					echo'</div>';

				//Recherche avec le nom de l'artiste
					echo'<form id="quick-search" method="get" action="recherche.php">';
						echo'<fieldset class="search">';
							echo'<label for="qsearch">Rechercher Artiste:</label>';
							echo'<input class="tbox" id="qsearch" type="text" name="recherche" value="Michael Jackson" title="Rentrez le nom de l\'artiste" />';
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
					echo'</ul>';
				echo'</nav>';

				echo'<div class="subscribe">';
					echo'<a href="#">Avatar</a> | <a href="#">utilisateur</a>';
				echo'</div>';

				//Recherche avec le nom de l'artiste
				echo'<form id="quick-search" method="get" action="recherche.php">';

					echo'<fieldset class="search">';
						echo'<label for="qsearch">Rechercher Artiste:</label>';
						echo'<input class="tbox" id="qsearch" type="text" name="recherche" value="Michael Jackson" title="Rentrez le nom de l\'artiste" />';
						echo'<button class="btn" title="Confirmer">Search</button>';
						echo'</fieldset>';
				echo'</form>';
			}

			?>

	<!-- /header -->
			</header></div>

	<!--Artiste du mois-->
	<div id="featured-wrap"><article id="featured" class="clearfix">
		<h2>Artiste du mois</h2>

		<!--Récupération de la publication la plus récente (problème : et si on publie plus d'un artiste par mois?)-->
		<!--éventuellement on pourra choisir un artiste en faisant une requête sur un artiste d'ou on connait le nom et qu'on veut mettre en évidence-->
		<?php
			$connexion=mysqli_connect("localhost", "root", "");
			mysqli_select_db($connexion, "projet_bdd");

			$req = 'SELECT IdArtiste, SUBSTRING(TexteArtiste, 1, 300) AS TexteArtiste, NomArtiste, DatePublicationArtiste 
					FROM artistes ORDER BY DatePublicationArtiste DESC;';
			$res = mysqli_query($connexion, $req);

			$enr_artiste=mysqli_fetch_array($res);

			//Récupération de l'image à partie de "IdArtiste"
				$req2 = 'SELECT NomImage FROM images WHERE IdArtiste = '.$enr_artiste['IdArtiste'].'';
				$res2=mysqli_query($connexion, $req2);
				//Récupération de la 2ème requête (pas besoin de boucle car 1 seul enregistrement)
				$nom_image = mysqli_fetch_array($res2);

		?>

		<div class="image-block">
			<a title="" href="#"><img width="335" height="240" alt="featured" src="images/<?php echo $nom_image['NomImage']; ?>" /></a>
		</div>

		<div class="text-block">
			<h2><a href="#"><?php echo $enr_artiste['NomArtiste']; ?></a></h2>
			<p class="post-meta">Posted by <a href="index.php">nath</a> <span class="datetime"><?php echo $enr_artiste['DatePublicationArtiste'];?></span></p>

			<p><?php echo $enr_artiste['TexteArtiste']; ?>[...] </p>

			<p><a href="index.php" class="more">Continuer la lecture</a></p>

		</div>
		<?php mysqli_close($connexion);?>
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

		$req = 'SELECT IdArtiste, SUBSTRING(TexteArtiste, 1, 120) AS TexteArtiste, NomArtiste, DatePublicationArtiste 
				FROM artistes ORDER BY DatePublicationArtiste DESC;';
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
							echo '<p>'.$enr_artiste['TexteArtiste'].'[...]</p>';
							//echo '<p><a href="#" class="more">Aller sur cette publication</a></p>';
							echo '<p><a href="avis.php?artiste='.$num_artiste.'"class="more">Continuer la lecture</a></p>';

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
							echo '<p>'.$enr_artiste['TexteArtiste'].'[...]</p>';
							//echo '<p><a href="#" class="more">Aller sur cette publication</a></p>';
							echo '<p><a href="avis.php?artiste='.$num_artiste.'"class="more">Continuer la lecture</a></p>';
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