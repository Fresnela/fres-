<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./image/Snapchat-1740859535.jpg" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>Fresnel Mbimi A</title>
</head>
<body>
	<section id="form-cont">
		<?php 
			if(isset($_GET)){
				echo ($_GET['erreur'] == TRUE)?
				"<p>Erreur de nom de compte ou de mot-de-passe</p>" : "";
			}
		?>
		<form id="form" method="post" action="PHP/insert.php">
			<label>Nom de compte</label>
			<input type="text" name="compte" minlength="5"
			maxlength="15" required placeholder="Nom de compte entre 5 et 15 caractères">

			<label>Mot de passe</label>
			<input type="password" name="mdp1" minlength="5" 
			maxlength="25" required placeholder="Mdp avec 1 chiffre">

			<label>Confirmez mot de passe</label>
			<input type="password" name="mdp2" minlength="5" 
			maxlength="25" required placeholder="Mdp avec 1 chiffre">

			<label>Description de votre compte</label>
			<textarea name="bio" maxlength="255" placeholder="Entrez une description de votre compte (optionel)"></textarea>

			<input type="submit" name="inscription" value="s'inscrire">
		</form>
		<a href="index.php">Annuler</a>
	</section>
</body>
</html>