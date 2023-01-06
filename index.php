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


		<!--Recherche par nom d'artiste-->
        <form id="quick-search" method="get" action="index.html">
            <fieldset class="search">
                <label for="qsearch">Rechercher Artiste:</label>
                <input class="tbox" id="qsearch" type="text" name="recherche" value="Rechercher..." title="Rentrez le nom de l'artiste" />
                <button class="btn" title="Confirmer">Search</button>
            </fieldset>
        </form>

	<!-- /header -->
	</header></div>

	<!--Artiste du mois-->
	<div id="featured-wrap"><article id="featured" class="clearfix">
		<h2>Artiste du mois</h2>

		<div class="image-block">
			<a title="" href="#"><img width="335" height="240" alt="featured" src="images/img-featured.jpg" /></a>
		</div>

		<div class="text-block">
			<h2><a href="#">Nom Artiste bdd</a></h2>
			<p class="post-meta">Posted by <a href="index.html">nath</a> date publication bdd</p>

			<p>texte de la bdd</p>

			<p><a href="index.html" class="more">Continuer la lecture</a></p>

		</div>

	</article></div>
	
	<!-- Contenu============================================================================== -->

<div id="content-wrap-home">

<!-- main -->
<section id="main">

	<h3>Publications récentes</h3>

	<!--Artiste 1-->
	<article class="col">

		<a href="index.html" title="photo de l'artiste x"><img width="240" height="100" alt="img" class="thumbnail" src="images/thumb-1.jpg" /></a>

		<div class="top">

		   <h4><a href="index.html">page artiste1</a></h4>
		   <p><span class="datetime">December 19, 2011(BDD)</span><a class="comment" href="index.html">2 Commentaires (BDD)</a></p>

		</div>

		<div class="content">
			<p>
			texte bdd
			</p>
			<p><a href="#" class="more">continuer la lecture</a></p>

		</div>

	</article>

	<!--Artiste 2-->
	<article class="col even">

		<a href="index.html" title=""><img width="240" height="100" alt="img" class="thumbnail" src="images/thumb-2.jpg" /></a>

		<div class="top">

		   <h4><a href="index.html">page artiste2</a></h4>
		   <p><span class="datetime">December 17, 2011 (BDD)</span><a class="comment" href="index.html">2 Comments(BDD)</a></p>

		</div>

		<div class="content">
			<p>
			texte bdd
			</p>
			<p><a href="#" class="more">continuer la lecture</a></p>
		</div>
	</article>

	<div class="fix"></div>

	<!--Artiste 3-->
	<article class="col">

		<a href="index.html" title=""><img width="240" height="100" alt="img" class="thumbnail" src="images/thumb-3.jpg" /></a>

		<div class="top">

		   <h4><a href="index.html">page artiste1</a></h4>
		   <p><span class="datetime">December 19, 2011(BDD)</span><a class="comment" href="index.html">2 Commentaires (BDD)</a></p>

		</div>

		<div class="content">
			<p>
			texte bdd
			</p>
			<p><a href="#" class="more">continuer la lecture</a></p>

		</div>

	</article>

	<!--Artiste 4-->
	<article class="col even">

		<a href="index.html" title=""><img width="240" height="100" alt="img" class="thumbnail" src="images/thumb-4.jpg" /></a>

		<div class="top">

		   <h4><a href="index.html">page artiste2</a></h4>
		   <p><span class="datetime">December 17, 2011 (BDD)</span><a class="comment" href="index.html">2 Comments(BDD)</a></p>

		</div>

		<div class="content">
			<p>
			texte bdd
			</p>
			<p><a href="#" class="more">continuer la lecture</a></p>
		</div>	

	</article>


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