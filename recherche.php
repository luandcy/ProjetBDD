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
        
	<article class="post">

           <!-- 
			/*
                    //Connexion à la base
                    $connexion=mysqli_connect("localhost", "root", "");
			        mysqli_select_db($connexion, "projet_bdd");

                    //Récupération des données
                    $req = 'SELECT * FROM artistes WHERE IdArtiste = '.$id.';';
                    $res = mysqli_query($connexion, $req);
                    $artiste=mysqli_fetch_array($res);

                    //Récupération du l'auteur du texte (utilisateur)
                    $req2 = 'SELECT Pseudo FROM utilisateurs WHERE IdUser = '.$artiste['IdUser'].';';
                    $res2 = mysqli_query($connexion, $req2);
                    $nom_user=mysqli_fetch_array($res2)['Pseudo'];

                    //Récupération du nom de l'image artiste
                    $req3 = 'SELECT NomImage FROM images WHERE IdArtiste = '.$id.';';
                    $res3 = mysqli_query($connexion, $req3);
                    $nom_image=mysqli_fetch_array($res3)['NomImage'];

                    //Récupération du genre de l'artiste
                    $req4 = 'SELECT NomGenre FROM genres WHERE IdGenre = '.$artiste['IdGenre'].';';
                    $res4 = mysqli_query($connexion, $req4);
                    $nom_genre=mysqli_fetch_array($res4)['NomGenre'];

                    //Affichage
                    echo '<h1>'.$artiste['NomArtiste'].'</h1>';
                    
                    echo '<p class="post-info">Publié par <a href="index.php">'.$nom_user.'</a> | <span class="datetime">'.$artiste['DatePublicationArtiste'].'</span></p>';
                    echo '<div class="image-section">';
                        echo '<img src="images/'.$nom_image.'" alt="image post" width="550" height="210"/>';
                    echo '</div>';

                    echo $artiste['TexteArtiste'];

                    echo '<p class="tags"><span>Genre musical : </span>';
                    echo '<a href="#">'.$nom_genre.'</a></p>';

                mysqli_close($connexion);
			*/	
			-->
	<?php
	
		//Affichage d'un  artiste à partir de son id 
		$artiste = $_GET["recherche"];
	
		$connexion=mysqli_connect("localhost", "root", "");
		mysqli_select_db($connexion, "projet_bdd");
		
		$req= 'SELECT * FROM artistes WHERE NomArtiste LIKE "'.$artiste.'";';
		$res = mysqli_query($connexion, $req);

			while ($enr_artiste=mysqli_fetch_array($res))
			{

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
				
				//Affichage
                    echo '<h1>'.$enr_artiste['NomArtiste'].'</h1>';
                    
                    echo '<p class="post-info">Publication du <span class="datetime">'.$enr_artiste['DatePublicationArtiste'].'</span></p>';
                    echo '<div class="image-section">';
                    echo '<img src="images/'.$nom_image['NomImage'].'" alt="image post" width="550" height="210"/>';
                    echo '</div>';
                    echo $enr_artiste['TexteArtiste'];
					echo '<p></span><a class="" href="avis.php?artiste='.$enr_artiste['IdArtiste'].'">Donner un avis</a></p>';//Pour commenter et donner une note à la publication
                    echo '<p class="tags"><span>Note </span>';
                    echo '<a href="#">'.$enr_artiste['NoteArtiste'].'</a></p>';

			}
				mysqli_close($connexion);		
						
     ?>
	 
    </article>
</body>

</html>