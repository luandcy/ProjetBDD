<?php
session_start();
?>
<html>

	<head>
		<title>MUZIK</title>
	</head>

	<body >

		<table width="100%" border= "1">
			<tr><th> GENRE </th><th> ARTISTE </th></tr>
			<tr><td> genre1 </td> <td> artiste1 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
			<tr><td> genre2 </td> <td> artiste2 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
			<tr><td> genre3 </td> <td> artiste3 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
			<tr><td> genre4 </td> <td> artiste4 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
			<tr><td> genre5 </td> <td> artiste5 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
			<tr><td> genre6 </td> <td> artiste6 </td> <td><a href="avis.php?artiste=IdArtist">voir</a></td></tr>
		</table><br/><br/>
		<form action="index.php" method="POST">  
		<select name="artiste" size="">
			<option value="artiste1">
			Michael Jackson
			</option>
			<option value="artiste2">
			Lionnel Ritchie
			</option>
			<option value="artiste3">
			Rihanna
			</option>
			<option value="artiste4">
			Katie Perry
			</option>
			<option value="artiste5">
			Marvin Gaye
			</option>
		</select>
		<br/><br/>
			<select name="genre" size="">
			<option value="genre1">
			Pop
			</option>
			<option value="genre2">
			Rock and Roll
			</option>
			<option value="genre3">
			RnB
			</option>
			<option value="genre4">
			Blues
			</option>
			<option value="genre5">
			Jazz
			</option>
		</select>
		</form>
		<br/>
		<a href ="connexion.php">CONNEXION</a><br/><br/>
		<a href ="inscription.php">INSCRIPTION</a><br/><br/>
		<a href ="poster.php">POSTER</a><br/><br/>
	</body>

</html>