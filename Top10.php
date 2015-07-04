<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
  <title>Top 10</title>
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
  	<a href="Top10.php" class="bouton actif">Top 10</a>	
  </div>
	<div class="notre_selection">
		Top 10 !
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>

	<div class="jeux_suggeres">

	<?php
	  include 'connexionBDD.php';
	  
	  $extraction=$bdd->query('SELECT * FROM jeux ORDER BY Note DESC');
	  
	  $tab_jeu=null;
	  
	  for($i=0;$i<10;$i++)
	  {
	  	if($tab_jeux[$i]=$extraction->fetch())
	  	{
	  	?>
		  
		  <!-- <table class="tableau_jeu">
		      <tr><td rowspan="4"><img src="<?php /*echo $tab_jeux[$i]['Jaquette']; ?>" style="max-width:100px"/></td><td><?php echo 'Jeu : '.$tab_jeux[$i]['Nom'];?></td><td><?php echo 'Studio : '.$tab_jeux[$i]['Nom_studio']; ?></td></tr>
			  <tr><td><?php echo 'Genre :'.$tab_jeux[$i]['Genre']; ?></td><td><?php echo 'Univers : '.$tab_jeux[$i]['Univers']; ?></td></tr>
			  <tr><td><?php echo 'Sortie : '.$tab_jeux[$i]['Sortie']; ?></td><td></td></tr>
			  <tr><td><?php echo 'Note : <b>'.$tab_jeux[$i]['Note'].'<b>'; */ ?></td></tr>
		  </table><br> -->
		  
		  <img src="<?php echo $tab_jeux[$i]['Jaquette']; ?>" style="max-width:100px;float:left;margin-top:15px;margin-left:15px;margin-right:15px;"/><div class="ref_jeu"> <?php echo 'Jeu : '.$tab_jeux[$i]['Nom']."\t".'Studio : '.$tab_jeux[$i]['Nom_studio']."<br>";
		  echo 'Genre :'.$tab_jeux[$i]['Genre']."\t\t".'Univers : '.$tab_jeux[$i]['Univers']."<br>";
		  echo 'Sortie : '.$tab_jeux[$i]['Sortie']."<br>";
		  echo 'Note : <b>'.$tab_jeux[$i]['Note']."</b><br><br>";
		  ?>
		  </div>		  

		  <form method="post" action="PageJeux.php">
		      <input type="hidden" name="jeu_choisi" value="<?php echo $tab_jeux[$i]['ID_jeu']; ?>"/>
			  <input type="submit" class="bouton jeu" name="valider" value="En savoir plus sur ce jeu"/>
		  </form>
		  <br><hr/>
	<?php
	  	}
	  }
	  $extraction->closeCursor();
    ?>
	



	</div>
 </div>
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>	
  </body>
</html>