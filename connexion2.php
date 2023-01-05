<?php
session_start();
?>
<?php
		echo'PSEUDO: '.$_POST["pseudo"].'<br/><br/>';
		echo'MAIL: '.$_POST["mail"].'<br/><br/>';
		echo'MDP: '.$_POST["pass"].'<br/><br/>';
		if ($_POST["confirm"]== "oui")
		{
		echo'Vous êtes administrateur !';
		}
		echo'<br/><br/><a href ="index.php">ACCUEIIL</a><br/><br/>';	
	?>