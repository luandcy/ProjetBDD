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
				echo'<form id="quick-search" method="get" action="index.html">';
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
	//Affichage de tout les artistes par ordre de publication ("Date")
		$artiste = $_GET["artiste"];
	
		$connexion=mysqli_connect("localhost", "root", "");
		mysqli_select_db($connexion, "projet_bdd");

		$req = 'SELECT * FROM artistes WHERE IdArtiste = '.$artiste;
		$res = mysqli_query($connexion, $req);

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

					echo '<article class="col">';
						echo '<a href="index.php" title="photo de l\'artiste x"><img width="240" height="100" alt="img" class="thumbnail" src="images/'.$nom_image['NomImage'].'" /></a>';

						echo '<div class="top">';
						echo '<h4><a href="index.php">'.$enr_artiste['NomArtiste'].'</a></h4>';
						echo '<p><span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span><a class="comment" href="index.php">'.$count.' Commentaires</a></p>';
						echo '</div>';

						echo '<div class="content">';
						echo '<p>'.$enr_artiste['TexteArtiste'].'</p>';
						//echo '<p><a href="#" class="more">Aller sur cette publication</a></p>';
						
						//Pour mettre les commentaires et les notes
						echo'<form action="avis2.php" method="POST">';
						echo'Ecrivez votre commentaire.<br/>';
						
						echo'<textarea name="msg" rows="" cols="""></textarea><br/>';
						echo'Note<br/>';
						echo'<input type="radio" name="note"  value="1"/> 1';
						echo'<input type="radio" name="note"  value="2"/> 2';
						echo'<input type="radio" name="note"  value="3"/> 3';
						echo'<input type="radio" name="note"  value="4"/> 4';
						echo'<input type="radio" name="note"  value="5"/> 5<br/>';
						
						echo'<center>';
						echo'<input type="submit" value="ENVOYER"/>';
						echo'<input type="reset" value="SUPPRIMER"/><br/><br/>';
						echo'<center/>';

						echo'</form><br/>';
						
						echo '</div>';
						
					echo '</article>';
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