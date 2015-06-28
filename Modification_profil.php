<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>

    <?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
		
    ?>
    
  <div class="boutons_navigation">
	<a href="Accueil.html" class="bouton actif" style="margin-right:10px;">Accueil</a>
	<a href="Top10.html" class="bouton">Top 10</a>	
  </div>
   
   <div class="formulaire_utilisateur">
    <form action="Confirmation_modification_profil.php" method="post" id="modification_utilisateur">
		<fieldset><legend>Remplissez vos modifications de profil</legend>
			<label for="mdp">Nouveau mot de passe :</label><input type="password" name="mdp" maxlength="30" placeholder="votre mot de passe" required/><br><br>
			<label for="confirm_mdp">Nouveau mot de passe :</label><input type="password" name="confirm_mdp" maxlength="30" placeholder="confirmez votre mot de passe" required/><br><br>
			<label for="email">Nouvelle adresse_mail :</label><input type="text" name="email" maxlength="60" placeholder="example@example.fr" required><br><br>
			<input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"/><br>
		</fieldset>
    </form>
   </div>
   
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>