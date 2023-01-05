<?php
session_start();
?>
<html>

	<head>
		<title>MUZIK</title>
	</head>

	<body >
	<?php
		echo'ARTISTE: '.$_GET["artiste"];
	?>
		<br/><br/>
		<a href ="index.php">INDEX</a><br/><br/>
	</body>

</html>