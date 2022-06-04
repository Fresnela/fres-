<?php 
	$base = new mysqli("localhost", "root", "root", "bts4b");
	if($base->connect_error){
		exit("erreur de connexion");
	}
	$sql = "SELECT compte FROM utilisateurs";/*demande de recuperation des noms de comptes*/
	$comptes = $base->query($sql);/*on recupere les noms de comptes*/
	if(isset($_POST)){
		extract($_POST);/*on crée des variables a partir des champs du formulaire*/
		/*on neutralise les caracteres problématiques (par exemple les balise html et symboles SQL comme ') */
		$compte = $base->real_escape_string(
			htmlspecialchars($compte));
		$mdp1 = $base->real_escape_string(
			htmlspecialchars($mdp1));
		$mdp2 = $base->real_escape_string(
			htmlspecialchars($mdp2));
		$bio = $base->real_escape_string(
			htmlspecialchars($bio));

		$compteOK = TRUE;/*Variable qui representera si le nom de compte est valable*/
		$mdpOK = FALSE;/*Variable qui representera si le mot de passe est valable*/

		/*VERIFICATION POUR LE NOM DE COMPTE*/
		if(strpos($compte, " ") != FALSE){
			$compteOK=FALSE; /*si il y a un espace dans le nom, le nom de compte n'est pas valide*/
		}
		foreach($comptes as $ligne) {
			$compteBase = strtolower($ligne["compte"]);
			if(strtolower($compte) == $compteBase){
				$compteOK=FALSE; /*si le nom de compte existe déjà dans la base celui que l'on a tapé n'est pas valide*/
			}
		}

		/*VERIFICATION POUR LE MOT DE PASSE*/
		for($i=0; $i < 10; $i++) { 
			if(strpos($mdp1, "$i") != false){
				$mdpOK=TRUE;/*s'il y a un chiffre dans le mdp, celui ci est valide*/
			}
		}
		if($mdp1 != $mdp2){
			$mdpOK = FALSE;/*si les 2 mdp sont differents le mot de passe n'est pas valide*/
		}
		if(strpos($mdp1, " ") != false){
			$mdpOK = FALSE; /*s'il y a un espace dans le mdp il n'est pas valide*/
		}

		if($mdpOK && $compteOK){
			$sql = "INSERT INTO utilisateurs
			(compte, mdp, bio)
			VALUES ('$compte', '$mdp1', '$bio')";
			$base->query($sql);/*si tout est OK on envoi les valeurs dans la base de données*/

			$redirect = "../connexion.php";/*redirection vers la page de connexion*/
		}
		else{
			$redirect = "../inscription.php?erreur=TRUE";
		}
	}
	else{
		$redirect = "../index.php";/*si pas de POST on redirige vers la page d'index*/
	}
	$base->close();
	header("location: $redirect");
?>