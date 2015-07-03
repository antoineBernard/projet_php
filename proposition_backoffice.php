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
	  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection">
		Proposition de jeux :
	</div>
	
	   
<?php

		if(isset($_POST['new_admin']))
		{
			$user = $_POST['new_admin'];
			
            $requette = $bdd->prepare('UPDATE utilisateurs SET Admin = 1 WHERE Pseudonyme=:Pseudonyme');
            
            $ligne=array('Pseudonyme'=>$user);
            
            // et bim on execute
            $requette->execute($ligne);
            $requette->closeCursor();
			
			echo "<div class='ajout_admin'>";
			echo $user." à été rajouté comme Administrateur !";
			echo "</div>";
		}
		
	
?>
	
   <div id="tableau_utilisateurs">
		<table id="tableau_user" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>ID</th>
				<th>Contributeur</th>
				<th>Nom du jeu</th>
				<th>Studio</th>
				<th>Genre</th>
				<th>Email du contributeur</th>
				<th>Message</th>
			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM proposition_jeux ORDER BY Date_proposition DESC');

				while($proposition = $req->fetch())
				{
					echo "<tr>";
						echo "<td>".$proposition['ID_proposition']."</td>";
						echo "<td>".$proposition['Nom_contributeur']."</td>";
						echo "<td>".$proposition['Jeu']."</td>";
						echo "<td>".$proposition['Studio']."</td>";
						echo "<td>".$proposition['Genre']."</td>";
						echo "<td>".$proposition['Adresse_email']."</td>";
						echo "<td>".$proposition['Message_contributeur']."</td>";

					echo "</tr>";
				}
				?>
			</tbody>
		
		</table>
   </div>

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