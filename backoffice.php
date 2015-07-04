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
	<title>Ajouter un jeu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="contenu">
		
		<?php
		//j'ai fais un include pour alléger les répétitions de code
			include 'bandeau.php';
	    ?>
	  <div class="boutons_navigation">
	  	<a href="/Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection">
		Backoffice
	</div>
	   <div id="formulaire_jeu_backoffice">
		 <form method="post "action="jeu_backoffice.php">
			<input type="submit" value="Ajouter un jeu" id ="acces_backoffice"/>
		 </form>
		 
		 <form method="post "action="utilisateur_backoffice.php">
			<input type="submit" value="Gestion utilisateurs" id ="acces_backoffice"/>
		 </form>
		 
		 
 	 	<form method="post "action="commentaire_backoffice.php">
			<input type="submit" value="Gestion des commentaires" id ="acces_backoffice"/>
		 </form>
		 
		 <form method="post "action="nomination_backoffice.php">
			<input type="submit" value="Gestion des jeux" id ="acces_backoffice"/>
		 </form>
		 
		 
  	 	<form method="post "action="proposition_backoffice.php">
			<input type="submit" value="Voir les propositions de jeux" id ="acces_backoffice"/>
		 </form>
	   </div>
</div>	   
	    <div class="footer">
		  <a href="Formulaire_contact.html">Contact</a>
	    </div>
	</body>
<?php
}
else
{
	?>
	<div class="erreur_admin">
		<p>Vous n'avez pas les autorisations requises : profil administrateur</p>
	</div>
	
	<?php
}
?>
</html>