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
		
		<?php
		//j'ai fais un include pour alléger les répétitions de code
			include 'bandeau.php';
	    ?>
	  <div class="boutons_navigation">
	  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection">
		Commentaires :
	</div>
	
	
   <div id="tableau_utilisateurs">
		<table id="tableau_commentaires" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>ID_commentaire</th>
				<th>Pseudo_utilisateur</th>
				<th>ID_jeu</th>
				<th>Commentaire</th>

			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM commentaire');
				$jeu = " ";
				
				while($commentaire = $req->fetch())
				{
					$req2 = $bdd->prepare('SELECT Nom FROM jeux WHERE ID_jeu= ?');
					$req2->execute(array($commentaire['ID_jeu']));
					
					while($donnees = $req2->fetch())
					{
						$jeu = $donnees['Nom'];
					}
					
				//	while ($donnees = $req2->fetch()){$jeu = $donnees['Nom'];}
						
					echo "<tr>";
						echo "<td>".$commentaire['ID_commentaire']."</td>";
						echo "<td>".$commentaire['Pseudo_utilisateur']."</td>";
						echo "<td>".$jeu."</td>";
						echo "<td>".$commentaire['Commentaire']."</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		
		</table>
   </div>

   
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
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