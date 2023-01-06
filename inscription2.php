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

<?php
If(!empty($_POST["pseudo"])and!empty($_POST["adress"])and!empty($_POST["pass"])and!empty($_POST["confirmation"])){
 $pseudo = $_POST["pseudo"];
 $mail = $_POST["adress"];
 $pass = $_POST["pass"];
 $pass2 = $_POST["confirmation"];
}
else
{
die("Les champs sont vides!");
}

If($pass ==$pass2)
{ 
  //connexion à la base
  $connexion = mysqli_connect("localhost", "root", "");
  mysqli_select_db($connexion,"projet_bdd");
  
  //création de la requête
  $req = 'INSERT INTO utilisateurs (Pseudo, Password, Mail) VALUES ("'.$pseudo.'","'.$pass.'","'.$mail.'");';
  //echo $req.'<br/>';
  
  //envoi de la requête
  mysqli_query($connexion, $req);
  
	//création requête pour recupération de données
	$req2 = 'SELECT Pseudo, IdUser FROM utilisateurs WHERE Pseudo = "'.$pseudo.'" AND Password = "'.$pass.'";'; 
 
	//envoi de la requête à la base et récupération dans une variable
	$res = mysqli_query($connexion, $req2);
}
else
{
	die("Mot de passe invalide !");
}
	
 //Compter le nombre de résultats
 if (mysqli_num_rows($res) == 1){
	 echo'Vous êtes connecté! Bienvenue '.$pseudo.' !';//L'utilisateur existe!
	 $_SESSION['pseudo']=$pseudo;
	 //Recup info sur user
	 $enreg_utilisateur = mysqli_fetch_array($res);
	 //Ajout de l'id à la session
	 $_SESSION['ID'] = $enreg_utilisateur['IdUser'];
 }
  
  //fermeture de la connexion
  mysqli_close($connexion);
  
  echo'Vous avez été enregistré avec le pseudo :'.$pseudo; 
  $_SESSION['pseudo']=$pseudo;	
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
		