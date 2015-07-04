<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
	<title>Résultat de recherche !</title>
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
	<div class="notre_selection">
		Resultat de la recherche
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>


	<div class="jeux_suggeres">
	   <?php
	   
	   if(!empty($_POST['valider']))
	   {
			$genre=$_POST['genre'];
			$univers=$_POST['univers'];
			$annee=(int)$_POST['annee_sortie'];
			if($annee<1960 || $annee>2020)
			{
		       echo "Entrez une année valide !";
			}
			else
			{

			  try
			  {
		         include 'connexionBDD.php';
		  	  }
			  catch(Exception $e)
			  {
			  	echo "Erreur de connexion avec la base : projetweb\n";
		  		echo 'Message : '.$e->getMessage()."\n";
			  }
			  
			  $req = $bdd->prepare('SELECT * FROM jeux WHERE Genre=:Genre AND Univers=:Univers');
			  
			  $criteres=array(
			  	             'Genre'=>$genre,
			  	             'Univers'=>$univers
			  	            );
			  $req->execute($criteres);
			  

			  $i=0;
			  while($jeuTrouve[$i] = $req->fetch())
			  {
			  	$annee_jeu=substr($jeuTrouve[$i]['Sortie'],-4);
			    $annee_jeu=(int)$annee_jeu;
			  	
			  	if($annee_jeu>=$annee)
			  	{
			  	
			  	?>
			  	  <table class="tableau_jeu">
			  	      <tr><td><?php echo 'Jeu : '.$jeuTrouve[$i]['Nom'];?></td><td><?php echo 'Studio : '.$jeuTrouve[$i]['Nom_studio']; ?></td></tr>
			  		  <tr><td><?php echo 'Genre :'.$jeuTrouve[$i]['Genre']; ?></td><td><?php echo 'Univers : '.$jeuTrouve[$i]['Univers']; ?></td></tr>
			  		  <tr><td><?php echo 'Sortie : '.$jeuTrouve[$i]['Sortie']; ?></td><td></td></tr>
			  		  <tr><td><?php echo 'Note : '.$jeuTrouve[$i]['Note']; ?></td></tr>
			  	  </table><br>

			  	  <form method="post" action="PageJeux.php">
			  	      <input type="hidden" name="jeu_choisi" value="<?php echo $jeuTrouve[$i]['ID_jeu']; ?>"/>
			  		  <input type="submit" class="bouton jeu" name="valider" value="En savoir plus sur ce jeu"/>
			  	  </form>
			  	  <br><hr/>
			  	
			  	<?php
			  	}
			  	$i++;
			  }
			  
			  $req->closeCursor();
			}
	   }
	   else
	   {
  	   
	    include'connexionBDD.php';
			
			$nomJeu = $_POST['recherche_nom'];
			
			//TODO : l'améliorer et faire qu'il puisse prendre plusieurs jeu avec LIKE (ex : Where Nom like '%space%')
			$reponse = $bdd->prepare('SELECT * FROM jeux WHERE Nom like :Nom');
			
			$tab_reponse=array('Nom'=>"%".$nomJeu."%");
			
			$reponse->execute($tab_reponse);
			
			$i=0;
			while ($jeuTrouve[$i] = $reponse->fetch())
			{
			 ?>
			  	  <table class="tableau_jeu">
			  	      <tr><td><?php echo 'Jeu : '.$jeuTrouve[$i]['Nom'];?></td><td><?php echo 'Studio : '.$jeuTrouve[$i]['Nom_studio']; ?></td></tr>
			  		  <tr><td><?php echo 'Genre :'.$jeuTrouve[$i]['Genre']; ?></td><td><?php echo 'Univers : '.$jeuTrouve[$i]['Univers']; ?></td></tr>
			  		  <tr><td><?php echo 'Sortie : '.$jeuTrouve[$i]['Sortie']; ?></td><td></td></tr>
			  		  <tr><td><?php echo 'Note : '.$jeuTrouve[$i]['Note']; ?></td></tr>
			  	  </table><br>

			  	  <form method="post" action="PageJeux.php">
			  	      <input type="hidden" name="jeu_choisi" value="<?php echo $jeuTrouve[$i]['ID_jeu']; ?>"/>
			  		  <input type="submit" class="bouton jeu" name="valider" value="En savoir plus sur ce jeu"/>
			  	  </form>
			  	  <br><hr/>
			<?php 
			  $i++;
			}
		$reponse->closeCursor();
	   }
	   ?>

	</div>

  </div>
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>
</body>
</html>