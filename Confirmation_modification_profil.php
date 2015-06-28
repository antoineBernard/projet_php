<?php
	session_start();
	include'connexionBDD.php';
	
	$reponse = $bdd->query('SELECT ID_utilisateur FROM utilisateurs WHERE Pseudonyme= \''.$_SESSION['Pseudonyme'].'\' ');
	
	while ($donnees = $reponse->fetch())
	{
	   $id_utilisateur = $donnees['ID_utilisateur'];
	}
	
	$reponse->closeCursor();
	
	
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

	<?php
		include 'bandeau.php';
		echo "user : ".$id_utilisateur;
		
		$new_pseudonyme = $_POST['pseudo'];
        $new_mot_de_passe = $_POST['mdp'];
        $new_confirm_mdp = $_POST['confirm_mdp'];
        $new_email = $_POST['email'];
        
        if($new_mot_de_passe == $new_confirm_mdp)
        {
        
            $requette = "UPDATE utilisateurs SET Pseudonyme= '$new_pseudonyme', WHERE ID_utilisateur= $id_utilisateur";
            
            $prepare = $bdd->prepare($requette);
    
            // et bim on execute
            $prepare->execute();
        }
        elseif (!(filter_var($new_email, FILTER_VALIDATE_EMAIL)))
        {
            echo "impossible : l'email n'est pas valide";
        }
        else
        {
            echo "impossible : les deux mots de passe saisis sont différents";
        }
		
    ?>
  <div class="boutons_navigation">
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
    <div class="modification_effectué" >
      <p>Modification effectué ! Vous pouvez maintenant vous reconnecter :) </p>
      
        	<!-- le bouton est en fait un formulaire qui envoit vers Deconnexion.php. Celui ci coupe la session et renvoi vers l'accueil-->
  		<form method="post "action="Deconnexion.php">
  			<input type="submit" value="Retourner à l'accueil" id ="bouton"/>
  		</form>
  		
   </div>
  
    
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>