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
				<!--
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

				
}

?>
	
			</header></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">		

<?php
If (!empty($_POST["pseudo"])and!empty($_POST["mail"])and!empty($_POST["pass"])and!empty($_POST["confirm"]))
//If (!empty($_POST["pseudo"])and!empty($_POST["mail"])and!empty($_POST["pass"]))
{
 $pseudo = $_POST["pseudo"];
 $mail = $_POST["mail"];
 $pass = $_POST["pass"];
 $admin1 = 1;
 $admin0 = 0;
}
 else
{
	die("Vous n'avez pas complété tous les champs!");
}	

//SI ADMINISTRATEUR
If ($_POST["confirm"] == "oui")
{	
 
	//connexion à la base
	$connexion = mysqli_connect("localhost", "root", "");
	mysqli_select_db($connexion,"projet_bdd"); 
 
	//création requête pour recupération de données
	$req = 'SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo.'"AND Mail= "'.$mail.'" AND Password = "'.$pass.'"AND Administrateur="'.$admin1.'";'; 
 
	//envoi de la requête à la base et récupération dans une variable
	$res = mysqli_query($connexion, $req);

	//Compter le nombre de résultats
	if (mysqli_num_rows($res) == 1)
	{
		echo'<br/>Bienvenue '.$pseudo.' !';//L'utilisateur existe!
		$_SESSION['pseudo']=$pseudo;
		$_SESSION['mail']=$mail;
		$_SESSION['pass']=$pass;

		//Recup info sur user
		$enreg_utilisateur = mysqli_fetch_array($res);
		//Ajout de l'id à la session
		$_SESSION['ID'] = $enreg_utilisateur['IdUser'];
	}
	else
	{
		echo'Utilisateur non identifié !';
	}

	//fermeture 
	mysqli_close($connexion);

	//Saisi du code
	/*
	echo'<form action="admin.php" method="POST">';
	echo'Saisir le code admin: <input type="password" size="" name="code_admin"/><br/><br/>';
	echo'<center>';
	echo'<input type="submit" value="VALIDER"/>';
	echo'<input type="reset" value="ANNULER"/>';
	echo'</center>';
	echo'</form>';
	*/
}

//SI NON ADMINISTRATEUR
else
{
	
	//connexion à la base
	$connexion = mysqli_connect("localhost", "root", "");
	mysqli_select_db($connexion,"projet_bdd"); 
 
	//création requête pour recupération de données
	$req = 'SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo.'"AND Mail= "'.$mail.'" AND Password = "'.$pass.'"AND Administrateur="'.$admin0.'";'; 
 
	//envoi de la requête à la base et récupération dans une variable
	$res = mysqli_query($connexion, $req);

	//Compter le nombre de résultats
	if (mysqli_num_rows($res) == 1)
	{
		echo'<br/>Bienvenue '.$pseudo.' !';
		$_SESSION['pseudo']=$pseudo;

		//Recup info sur user
		$enreg_utilisateur = mysqli_fetch_array($res);
		//Ajout de l'id à la session
		$_SESSION['ID'] = $enreg_utilisateur['IdUser'];
	}
	else
	{
		echo'Utilisateur non identifié !';
	}


	//fermeture 
	mysqli_close($connexion);
}		
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

<!-- /sidebar -->
</aside>
</body>

</html>
		