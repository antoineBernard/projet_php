<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="contenu">
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
  	?>
   <div class="boutons_navigation">
  	 <a href="/Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
  	 <a href="Top10.php" class="bouton">Top 10</a>	
   </div>
	
	<?php
	
	if(!empty($_POST['envoyer'])){
		$destinataire='bertrand.benoit202@gmail.com';
		$objet='abgames - '.$_POST['objet'];
		$message=$_POST['message'];
		$enTete = 'From: '.$_POST['prenom'].' '.$_POST['nom'].' <'.$_POST['email'].'>'."\r\n";
		
		if(mail($destinataire,$objet,$message,$enTete)){
			echo "Message envoyé !<br>";
		}
		else{
			echo "Echec de l'envoi du message !<br>";
		}
	}
	?>
	
   
   <div class="formulaire_utilisateur">
    <form action="Formulaire_contact.php" method="post" id="formulaire_contact">
		<fieldset><legend>Contacte-nous</legend>
			<label for="nom">Nom :</label><input type="text" name="nom" placeholder="votre nom" maxlength="30" required/><br><br>
			<label for="prenom">Prénom :</label><input type="text" name="prenom" maxlength="30" placeholder="votre prénom" required/><br><br>
			<label for="email">Adresse électronique :</label><input type="text" name="email" maxlength="60" placeholder="example@example.fr" required><br><br>
			<label for="objet">Objet :</label><input type="text" name="objet" maxlength="30" placeholder="sujet de votre message" size="42" required/><br><br>
			<label for="message">Message :</label><textarea name="message" placeholder="Votre message" required ></textarea><br><br>

			<input type="submit" name="envoyer" value="Envoyer" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"/><br>
		</fieldset>
    </form>
   </div>
 </div>   
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>
</body>
</html>