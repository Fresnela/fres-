<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>Dalton prod beat</title>
</head>
<body>
	<section id="form-cont">
		<?php 
			if(isset($_GET)){
				echo ($_GET['erreur'] == TRUE)?
				"<p>Erreur de nom de compte ou de mot-de-passe</p>" : "";
			}
		?>
		<form id="form" method="post" action="PHP/connect.php">
			<label>Nom de compte</label>
			<input type="text" name="compte" required minlength="5" maxlength="15" placeholder="Votre nom de compte">
			<label>Mot de passe</label>
			<input type="password" name="mdp" required minlength="5" maxlength="25" placeholder="Votre mot de passe">
			<input type="submit" name="connexion" value="se connecter">
		</form>
		<a href="index.php">Annuler</a>
	</section>
</body>
</html>