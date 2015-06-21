﻿<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un jeu</title>
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
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
  
   <div id="formulaire_jeu_backoffice">
    <form action="Creation_jeu.php" method="post" id="ajout_jeu">
		<fieldset><legend>Ajouter un jeu</legend>
			<label for="nom_jeu">Nom du jeu :</label><input type="text" name="nom_jeu" maxlength="50" required /><br><br>
			<label for="studio">Studio :</label><input type="text" name="studio" maxlength="40" required /><br><br>
			<label for="editeur">Éditeur :</label><input type="text" name="editeur" maxlength="40" required /><br><br>
			<label for="genre">Genre :</label><select name="genre">
												<option>Action</option>
												<option>Aventure</option>
												<option>FPS</option>
												<option>Jeu de rôles</option>
												<option>Réflexion</option>		
												<option>Simulation</option>
												<option>Stratégie</option>
												<option>Survival</option>						
											  </select><br><br>	
			<label for="univers">Univers :</label><select name="univers">
													<option>Contemporain</option>
													<option>Fantastique</option>
													<option>Historique</option>
													<option>Horreur</option>
													<option>Science-fiction</option>
													<option>Steampunk</option>
												  </select><br><br>			
			<label for="date_sortie">Année de sortie :</label><input type="text" name="date_sortie" maxlength="10" placeholder="jj/mm/yyyy" required /><br><br>
			<label for="description">Description :</label><textarea name="description" placeholder="Description du jeu"required ></textarea><br><br>
			<label for="test">Test :</label><textarea name="test" placeholder="Test du jeu"required ></textarea><br><br>
			
			<input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"><br>
		</fieldset>
    </form>
   </div>
   
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>