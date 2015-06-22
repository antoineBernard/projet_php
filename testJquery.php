<?php
	session_start ();//indispensable pour garder la connexion

	//session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- j'importe ma jolie librairie Jquery pour faire de l'ajax (modifier des données HTML sans recharger la page -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
	<!-- du javascript comme s'il en pleuvait-->
	<script>
	$(document).ready(function(){
	    $("#btn1").click(function(){
	        $("#recherche").load("formulaire_trouve_jeu.txt");
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
			<button id="btn1">TROUVE TON JEU BRO !</button>
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