<?php
	session_start ();//indispensable pour garder la connexion
  include'connexionBDD.php';

	$pseudo = $_SESSION['Pseudonyme'];
	$reponse = $bdd->query('SELECT Admin FROM utilisateurs WHERE Pseudonyme= \''.$pseudo.'\' ');
	$autorisation=-1;
	
	while ($donnees = $reponse->fetch())
	{
	   $autorisation = $donnees['Admin'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
 <div class="contenu">
	<div class="bandeau">
      <form id="recherche_nom_form" method="post" action="Resultat_recherche.php">
        <input type="text" name="recherche_nom" placeholder="Rechercher par nom"/>
      </form>
		  <a href="Accueil.php"><img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
		  <a href="Proposition_jeu.php" id="bouton_proposition">Propose ton jeu</a>
		  
		<?php
		  if(session_status() == PHP_SESSION_NONE)
		  {
	    ?>
        <a href="Connexion_utilisateur.html" id="bouton_proposition">Se connecter</a>
        <?php
      }
		  else
		  {
		    $pseudo = $_SESSION['Pseudonyme'];
	    ?>
		    <a href="Profil_utilisateur.php" id="bouton_connectu"> <?php echo $pseudo; ?> connecté !</a>
		    <?php
		  }
            ?>
    </div>
  
  <div class="boutons_navigation">
	<a href="Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
	
	
	<div class="avatar_actions_utilisateur">
	
		<img src="Images/sid.jpg" style="position:relative;clear:both;margin-top:15px;margin-left:20px;margin-right:auto;margin-right:auto;width:140px;height:140px;"/>
		
		
		<form method="post "action="Modification_profil.php">
				<input type="submit" value="Modifier les infos" id ="modification_profil"/>
		</form>
<?php
	if($autorisation == 1)
	{
?>
		<form method="post "action="backoffice.php">
				<input type="submit" value="Backoffice" id ="bouton_backoffice"/>
		</form>
<?php	
	}
?>
		<div>
      	<!-- le bouton est en fait un formulaire qui envoit vers Deconnexion.php. Celui ci coupe la session et renvoi vers l'accueil-->
  			<form method="post "action="Deconnexion.php">
  				<input type="submit" value="Deconnexion" id ="bouton_deconnexion"/>
  			</form>
  	</div>
	
	</div>
	
	<div class="infos_utilisateur">
		<?php

      // On créé la requête
			$email ="";
			$reponse = $bdd->query('SELECT Adresse_email FROM utilisateurs WHERE Pseudonyme= \''.$pseudo.'\' ');
			
			while ($donnees = $reponse->fetch())
			{
			   $email = $donnees['Adresse_email'];
			}
			
			$reponse->closeCursor();
			echo "<p><b>Nom d'utilsateur :</b> $pseudo <br/><br/>";
			echo   "<b>Adresse de messagerie :</b> $email <br/>";
		
		?>
		</p>
	
	</div>
	
    
	<div class="clear"></div>
 </div>	
    <div class="footer">
	    <a href="Formulaire_contact.php">Contact</a>
    </div> 
</body>
</html>