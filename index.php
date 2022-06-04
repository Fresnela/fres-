<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./image/Snapchat-113966070.jpg" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>Zoulou Z13</title>
</head>
<body>
	<nav>
		<a href="index.php">Rafraichir</a>
		<?php 
			/*SI ON EST CONNECTE*/
			if(isset($_SESSION["compte"])){
				$user= $_SESSION['compte'];
				echo "<a href='compte.php?user=$user'>$user</a>";
				echo "<a href='PHP/disconnect.php'>Déconnexion</a>";
			}
			else{
				echo "<a href='inscription.php'>Inscription</a>";
				echo "<a href='connexion.php'>Connexion</a>";
			}
		?>
	</nav>
	<div id="main-content">
	<?php 
		if(isset($_SESSION['compte'])){
			include "PHP/post.php";
		}
		else{
			echo "<section style='padding-left:15px;'>";
			echo "<p>Pour visualiser les messages veuillez vous <u>connecter</u> ou vous <u>inscrire</u>.</p>";
			echo "</section>";
		}
	?>
	</div>
</body>
</html>