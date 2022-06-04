<?php 
	$base = new mysqli("localhost", "root", "root", "bts4b");
	if($base->connect_error){
		exit("erreur de connexion a la base de données");
	}
	/*on recupere nom de compte de mdp depuis la table utilisateurs*/
	$comptes = $base->query("SELECT compte, mdp FROM utilisateurs");
	if(isset($_POST)){
		// si on reçoit un formulaire
		extract($_POST); // on aura 2 variable $compte et $mdp
		foreach ($comptes as $ligne) {
			/*si on trouve le nom de compte et le mdp sur la meme ligne du tableau*/
			if($compte == $ligne["compte"] && $mdp == $ligne["mdp"]){
				session_start();// on se connecte a la session sur le serveur
				$_SESSION['compte'] = $compte; // on y crée la case 'compte' 
				$redirect = "../index.php"; // on renvoi vers la page d'acceuil
			}
		}
		if(isset($redirect) == FALSE){
			$redirect = "../connexion.php?erreur=TRUE";
		}
	}
	else{
		// si connexion au script accidentelle
		$redirect = "../index.php";
	}
	$base->close();
	header("location: $redirect");
?>