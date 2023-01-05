<?php
session_start();
?>

<?php
		echo'PSEUDO: '.$_POST["pseudo"].'<br/><br/>';
		echo'MAIL: '.$_POST["mail"].'<br/><br/>';
		echo'MDP: '.$_POST["pass"].'<br/><br/>';
		echo'MDP2: '.$_POST["pass2"].'<br/><br/>';
		echo'<a href ="index.php">ACCUEIIL</a><br/><br/>';	
	?>