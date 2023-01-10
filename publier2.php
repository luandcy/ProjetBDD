<?php
session_start();
?>

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
	
	while ($enr_artiste = mysqli_fetch_array($res))
	{
		$id_artiste = $enr_artiste['IdArtiste'];
		$_SESSION['id_artiste'] = $id_artiste ;
	}

	
	//Fermeture de la connexion
	mysqli_close($connexion) ;
	
}
else
{
 die("Tous les champs ne sont pas remplis!!");
}
?>

<!-- Recupération de l'image de l'artiste à créer -->
<?php
//Vérification du transfert
If ($_FILES['nom_fichier']['error'])
{
	die("Erreur lors du transfert d'image !");
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
 die("Tous les champs ne sont pas remplis!!");
}
?>
