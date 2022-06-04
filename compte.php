<!DOCTYPE html>
<html>
<?php 
	session_start();
	$base = new mysqli("localhost", "root", "root", "bts4b");
	if($base->connect_error){
		exit("erreur de connexion");
	}
	if(isset($_GET['user'])){
		$user = $_GET['user'];// on pourra reutiliser $user plus loin dans la page
		$checkUser = $base->query("SELECT compte 
			FROM utilisateurs WHERE compte='$user'");
		if($checkUser->num_rows == 1){
			$check = TRUE;
		}
	}
	if(!isset($_SESSION['compte']) || !isset($check)){
		header("location: index.php");
	}
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./image/naruto-shippuden.jpg" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>Profil de <?php echo $user;?></title>
</head>
<body>
	<h1>Bienvenu dans votre compte</h1>
	 <div id="main">
	<img src="https://i.pinimg.com/originals/4c/9a/4c/4c9a4c6c5b84f18ac3f5d7f9ccfa0156.png" id="banner" alt=""/>
	<p>+33651621782</p>
	<h5>voici notre numero pour tous savoir</h5>
    </div>
	<av>
		<a href="index.php">Accueil</a>
		<a href="PHP/disconnect.php">Déconnexion</a>
	</nav>
	<div id="main-content">
		<header id="profil">
			<?php
				$bio = $base->query("SELECT bio FROM utilisateurs
					WHERE compte='$user'");
				echo "<h2>$user</h2>";
				foreach ($bio as $ligne) {
					echo "<p>{$ligne['bio']}</p>";
				}
			?>
		</header>

		<main id="messages-cont">
			<?php 
			$sql = "SELECT * FROM messages WHERE compte='$user' ORDER BY date DESC, heure DESC";
			$resultat = $base->query($sql);
			foreach($resultat as $ligne) {
				$dateTitle = $ligne['date']." / ".$ligne['heure'];
				echo "<div class='message' title='$dateTitle'>";
				echo "<h5>{$ligne['compte']}</h5>";
				echo "<p>{$ligne['message']}</p>";
				echo "</div>";
			}
			$base->close();
			?>
		</main>
	</div>
</body>
</html>