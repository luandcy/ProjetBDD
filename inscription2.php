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
If(!empty($_POST["pseudo"])and!empty($_POST["adress"])and!empty($_POST["pass"])and!empty($_POST["confirmation"])){
 $pseudo = $_POST["pseudo"];
 $mail = $_POST["adress"];
 $pass = $_POST["pass"];
 $pass2 = $_POST["confirmation"];
 $admin = 0;
}
else
{
	echo'<center>';
	echo'<h1>';
		die("Les champs sont vides!");
	echo'</h1>';
 	echo'</center>';
}
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
}
If($pass ==$pass2)
{ 
  //connexion à la base
  $connexion = mysqli_connect("localhost", "root", "");
  mysqli_select_db($connexion,"projet_bdd");
  
  //création de la requête
  $req = 'INSERT INTO utilisateurs (Pseudo, Password, Mail, Administrateur, Avatar) VALUES ("'.$pseudo.'","'.$pass.'","'.$mail.'","'.$admin.'","'.$_FILES['nom_fichier']['name'].'");';
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
	echo'<center>';
	echo'<h1>';
		die("Mot de passe invalide !");
	echo'</h1>';
 	echo'</center>';
	die("Mot de passe invalide !");
}
	
 //Compter le nombre de résultats
 if (mysqli_num_rows($res) == 1){
	 
	echo'<center>';
	echo'<h1>';
	 echo'Vous êtes connecté! <br/> Bienvenue '.$pseudo.' !';
	echo'</h1>';
 	echo'</center>';
	
	 $_SESSION['pseudo']=$pseudo;
	 $_SESSION['admin']=$admin;
	 //Recup info sur user
	 $enreg_utilisateur = mysqli_fetch_array($res);
	 //Ajout de l'id à la session
	 $_SESSION['ID'] = $enreg_utilisateur['IdUser'];
 }
  
  //fermeture de la connexion
  mysqli_close($connexion);
  
  
  //Récupération du pseudo sur la session
  $_SESSION['pseudo']=$pseudo;	
?>

</section>
</aside>
</body>

</html>
		