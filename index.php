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
		
	<!--Menu----------------------------------->
	<div id="header-wrap">
		<header>
            
				<h1><br/></h1>
				<br/>
                <center>
					<h2><img width="200"height="95" src="images/logo2.png"/><h2>
				</center>
				
        	<nav>
			<ul>
				<li id="current"><a href="index.php">Accueil</a><span></span></li>
				<li><a href="#contact">Contact</a><span></span></li>
				
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
						

	<!--Artiste du mois----------------------------------->

    <div id="featured-wrap">
	<article id="featured" class="clearfix">
		<br/>
		<center>
			<h4>Bienvenue sur le blog de Luan et Nathanaël</h4>
			<p>MIASHS L3 2022-2023 _ Projet de base de données </p>
		</center>
		
		<!--Récupération de la publication la plus récente -->
		<?php
			//Connexion à la base
			$connexion=mysqli_connect("localhost", "root", "");
			mysqli_select_db($connexion, "projet_bdd");
			
			//Récupération des données sur l'artiste
            $req = 'SELECT IdArtiste, SUBSTRING(TexteArtiste, 1, 300) AS TexteArtiste, NomArtiste, DatePublicationArtiste, NoteArtiste ,IdUser
					FROM artistes ORDER BY DatePublicationArtiste DESC;';
			$res = mysqli_query($connexion, $req);
			$enr_artiste = mysqli_fetch_array($res);
			
			//Récupération du l'auteur de la publication (utilisateur)
            $req2 = 'SELECT Pseudo FROM utilisateurs WHERE IdUser = '.$enr_artiste['IdUser'].';';
			$res2 = mysqli_query($connexion, $req2);
			$nom_user = mysqli_fetch_array($res2)['Pseudo'];

			//Récupération de l'image à partie de "IdArtiste"
			$req3 = 'SELECT NomImage FROM images WHERE IdArtiste = '.$enr_artiste['IdArtiste'].'';
			$res3 = mysqli_query($connexion, $req3);
			//Récupération de la 3ème requête (pas besoin de boucle car 1 seul enregistrement)
            $nom_image = mysqli_fetch_array($res3);	
		?>

		<div class="text-block">
			<h1> Artiste du mois</h1>
			<h3><a href="artiste.php?artiste='<?php echo $enr_artiste['IdArtiste'];?>'"><?php echo $enr_artiste['NomArtiste']; ?></a></h3>
			<p class="post-meta">Posté par <a href="index.php"><?php echo $nom_user ; ?></a>|<span class="datetime"><?php echo $enr_artiste['DatePublicationArtiste'];?></span></p>
			<p><?php echo $enr_artiste['TexteArtiste']; ?>[...] </p>
			<p><a href="artiste.php?artiste='<?php echo $enr_artiste['IdArtiste'];?>'"class="more">Continuer la lecture</a></p>
		</div>
		
		<div class="image-block">
			<a title="" href="#"><img width="335" height="240" alt="featured" src="images/<?php echo $nom_image['NomImage']; ?>" /></a>
		</div>
		
		<?php mysqli_close($connexion);?>
	</article>
	</div>
		
	<!-- Contenu----------------------------------->

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
						echo '<a href="index.php" title="photo de l\'artiste x"><img width="240" height="240" alt="img" class="thumbnail" src="images/'.$nom_image['NomImage'].'" /></a>';

						echo '<div class="top">';
						echo '<h4><a href="index.php">'.$enr_artiste['NomArtiste'].'</a></h4>';
						echo '<p><span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span><a class="comment" href="index.php">'.$count.' Commentaires</a></p>';
						echo '<p></span><a class="" href="avis.php?artiste='.$num_artiste.'">Donner un avis</a></p>';//Pour commenter et donner une note à la publication
						echo '</div>';

						echo '<div class="content">';
							echo '<p>'.$enr_artiste['TexteArtiste'].'[...]</p>';	
							echo '<p><a href="artiste.php?artiste='.$num_artiste.'"class="more">Continuer la lecture</a></p>';

						echo '</div>';
					echo '</article>';
					}	
				if ($i % 2 != 0) {
					echo '<article class="col even">';
						echo '<a href="index.php" title="photo de l\'artiste x"><img width="240" height="240" alt="img" class="thumbnail" src="images/'.$nom_image['NomImage'].'" /></a>';

						echo '<div class="top">';
						echo '<h4><a href="index.php">'.$enr_artiste['NomArtiste'].'</a></h4>';
						echo '<p><span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span><a class="comment" href="index.php">'.$count.' Commentaires</a></p>';
						echo '<p></span><a class="" href="avis.php?artiste='.$num_artiste.'">Donner un avis</a></p>';//Pour commenter et donner une note à la publication
						echo '</div>';

						echo '<div class="content">';
							echo '<p>'.$enr_artiste['TexteArtiste'].'[...]</p>';
							echo '<p><a href="artiste.php?artiste='.$num_artiste.'"class="more">Continuer la lecture</a></p>';
						echo '</div>';
					echo '</article>';
                }
				$i = $i + 1;
				}
				mysqli_close($connexion);
	    ?>
	</section>

	<!-- sidebar ------------------------------------->
<aside id="sidebar">

	<div class="sidemenu">
				<h3>Menu Latéral</h3>
					<ul>
						<li id="current"><a href="index.php">Accueil</a><span></span></li>
						<li><a href="index.php">Contact</a><span></span></li>
						<?php

						//Utilisateur est connecté
							if (isset($_SESSION['pseudo'])and isset($_SESSION['admin']))
							{
								echo'<li><a href="deconnexion.php">Déconnexion</a><span></span></li>';
								//Utilisateur connecté et administrateur
								if ($_SESSION['admin'] == 1)
								{
								echo'<li><a href="publier.php">Publier</a><span></span></li>';
								}
							}
						//Utilisateur n'est pas connecté
							else 
							{
								echo'<li><a href="connexion.php">Connexion</a><span></span></li>';
								echo'<li><a href="inscription.php">Inscription</a><span></span></li>';
							}

						?> 
					</ul>

<!-- /sidebar -->
</aside>

<!--CONTACT ET MAIL-->

<div id="extra-wrap">
	<div id="extra" class="clearfix">
	
		<div class="col">

		   <center> <h3 id="contact"> <a href ="index.php" > Nos contacts </a> </h3> </center>
		
			<center>
				<p>
					<strong>Tel Luan : </strong>+1234567<br/>
					<strong>E-mail Luan : </strong> <a href ="" >luan.dechery@univ-lyon2.fr<a>

				</p>
				<p>
					<strong>Tel Nathanaël : </strong>+1234567<br/>
					<strong>E-mail Nathanaël : </strong> <a href ="" >rasambaharinosy-nath.rasoamanana@univ-lyon2.fr<a>
				</p>
			</center>
			
		</div>	
	</div>	
</div>	

</body>

</html>