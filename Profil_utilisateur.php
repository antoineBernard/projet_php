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
	<title>Profil</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="contenu">  
		<?php
			include 'bandeau.php';
        ?>
  
  <div class="boutons_navigation">
	<a href="Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
	
	
	<div class="avatar_actions_utilisateur">
	
	<?php
	if(!empty($_POST['valider']))
	{
		$destination="Images/".$_FILES['image']['name'];
			
		$telechargement=move_uploaded_file($_FILES['image']['tmp_name'],$destination);
		
		$req = $bdd->prepare('UPDATE utilisateurs SET url_avatar =:url_avatar WHERE Pseudonyme= \''.$pseudo.'\'');
	
		$ligne_jeu=array(
						 'url_avatar'=>$destination
						 );
						 
		$req->execute($ligne_jeu);	
	
		$req->closeCursor();
	}

		$reponse = $bdd->query('SELECT * FROM utilisateurs WHERE Pseudonyme=  \''.$pseudo.'\' ');

		$user = $reponse->fetch();
	

	?>
		<img src="<?php echo $user['url_avatar']; ?>" style="position:relative;clear:both;margin-top:15px;margin-left:20px;margin-right:auto;margin-right:auto;max-width:140px;min-height:140px;"/>

		<form action="Profil_utilisateur.php" method="post" id="changementAvatar" enctype="multipart/form-data">
			<input type="file" name="image" required/><br><br>
			<input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><br>
		</form>
		
		
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
			$nbCom = 0;
			$reponse = $bdd->query('SELECT Adresse_email FROM utilisateurs WHERE Pseudonyme= \''.$pseudo.'\' ');
			
			while ($donnees = $reponse->fetch())
			{
			   $email = $donnees['Adresse_email'];
			}
			
			$reponse->closeCursor();
			echo "<p><b>Nom d'utilsateur :</b> $pseudo <br/><br/>";
			echo "<b>Adresse de messagerie :</b> $email <br/><br/>";
			
			
			$req = $bdd->query('SELECT Note FROM commentaire WHERE Pseudo_utilisateur= \''.$pseudo.'\' ');
			while ($donnees = $req->fetch())
			{
			   $nbCom++;
			}
			
			echo "<b>Nombre de commentaires : </b> $nbCom <br/></br>";
			
			?>
			<table id="tableau_profil">
		<thead>
			<tr>
				<th>Jeux</th>
				<th>Notes attribuées</th>
			</tr>
		</thead>
			<tbody>
				<?php
				$req2 = $bdd->query('SELECT * FROM commentaire WHERE Pseudo_utilisateur= \''.$pseudo.'\' ORDER BY ID_commentaire DESC');
				while($commentaire = $req2->fetch())
				{
					$req3 = $bdd->prepare('SELECT * FROM jeux WHERE ID_jeu = :ID_jeu');
					$ligne=array('ID_jeu'=>$commentaire['ID_jeu']);
					$req3->execute($ligne);
					$nomJeu = " ";
					while($jeux = $req3->fetch())
					{
						$nomJeu = $jeux['Nom'];
					}
					
					
					echo "<tr>";
						echo "<td>".$nomJeu."</td>";
						echo "<td>".$commentaire['Note']."</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		</p>
	
	</div>
	
    
	<div class="clear"></div>
 </div>
    <div class="footer">
	    <a href="Formulaire_contact.php">Contact</a>
    </div> 
</body>
</html>