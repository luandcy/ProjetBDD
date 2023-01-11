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
<section>
<!-- Recupération des info sur l'artiste à créer -->
<?php
If (!empty($_POST["nom_artiste"])and !empty($_POST["descri"])and !empty($_POST["genre"])and !empty($_POST["note"])){
 $nom_artiste = $_POST["nom_artiste"];
 $descri = $_POST["descri"];
 $genre = $_POST["genre"];
 $note = $_POST["note"];
 
	//connexion à la bd
	$connexion = mysqli_connect("localhost","root","");
	mysqli_select_db($connexion, "projet_bdd");
	
	
	// Création de la requête pour ajouter le nouvel artiste
	$req = 'INSERT INTO artistes (NomArtiste, TexteArtiste,NoteArtiste, DatePublicationArtiste, IdUser, IdGenre) VALUES ("'.$nom_artiste.'","'.$descri.'","'.$note.'","'.date("Y/m/d").'","'.$_SESSION['ID'].'","'.$genre.'");';

	// Exécution de la requête pour l'ajout de l'artiste
	mysqli_query($connexion, $req); 
	
	//récupérer l'IdArtiste du nouvel artiste (pour l'ajouter à la table images de la bd enuite)
	$req2 = 'SELECT IdArtiste FROM artistes WHERE NomArtiste LIKE "'.$nom_artiste.'";';
	$res = mysqli_query($connexion, $req2);
	
	//echo'Votre publication a été ajoutéé !';
	
	while ($enr_artiste = mysqli_fetch_array($res))
	{
		$id_artiste = $enr_artiste['IdArtiste'];
		$_SESSION['id_artiste'] = $id_artiste ;
	}

	
	//Fermeture de la connexion
	
	mysqli_close($connexion) ;
	echo'<center>';
	echo'<h1>';
		echo'Votre publication a été ajoutéé !';
	echo'</h1>';
 	echo'</center>';
	
}
else
{
	echo'<center>';
	echo'<h1>';
		die("Tous les champs ne sont pas remplis!!");
	echo'</h1>';
 	echo'</center>';

}
?>

<!-- Recupération de l'image de l'artiste à créer -->
<?php
//Vérification du transfert
If ($_FILES['nom_fichier']['error'])
{
	echo'<center>';
	echo'<h1>';
		die("Erreur lors du transfert d'image !");
	echo'</h1>';
 	echo'</center>';
}

//Transfert de l'image dans le répertoire images

If(isset($_FILES['nom_fichier']['name'])&&($_FILES['nom_fichier']['error']== UPLOAD_ERR_OK))

{
	$chemin_destination = 'images/';
	
	move_uploaded_file($_FILES['nom_fichier']['tmp_name'],$chemin_destination.$_FILES['nom_fichier']['name']);
 
	//connexion à la bd
	$connexion = mysqli_connect("localhost","root","");
	mysqli_select_db($connexion, "projet_bdd");
	
	
	// Création de la requête pour ajouter la nouvelle image de l'artiste
	$req = 'INSERT INTO images (NomImage, IdArtiste) VALUES ( "'.$_FILES['nom_fichier']['name'].'","'.$_SESSION['id_artiste'].'");';

	// Exécution de la requête pour l'ajout de l'image de l'artiste
	mysqli_query($connexion, $req); 
	
	//Fermeture de la connexion
	mysqli_close($connexion) ;
	
}
else
{
	echo'<center>';
	echo'<h1>';
		die("Tous les champs ne sont pas remplis!!");
	echo'</h1>';
 	echo'</center>';}
?>
</section>