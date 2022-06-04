<section id="message-form">
	<form id="form" method="post" action="
	<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<textarea id="post-message" name="message" placeholder="dites quelque chose" maxlength="255"></textarea>
		<input type="submit" name="postMessage" value="envoyer message">
	</form>
</section>

<?php 
	$base = new mysqli("localhost", "root", "root", "bts4b");
	if($base->connect_error){
		exit("erreur de connexion");
	}
	if(isset($_POST['postMessage'])){
		//Envoi du message dans la base de donnée
		$compte = $_SESSION['compte'];
		date_default_timezone_set("Europe/Paris");//on regle le fuseau horaire sur paris
		$date = date("Y-m-d");// on recupere la date
		$heure = date("H:i:s");// on recupere l'heure
		$message = $base->real_escape_string(
			htmlspecialchars($_POST['message']));

		$sql = "INSERT INTO messages (compte, message, date, heure) VALUES ('$compte', '$message', '$date', '$heure')";

		$base->query($sql);
	}
?>
<main id="messages-cont">
	<?php 
		$sql = "SELECT * FROM messages ORDER BY date DESC, heure DESC";
		$resultat = $base->query($sql);
		foreach($resultat as $ligne) {
			$dateTitle = $ligne['date']." / ".$ligne['heure'];
			$lien = "compte.php?user=".$ligne['compte'];
			echo "<div class='message' title='$dateTitle'>";
			echo "<h5><a href='$lien'>{$ligne['compte']}</a></h5>";
			echo "<p>{$ligne['message']}</p>";
			echo "</div>";
		}
		$base->close();
	?>
</main>