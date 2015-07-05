<?php
	session_start ();//indispensable pour garder la connexion

	//session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- css de base de Jquery -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<!-- j'importe ma jolie librairie Jquery et JqueryUI pour faire de l'ajax (modifier des données HTML sans recharger la page -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>

 	<link rel="stylesheet" type="text/css" href="projet_Web.css">
 	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    	
  <!-- css de base de Jquery -->
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	
	<!-- du javascript comme s'il en pleuvait-->
	<script>
	
		//je cache le formulaire au chargement de la page (comme ça si l'utilisateur désactive javascript, il pourra quand même utiliser le formulaire)
		$(document).ready(function(){
        $("#recherche_generale").addClass("hidden");
	});
	
	//quand la page est chargé est prêt, lors du click sur le bouton 1, tu charge le contenu du fichier txt dans la div #recherche avec des effets
	$(document).ready(function(){
		//jquery pour le clique
	    $("#btn1").click(function(){
	        $(this).hide();
	        $('#recherche_generale').removeClass("hidden");
	    });
	});
	
	
	$(document).ready(function() {
    $('#menu-item-9').click(function(){
        $('#repair-drop').removeClass('hide');
        $('#repair-drop').animate({"max-height":"500px", "padding-top":"20px", "opacity":"1"},1500, "easeOutCubic");
    });
$('#repair-drop').on('mouseleave', function(e) {
    setTimeout(function() {
        $('#repair-drop').animate({"max-height":"0px", "overflow":"hidden", "padding":"0px","opacity":"0"},2000, "easeOutCubic");

    }, 600);        

});
});

	</script>
</head>
<body>
	<div class="contenu">
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
  ?>
  <div class="boutons_navigation">
  	<a href="Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	

  </div>

  <div  id="recherche">
			<p id="btn1">TROUVE TON JEU</p>
			
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
								<label for="annee_sortie">Sorti après :</label><input type="text" name="annee_sortie" placeholder="année" style="width:20%;" maxlength="4"/>
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
        <h1>Jeu du mois</h1>
	  </div>

	  <div class="resume">
  	   <div class="imgjms">	
	    <img src="<?php echo $jeuDuMois['Jaquette']; ?>" style="width:100%"/>
       </div>
	     <br><h2><?php echo $jeuDuMois['Nom'] ?></h2>
	     <div class="separation"></div>
	    <p style="font-size:17px;"><?php echo $jeuDuMois['Description'] ?></p>
	    <form method="post" action="PageJeux.php">
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
        <h1>Jeu de la semaine</h1>
	  </div>

  	  <div class="resume">
  	   <div class="imgjms">	
	    <img src="<?php echo $jeuSemaine['Jaquette']; ?>" style="width:100%"/>
       </div>
	     <br><h2><?php echo $jeuSemaine['Nom'] ?></h2>  	  	
	     <div class="separation"></div>  	  	
	    <p style="font-size:17px;"><?php echo $jeuSemaine['Description'] ?></p>
	    <form method="post" action="PageJeux.php">
			   <input type="hidden" name="jeu_choisi" value="<?php echo $jeuSemaine['ID_jeu']; ?>"/>
			  <input type="submit" class="bouton jeu_nomine" name="valider" value="En savoir plus sur ce jeu"/>
			  <div class="clear"></div>
			</form>
	  </div>
    </div>
    <div class="clear"></div>	
 
    <div class="commentaires">
	  <?php
	  
	  include 'connexionBDD.php';
	  
	  $extractComms=$bdd->prepare("SELECT commentaire.Commentaire,commentaire.Pseudo_utilisateur,jeux.Nom FROM commentaire,jeux WHERE commentaire.Note>=15 AND commentaire.ID_jeu=jeux.ID_jeu ORDER BY uuid()");
	  $extractComms->execute();
	  
      while($commentaires[]=$extractComms->fetch())
      {
      }	  
	  
      $curseur=0;
      $i=0;
      
      ?>
        <table class="commentaires_accueil">
          <tr>
          <?php 
          while($i<(count($commentaires)-1) && $i<($curseur+3))
          {
            $comm=$commentaires[$i];
            $i++;
            ?>
            <td><div class="commentaire_accueil"><?php echo $comm['Commentaire']."</div><br><i>".$comm['Pseudo_utilisateur']."</i> - ".$comm['Nom']; ?></td>  
          <?php
          }
          $curseur+=3;
          ?>
          </tr>
          <tr>
          <?php
          while($i<(count($commentaires)-1) && $i<($curseur+3))
          {
            $comm=$commentaires[$i];
            $i++;
            ?>
            <td><div class="commentaire_accueil"><?php echo $comm['Commentaire']."</div><br><i>".$comm['Pseudo_utilisateur']."</i> - ".$comm['Nom']; ?></td>  
          <?php
          }
          $curseur+=3;
          ?>
          </tr>
          <tr>
          <?php
          while($i<(count($commentaires)-1) && $i<($curseur+3))
          {
            $comm=$commentaires[$i];
            $i++;
            ?>
            <td><div class="commentaire_accueil"><?php echo $comm['Commentaire']."</div><br><i>".$comm['Pseudo_utilisateur']."</i> - ".$comm['Nom']; ?></td>  
          <?php
          }
          $curseur+=3;
          ?>
          </tr>
        </table>     
    </div>
  
  </div>
    <div class="footer">
	    <a href="Formulaire_contact.php">Contact</a>
    </div>  
</body>
</html>