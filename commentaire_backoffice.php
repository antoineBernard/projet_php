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
	  	<a href="Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection">
		Commentaires :
	</div>
<?php

		if(isset($_POST['supp_commentaire']))
		{
			$IDcommentaire = $_POST['supp_commentaire'];
			
            $requette = $bdd->prepare('DELETE FROM commentaire WHERE ID_commentaire= :IDcommentaire');
            
            $ligne=array('IDcommentaire'=>$IDcommentaire);
            
            // et bim on execute
            $requette->execute($ligne);
            $requette->closeCursor();
			
			echo "<div class='ajout_admin'>";
			echo "Commentaire à été supprimé !";
			echo "</div>";
		}
?>
	
   <div id="tableau_utilisateurs">
		<table id="tableau_commentaires" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>Jeu</th>
				<th>Utilisateur</th>
				<th>Commentaire</th>

			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM commentaire ORDER BY ID_jeu, Pseudo_utilisateur');
				$jeu = " ";
				
				while($commentaire = $req->fetch())
				{
					$req2 = $bdd->prepare('SELECT Nom FROM jeux WHERE ID_jeu= ?');
					$req2->execute(array($commentaire['ID_jeu']));
					
					while($donnees = $req2->fetch())
					{
						$jeu = $donnees['Nom'];
					}
						
					echo "<tr>";
						echo "<td>".$jeu."</td>";
						echo "<td>".$commentaire['Pseudo_utilisateur']."</td>";
						echo "<td>".$commentaire['Commentaire']."</td>";
						echo "<td>";
						?>
						 <form method="post" action="commentaire_backoffice.php">
							<button type="submit" name="supp_commentaire" value="<?php echo $commentaire['ID_commentaire']; ?>">Supprimer</button>
						 </form>
						<?php					
						echo "</td>";
						
						
					echo "</tr>";
				}
				?>
			</tbody>
		
		</table>
   </div>
</div>
   
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
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