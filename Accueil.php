<?php
	session_start ();//indispensable pour garder la connexion
	
	session_destroy();
?>
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
  
  <div class="recherche">
  	<table id="recherche_generale">
    	<form method="post" action="Resultat_recherche.php">
    	<tr>
    		<td>
	  			<label for="genre">Genre :</label><select name="genre">
																						<option>Action</option>
																						<option>Aventure</option>
																						<option>FPS</option>
																						<option>Jeu de rôles</option>
																						<option>Réflexion</option>		
																						<option>Simulation</option>
																						<option>Stratégie</option>
																						<option>Survival</option>						
																						</select>
				</td>
				<td>
	  			<label for="univers">Univers :</label><select name="univers">
																								<option>Contemporain</option>
																								<option>Fantastique</option>
																								<option>Historique</option>
																								<option>Horreur</option>
																								<option>Science-fiction</option>
																								<option>Steampunk</option>
																								</select>	
			</td>
		</tr>
		<tr>
				<td>
					<label for="annee_sortie">Sorti après :</label><input type="text" name="annee_sortie" placeholder="annee" style="width:20%;" maxlength="4"/>
				</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="valider" value="Valider"/>
			</td>
		</tr>
		</form>
	</table>
  </div> 
  

    <div class="encadre">
      <div class="intitule">
        <p>Jeu du mois</p>
	  </div>
	  <div class="imgjms">
	    <img src="Images/Endless_Space_Box_Art_No_Age_Rating.jpg" style="height:100%;width:100%;"/>
	  </div>
	  <div class="titre">	   
	     <p>L'âge de glace</p>
	  </div>
	  <div class="resume">
	    <p>Ici sera écrit le résume du jeu du mois.</p>
	  </div>
    </div>
	 
	<div class="encadre">
      <div class="intitule">
        <p>Jeu de la semaine</p>
	  </div>
	  <div class="imgjms">
	    <img src="Images/sid.jpg" style="height:100%;width:100%;"/>
	  </div>
	  <div class="titre">	   
	     <p>L'âge de glace</p>
	  </div>
  	  <div class="resume">
	    <p>Ici sera écrit le résume du jeu de la semaine.</p>
	  </div>
    </div>
    <div class="clear"></div>	
 
    <div class="commentaires">
	  <p style="font-size:50px;">Tout plein de commentaires ici !</p>
    </div>
  
    <div class="defilement_commentaires">
      <img src="Images/bouton_defilement.jpg" style="height:100%;width:100%"/>
    </div>
  
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>