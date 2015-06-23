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
		Resultat de la recherche
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>

	<div class="jeux_suggeres">
  	   <?php
  	   
  	       $servername = getenv('IP');
		    $username = getenv('C9_USER');
		    $password = "";
		    $database = "ProjetWeb";
		    $dbport = 3306;
		
		    // Create connection
		    $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
			
			$nomJeu = $_POST['recherche_nom'];
			$reponse = $bdd->query('SELECT * FROM jeux WHERE Nom= \''.$nomJeu.'\' ');
			$id_jeu=-1;//j'initialise pour être sûr, mais la valeur sert à rien
			while ($donnees = $reponse->fetch())
			{
				 $id_jeu = $donnees['ID_jeu'];
			   echo "<p> Jeu : <b>".$donnees['Nom']."</b></br>";
			   echo "Studio : ".$donnees['Nom_studio']."</br>";
			   echo "Genre : ".$donnees['Genre']."</br>";
			   echo "Univers : ".$donnees['Univers']."</p></br>";
			   
			}
			$_SESSION['ID_jeu'] = $id_jeu;
		?>
		<form method="post" action="PageJeux_testAntoine.php">
			<input type="submit" value="En savoir plus sur ce jeux !" id="acces_page_jeux"/>
		</form>
	</div>
	
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
  </body>
</html>