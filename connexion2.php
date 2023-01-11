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
If (!empty($_POST["pseudo"])and!empty($_POST["mail"])and!empty($_POST["pass"])and!empty($_POST["confirm"]))
//If (!empty($_POST["pseudo"])and!empty($_POST["mail"])and!empty($_POST["pass"]))
{
 $pseudo = $_POST["pseudo"];
 $mail = $_POST["mail"];
 $pass = $_POST["pass"];
}
 else
{
	echo'<center>';
	echo'<h1>';
		die("Vous n'avez pas complété tous les champs!");
	echo'</h1>';
 	echo'</center>';
}	

//SI ADMINISTRATEUR
If ($_POST["confirm"] == "oui")
{	
 
	$admin =  1; 
	//connexion à la base
	$connexion = mysqli_connect("localhost", "root", "");
	mysqli_select_db($connexion,"projet_bdd"); 
 
	//création requête pour recupération de données
	$req = 'SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo.'"AND Mail= "'.$mail.'" AND Password = "'.$pass.'"AND Administrateur="'.$admin.'";'; 
 
	//envoi de la requête à la base et récupération dans une variable
	$res = mysqli_query($connexion, $req);

	//Compter le nombre de résultats
	if (mysqli_num_rows($res) == 1)
	{
		echo'<center>';
		echo'<h1>';
			echo'<br/>Bienvenue '.$pseudo.' !';//L'utilisateur existe!
		echo'</h1>';
		echo'</center>';
		$_SESSION['pseudo']=$pseudo;
		$_SESSION['admin']=$admin;//Variable à récupérer pour la gestion de l'autorisation de publier du contenu


		//Recup info sur user
		$enreg_utilisateur = mysqli_fetch_array($res);
		//Ajout de l'id à la session
		$_SESSION['ID'] = $enreg_utilisateur['IdUser'];
	}
	else
	{
		echo'<center>';
		echo'<h1>';
			echo'Utilisateur non identifié !';
		echo'</h1>';
		echo'</center>';
	}

	//fermeture 
	mysqli_close($connexion);

}

//SI NON ADMINISTRATEUR
else
{
	$admin =  0; 
	//connexion à la base
	$connexion = mysqli_connect("localhost", "root", "");
	mysqli_select_db($connexion,"projet_bdd"); 
 
	//création requête pour recupération de données
	$req = 'SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo.'"AND Mail= "'.$mail.'" AND Password = "'.$pass.'"AND Administrateur="'.$admin.'";'; 
 
	//envoi de la requête à la base et récupération dans une variable
	$res = mysqli_query($connexion, $req);

	//Compter le nombre de résultats
	if (mysqli_num_rows($res) == 1)
	{
		echo'<br/>Bienvenue '.$pseudo.' !';
		$_SESSION['pseudo']=$pseudo;
		$_SESSION['admin']=$admin;//Variable à récupérer pour la gestion de l'interdiction de publier du contenu


		//Recup info sur user
		$enreg_utilisateur = mysqli_fetch_array($res);
		//Ajout de l'id à la session
		$_SESSION['ID'] = $enreg_utilisateur['IdUser'];
	}
	else
	{
		echo'<center>';
		echo'<h1>';
			echo'Utilisateur non identifié !';
		echo'</h1>';
		echo'</center>';
	}


	//fermeture 
	mysqli_close($connexion);
}		
?>

</section>
</aside>
</body>

</html>
		