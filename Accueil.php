<?php
	session_start ();//indispensable pour garder la connexion

	//session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- css de base de Jquery -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<!-- j'importe ma jolie librairie Jquery et JqueryUI pour faire de l'ajax (modifier des données HTML sans recharger la page -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<!-- du javascript comme s'il en pleuvait-->
	<script>
	
	//quand la page est chargé est prêt, lors du click sur le bouton 1, tu charge le contenu du fichier txt dans la div #recherche avec des effets
	$(document).ready(function(){
		//jquery pour le clique
	    $("#btn1").click(function(){
	        $(this).hide();
	        $("#recherche_generale").removeClass("hidden").fadeIn();
	    });
	});
	

	</script>
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

  <div class="recherche" id="recherche">
			<p id="btn1">TROUVE TON JEU</p>
			
			<table id="recherche_generale" class="hidden">
				<form method="post" action="Resultat_recherche_bandeau.php">
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
  
    <?php
    
     include 'fonctions.php';

    ?>

  
    <div class="encadre">
    	<?php
				/*
				$jeuDuMois=null;
    	  $faire=null;
    	  if(date("d")!=02)
    	  {
    	   $faire=true;
    	  }
    	  if(date("d")==01 && $faire==true)
    	  {
    	   $jeuDuMois=choixJeuxNomine();
    	   $faire=false;
    	  }
    	
    	 */
    	 include 'connexionBDD.php';
    	 
    	 $reqJeuMois=$bdd->query("SELECT * FROM jeux WHERE Jeu_mois=1");
    	 $jeuDuMois=$reqJeuMois->fetch();
    	 
    	?>
      <div class="intitule">
        Jeu du mois
	  </div>
	  <div class="imgjms">
	    <img src="Images/Endless_Space_Box_Art_No_Age_Rating.jpg" style="height:100%;width:100%;"/>
	  </div>
	  <div class="titre">	   
	     <?php echo $jeuDuMois['Nom'] ?>
	  </div>
		<div class="clear"></div>	  
	  <div class="resume">
	    <p><?php echo $jeuDuMois['Description'] ?></p>
	    <form method="post" action="PageJeux_testAntoine.php">
			  <input type="hidden" name="jeu_choisi" value="<?php echo $jeuDuMois['ID_jeu']; ?>"/>
			  <input type="submit" class="bouton jeu_nomine" name="valider" value="En savoir plus sur ce jeu"/>
			  <div class="clear"></div>
			</form>
	  </div>
    </div>
	 
	<div class="encadre">
		  <?php
    	 include 'connexionBDD.php';
    	 
    	 $reqJeuSemaine=$bdd->query("SELECT * FROM jeux WHERE Jeu_semaine=1");
    	 $jeuSemaine=$reqJeuSemaine->fetch();
    	 
    	?>
    <div class="intitule">
        Jeu de la semaine
	  </div>
	  <div class="imgjms">
	    <img src="Images/sid.jpg" style="height:100%;width:100%;"/>
	  </div>
	  <div class="titre">	   
	     <?php echo $jeuSemaine['Nom'] ?>
	  </div>
			<div class="clear"></div>
  	  <div class="resume">
	    <p><?php echo $jeuSemaine['Description'] ?></p>
	    <form method="post" action="PageJeux_testAntoine.php">
			   <input type="hidden" name="jeu_choisi" value="<?php echo $jeuSemaine['ID_jeu']; ?>"/>
			  <input type="submit" class="bouton jeu_nomine" name="valider" value="En savoir plus sur ce jeu"/>
			  <div class="clear"></div>
			</form>
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