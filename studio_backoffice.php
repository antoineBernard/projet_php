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
	  	<a href="Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection" style="margin-bottom:0px;">
		Editeurs/studios :
	</div>
    <div class="clear"></div>	   
<?php
		if(!empty($_POST['ajout_editeur']))
		{
		?>
	    <div class="formulaire_ajoutES">
	      <form action="studio_backoffice.php" method="post" enctype="multipart/form-data">
			<fieldset><legend>Ajouter un éditeur</legend>
				<label for="editeur">Éditeur :</label><input type="text" name="editeur" maxlength="40" required /><br><br>
				<input type="submit" name="validerEditeur" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"><br>
			</fieldset>
	    </form>
	   </div>
   <?php
		}
		if(!empty($_POST['ajout_studio']))
		{
		?>
	    <div class="formulaire_ajoutES">
	      <form action="studio_backoffice.php" method="post" enctype="multipart/form-data">
			<fieldset><legend>Ajouter un studio</legend>
				<label for="editeur">Studio :</label><input type="text" name="studio" maxlength="40" required /><br><br>
				<label for="annee_creations">Année création :</label><input type="text" name="annee_creation" placeholder="année" style="width:20%;" maxlength="4"/><br><br>
				<input type="submit" name="validerStudio" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"><br>
			</fieldset>
	    </form>
	   </div>
   <?php
		}
		if(!empty($_POST['validerStudio']))
		{
			$nomStudio = $_POST['studio'];
			$annee = $_POST['annee_creation'];
			
			$reqStudio = $bdd->prepare('INSERT INTO studios (Nom_studio, Annee_creation) VALUES(:Nom_studio, :Annee_creation)');
			$ligne=array(
						 'Nom_studio'=>$nomStudio,
						 'Annee_creation'=>$annee
						 );
							 
			$reqStudio->execute($ligne);	
			$reqStudio->closeCursor();
		}
		
		if(!empty($_POST['validerEditeur']))
		{
			$nomEditeur = $_POST['editeur'];

			$reqStudio = $bdd->prepare('INSERT INTO editeurs (Editeur) VALUES(:Editeur)');
			$ligne=array(
						 'Editeur'=>$nomEditeur
						 );
							 
			$reqStudio->execute($ligne);	
			$reqStudio->closeCursor();
		}
?>
	
   <div class="tableau_ES" style="margin-bottom:0px;">
		<table>
		<thead>
			<tr>
				<th>Nom studio</th>
			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM studios ORDER BY Nom_studio');

				while($studio = $req->fetch())
				{
					echo "<tr>";
						echo "<td>".$studio['Nom_studio']."</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
   </div>
   <form method="post" action="studio_backoffice.php" class="ajoutSE">
		<input type="submit" class="bouton" style="width:100%" name="ajout_studio" value="Ajouter un studio"/>
   </form>
   
   
      <div class="tableau_ES">
		<table>
		<thead>
			<tr>
				<th>Editeur</th>
			</tr>
		</thead>
			<tbody>
				<?php
				$req2 = $bdd->query('SELECT * FROM editeurs ORDER BY Editeur');

				while($editeur = $req2->fetch())
				{
					echo "<tr>";
						echo "<td>".$editeur['Editeur']."</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
   </div>
   <form method="post" action="studio_backoffice.php" class="ajoutSE">
		<input type="submit" class="bouton" style="width:100%" name="ajout_editeur" value="Ajouter un éditeur"/>
   </form>

 </div>  
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>

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
</body>
</html>