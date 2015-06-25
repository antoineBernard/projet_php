<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
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
   	<?php
		
  	$servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "ProjetWeb";
    $dbport = 3306;

    // Create connection
    $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
    
    $id_jeu = $_SESSION['ID_jeu'];
    
			$reponse = $bdd->query("SELECT * FROM jeux WHERE ID_jeu= $id_jeu");

			while ($donnees = $reponse->fetch())
			{
			   echo "<p> bienvenue sur la page du jeu : <b>".$donnees['Nom']."</b></br>";
			   echo "l'id du jeu en variable de session : $id_jeu";
			}
    ?>

  
	<div class="fiche_jeu"> 
	  <div class="presentation_jeu">
        >
      </div>



      <div class="note_jeu">
		17/20
      </div>


      <div class="test_jeu">
        
      </div>  

      <div class="commentaires_jeu">
        <p>Commentaires d'utilisateurs</p>
      </div>
      
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
  </div>
  </body>
</html>