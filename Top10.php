<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
 	 ?>
  <div class="boutons_navigation">
  	<a href="/Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton actif">Top 10</a>	
  </div>
	<div class="notre_selection">
		Top 10 !
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>

	<div class="jeux_suggeres">
	
	</div>
	
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
  </body>
</html>