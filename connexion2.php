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
If (!empty($_POST["pseudo"])and!empty($_POST["mail"])and!empty($_POST["pass"])and!empty($_POST["confirm"]))
{
 $pseudo = $_POST["pseudo"];
 $mail = $_POST["mail"];
 $pass = $_POST["pass"];
}
 else
{
	die("Vous n'avez pas complété tous les champs!");
}	

if ($_POST["confirm"] == "oui")
{
	echo'Saisir le code admin:<input type="password" size="" name="code_admin"/><br/><br/>';
	$admin = 1;
}
else 
{
	$admin = 0;
}	

 
 //connexion à la base
 $connexion = mysqli_connect("localhost", "root", "");
 mysqli_select_db($connexion,"projet_bdd"); 
 
 //création requête pour recupération de données
 $req = 'SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo.'"AND Mail= "'.$mail.'" AND Password = "'.$pass.'"AND Administrateur= "'.$admin.'";'; 
 
 //envoi de la requête à la base et récupération dans une variable
 $res = mysqli_query($connexion, $req);

 //Compter le nombre de résultats
 if (mysqli_num_rows($res) == 1)
 {
	 echo'<br/>Bienvenue '.$pseudo.' !';//L'utilisateur existe!
	 $_SESSION['pseudo']=$pseudo;
	 //Recup info sur user
	 $enreg_utilisateur = mysqli_fetch_array($res);
	 //Ajout de l'id à la session
	 $_SESSION['ID'] = $enreg_utilisateur['IdUser'];
 }
 else{
 echo'Utilisateur non identifié !';
}

 //fermeture 
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
		