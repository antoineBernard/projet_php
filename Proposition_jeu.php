<!DOCTYPE html>
<html>
<head>
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
    ?>
  <div class="boutons_navigation">
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
   <div class="formulaire_utilisateur">
    <form action="Creation_jeu.php" method="post" id="proposition_jeu">
		<fieldset><legend>Propose ton jeu</legend>
			<label for="nom_jeu_propose">Nom du jeu :</label><input type="text" name="nom_jeu_propose" placeholder="votre nom" maxlength="40" required/><br><br>
			<label for="studio_jeu_propose">Studio :</label><input type="text" name="studio_jeu_propose" maxlength="40" placeholder="votre prénom" required/><br><br>
			<label for="genre_jeu_propose">Genre :</label><input type="text" name="genre_jeu_propose" maxlength="30" placeholder="genre du jeu" required/><br><br>			
			<label for="email">Adresse électronique :</label><input type="text" name="email" maxlength="60" placeholder="VOTRE adresse électronique" size="25" required><br><br>
			<label for="message">Description :</label><textarea name="message" required >Décrivez brièvement le jeu ici.</textarea><br><br>

			<input type="submit" name="envoyer" value="Envoyer" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"/><br>
		</fieldset>
    </form>
   </div>
   
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>