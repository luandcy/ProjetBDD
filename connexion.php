<?php
session_start();
?>
<html>

	<head>
		<title>MUZIK</title>
	</head>
	

	<body >
		<form action="connexion2.php" method="POST">
			<input type="text" size="" name="pseudo"/> Pseudo<br/><br/>
			<input type="text" size="" name="mail"/> Mail<br/><br/>
			<input type="password" size="" name="pass"/> Mot de passe<br/><br/>
			Administrateur <br/>
			<input type="radio" name="confirm"  value="oui"/> OUI<br/>
			<input type="radio" name="confirm"  value="non"/> NON<br/><br/>
			<input type="submit" value="ENVOYER"/>
		</form>
		<a href ="index.php">ACCUEIIL</a><br/><br/>
	</body>

</html>