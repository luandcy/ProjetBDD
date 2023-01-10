<?php
session_start();
?>

<!DOCTYPE html>
<head>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>MUZIK</title>
    
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <body id="top">
        
</head>

<!-- header
============================================================================= -->
<body id="top">

<!-- head
============================================================================= -->

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

<div id="content-wrap">

    <!-- main -->
    <section id="main">

        <?php
            if (!isset($_GET["artiste"])){
                die("Aucun artiste séléctionné.");
                }
            else {
                $id = $_GET["artiste"];
            }    
        ?>


        <article class="post">

            <?php
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
					
					//Pour commenter et donner une note à la publication
					echo '<p></span><a class="" href="avis.php?artiste='.$id.'">Donner un avis</a></p>';
					
                    echo '<p class="tags"><span>Genre musical : </span>';
                    echo '<a href="#">'.$nom_genre.'</a></p>';

                mysqli_close($connexion);
            ?>
    </article>

    <h3>Commentaires</h3>

        <ol class="commentlist">

            <?php

            //!! Faire une boucle pour tout les commentaires

            $connexion=mysqli_connect("localhost", "root", "");
            mysqli_select_db($connexion, "projet_bdd");

            //Récupération des données
            $req = 'SELECT * FROM avis WHERE IdArtiste = '.$id.' ORDER BY DateAvis DESC;';
            $res = mysqli_query($connexion, $req);
            
            while ($avis = mysqli_fetch_array($res)) {
           
                //Récupération de l'avatar de l'utilisateur
                $req2 = 'SELECT Avatar, Pseudo FROM utilisateurs WHERE IdUser = '.$avis['IdUser'].';';
                $res2 = mysqli_query($connexion, $req2);
                $user = mysqli_fetch_array($res2);
    
                echo '<li class="depth-1">';
    
                    echo '<div class="comment-info">';
                    echo '<img alt="" src="images/'.$user['Avatar'].'" class="avatar" height="40" width="40" />';
                        echo '<cite>';
                        echo '<a href="index.php">'.$user['Pseudo'].'</a> Says: <br />';
                        echo '<span class="comment-data"><a href="#comment-63" title="">'.$avis['DateAvis'].'</a></span>';
                        echo '</cite>';
                    echo '</div>';
                
                    echo '<div class="comment-text">';
                        echo '<p>'.$avis['TexteAvis'].'</p>';
                    echo '</div>';
                echo '</li>';
            } 
            
            mysqli_close($connexion);

            ?>     

        </ol>
		
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
            
</div>
            