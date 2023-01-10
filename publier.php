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
	//Ajouter un artiste
						
						echo'REMPLISSEZ POUR AJOUTER UN ARTISTE';
						echo'<form action = "publier2.php" method = "POST" ENCTYPE = "multipart/form-data">';
						
						echo'<h3>Nom de l\'artiste</h3>';
						echo'<input type="text" size="" name="nom_artiste"/><br/>';
						
						echo'<h3>Photo de l\'artiste</h3>';
						echo'<input type = "hidden" name = "MAX_FILE_SIZE"  value = 100000 />';
						echo'<input type = "file" name = "nom_fichier" /><br/>';

						
						echo'<h3>Biographie</h3><br/>';
						echo'<textarea name = "descri" rows = "" cols = ""> </textarea><br/>';
						
						echo'<h3>Genre musical</h3>';
						echo'<input type="radio" name="genre"  value="1"/> POP<br/>';
						echo'<input type="radio" name="genre"  value="2"/> R and B<br/>';
						echo'<input type="radio" name="genre"  value="3"/> ROCK and ROLL<br/>';
						echo'<input type="radio" name="genre"  value="4"/> JAZZ<br/>';
						echo'<input type="radio" name="genre"  value="5"/> RAP<br/>';
						echo'<input type="radio" name="genre"  value="6"/> REGGAE<br/>';
						
						echo'<h3>Evaluer l\'artiste</h3>';
						echo'<input type="radio" name="note"  value="1"/> 1';
						echo'<input type="radio" name="note"  value="2"/> 2';
						echo'<input type="radio" name="note"  value="3"/> 3';
						echo'<input type="radio" name="note"  value="4"/> 4';
						echo'<input type="radio" name="note"  value="5"/> 5<br/>';
						
						
						echo'<center>';
						echo'<input type="submit" value="PUBLIER"/>';
						echo'<center/>';

						echo'</form><br/>';
?>
</section>

</body>

</html>