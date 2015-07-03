<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  <div class="contenu">
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
  	?>
   <div class="boutons_navigation">
  	 <a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	 <a href="Top10.php" class="bouton">Top 10</a>	
   </div>
	
   
   <div class="formulaire_utilisateur">
    <form action="Inscription_utilisateur.html" method="post" id="formulaire_contact">
		<fieldset><legend>Contacte-nous</legend>
			<label for="nom">Nom :</label><input type="text" name="nom" placeholder="votre nom" maxlength="30" required/><br><br>
			<label for="prenom">Prénom :</label><input type="text" name="prenom" maxlength="30" placeholder="votre prénom" required/><br><br>
			<label for="email">Adresse électronique :</label><input type="text" name="email" maxlength="60" placeholder="example@example.fr" required><br><br>
			<label for="objet">Objet :</label><input type="text" name="objet" maxlength="30" placeholder="sujet de votre message" size="42" required/><br><br>
			<label for="message">Message :</label><textarea name="message" required >Votre message</textarea><br><br>

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