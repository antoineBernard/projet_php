<?php
	session_start ();//indispensable pour garder la connexion
	include'connexionBDD.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Propose ton jeu !</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
 <div class="contenu">
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
    ?>
  <div class="boutons_navigation">
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
  
  
  <?php

		if(isset($_POST['envoyer']))
		{
			$nom_contributeur = $_POST['nom_contributeur'];
			$nom_contributeur = trim($nom_contributeur);
			$nom_contributeur=preg_replace('/\s{2,}/',' ',$nom_contributeur);
			
			$nom_jeu = $_POST['nom_jeu_propose'];
			$nom_jeu=trim($nom_jeu);
			$nom_jeu=preg_replace('/\s{2,}/',' ',$nom_jeu);
			
			$nom_studio = $_POST['studio_jeu_propose'];
			$nom_studio=trim($nom_studio);
			$nom_studio=preg_replace('/\s{2,}/',' ',$nom_studio);
			
			$message = $_POST['message'];
			$message = trim($message);
			
			$genre = $_POST['genre_jeu_propose'];
			$email = $_POST['email'];
			
			
			$req = $bdd->prepare('INSERT INTO proposition_jeux (Nom_contributeur, Jeu, Studio, Genre, Adresse_email, Message_contributeur, Date_proposition) 
								VALUES(:Nom_contributeur, :Jeu, :Studio, :Genre, :Adresse_email, :Message_contributeur, CURDATE())');

			$ligne=array(
						 'Nom_contributeur'=>$nom_contributeur,
						 'Jeu'=>$nom_jeu,
						 'Studio'=>$nom_studio,
						 'Genre'=>$genre,
						 'Adresse_email'=>$email,
						 'Message_contributeur'=>$message
						 );
							 

			$req->execute($ligne);	
			$req->closeCursor();

			
			
			echo "<div class='ajout_admin'>";
			echo "Votre proposition à été envoyé, <br> Un administrateur va bientôt évaluer votre propositon. <br> Vous serez prévenu par email si votre jeux est selectionné.";
			echo "</div>";
		}
?>

   <div class="formulaire_utilisateur">
    <form action="Proposition_jeu.php" method="post" id="proposition_jeu">
		<fieldset><legend>Propose ton jeu</legend>
			<label for="nom_contributeur">Votre nom :</label><input type="text" name="nom_contributeur" placeholder="ex: Jean-michel" maxlength="40" required/><br><br>
			<label for="nom_jeu_propose">Nom du jeu :</label><input type="text" name="nom_jeu_propose" placeholder="ex: Endless Space" maxlength="40" required/><br><br>
			<label for="studio_jeu_propose">Studio :</label><input type="text" name="studio_jeu_propose" maxlength="40" placeholder="ex: Amplitude Studio" required/><br><br>
			<label for="genre_jeu_propose">Genre :</label><select name="genre_jeu_propose" required>
					<option>Action</option>
					<option>Aventure</option>
					<option>FPS</option>
					<option>Jeu de rôles</option>
					<option>Plate-formes</option>
					<option>Réflexion</option>
					<option>Simulation</option>
					<option>Stratégie</option>
					<option>Survie</option>
					<option>Autre</option>
				
			</select><br><br>			
			<label for="email">Adresse électronique :</label><input type="email" name="email" maxlength="60" placeholder="VOTRE adresse électronique" size="25" required><br><br>
			<label for="message">Description :</label><textarea name="message" placeholder="Décrivez brièvement le jeu ici." required ></textarea><br><br>

			<input type="submit" name="envoyer" value="Envoyer" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"/><br>
		</fieldset>
    </form>
   </div>
 </div>  
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>