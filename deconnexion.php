<?php
session_start();
$_SESSION = array();
session_destroy();
echo'L\'utilisateur est déconnecté !';
echo'<br/><br/><a href="index.php"> Page d\'accueil.</a>';
?>
