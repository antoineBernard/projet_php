<!DOCTYPE html>
<html>
<head>
	<title>Trouve ton jeu !</title>
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
	<div class="notre_selection">
		Notre sélection pour vous
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>

	<div class="jeux_suggeres">
  	   <?php
			$genre=$_POST['genre'];
			$univers=$_POST['univers'];
			$annee=(int)$_POST['annee_sortie'];
			if($annee<1960 || $annee>2020)
			{
		       echo "Entrez une année valide !";
			}
			else
			{
			  echo $genre." ".$univers." ".$annee;
			  
			  try
			  {
				  $servername = getenv('IP');
				  $username = getenv('C9_USER');
    		  $password = "";
				  $database = "ProjetWeb";
				  $bdd=new PDO("mysql:host=$servername;dbname=$database",$username,$password);
		  	}
			  catch(Exception $e)
			  {
			  	echo "Erreur de connexion avec la base : projetweb\n";
		  		echo 'Message : '.$e->getMessage()."\n";
			  }
			  
			  $req = $bdd->prepare('SELECT Nom, Sortie, Nom_studio, Genre, Univers, URL FROM jeux WHERE Genre=:Genre AND Univers=:Univers');
			  
			  $criteres=array(
			  	             ':Genre'=>$genre,
			  	             ':Univers'=>$univers
			  	            );
			  $req=execute($criteres);
			  
			  while($jeuTrouve = $criteres->fetch())
			  {
			    echo $jeuTrouve['Nom']."\t".$jeuTrouve['Nom_studio']."\n";
			    echo $jeuTrouve['Genre']."\t".$jeuTrouve['Univers']."\n";
			    echo $jeuTrouve['Sortie']."\n\n";
			  }
			  
			  $req->closeCursor();
			}
		?>
	</div>
	
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
  </body>
</html>