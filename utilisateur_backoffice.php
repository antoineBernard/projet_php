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
	<div class="notre_selection">
		Utilisateurs :
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
		elseif(isset($_POST['erase_admin']))
		{
			$user = $_POST['erase_admin'];
			$effaceSoitMeme = false;
			
			if($user == $pseudo)
			{
				$effaceSoitMeme = true;
			}
			

			
			if($effaceSoitMeme)
			{
				echo "<div class='erreur_erase_admin'>";
				echo $user." vous ne pouvez pas vous retirer les droits administrateur !";
				echo "</div>";
			}
			else
			{
	            $requette = $bdd->prepare('UPDATE utilisateurs SET Admin = 0 WHERE Pseudonyme=:Pseudonyme');
            
	            $ligne=array('Pseudonyme'=>$user);
	            
	            // et bim on execute
	            $requette->execute($ligne);
	            $requette->closeCursor();
				echo "<div class='ajout_admin'>";
				echo $user." à perdu les droits Administrateur !";
				echo "</div>";
			}
		}
		elseif(isset($_POST['supp_user']))
		{
			$user = $_POST['supp_user'];
			$effaceSoitMeme = false;
			if($user == $pseudo)
			{
				$effaceSoitMeme = true;
			}
		
			
			if($effaceSoitMeme)
			{
				echo "<div class='erreur_erase_admin'>";
				echo $user." vous ne pouvez pas vous supprimer !";
				echo "</div>";
			}
			else
			{
	            $requette = $bdd->prepare('DELETE FROM utilisateurs WHERE Pseudonyme=:Pseudonyme');
            
	            $ligne=array('Pseudonyme'=>$user);
	            
	            // et bim on execute
	            $requette->execute($ligne);
	            $requette->closeCursor();
				echo "<div class='ajout_admin'>";
				echo $user." à été supprimé!";
				echo "</div>";
			}
			
		}
	
?>
	
   <div id="tableau_utilisateurs">
		<table id="tableau_user" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>Pseudonyme</th>
				<th>Email</th>
				<th>Date inscription</th>
				<th>Administrateur</th>

			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM utilisateurs ORDER BY Admin DESC');
				$admin = " ";
				while($utilisateur = $req->fetch())
				{
					$_SESSION['pseudo_nouveau_admin'] = $utilisateur['Pseudonyme']; 
					if($utilisateur['Admin']==1)
						$admin = "<b>OUI</b>";
					
					else
						$admin = " ";
						
					echo "<tr>";
						echo "<td>".$utilisateur['Pseudonyme']."</td>";
						echo "<td>".$utilisateur['Adresse_email']."</td>";
						echo "<td>".$utilisateur['Date_inscription']."</td>";
						echo "<td>".$admin."</td>";
						echo "<td>";
						?>
						 <form method="post" action="utilisateur_backoffice.php">
							<button type="submit" name="new_admin" value="<?php echo $utilisateur['Pseudonyme']; ?>">Ajouter droit administrateur</button>
						 </form>
						<?php					
						echo "</td>";
						echo "<td>";
						?>
						 <form method="post" action="utilisateur_backoffice.php">
							<button type="submit" name="erase_admin" value="<?php echo $utilisateur['Pseudonyme']; ?>">retirer droit administrateur</button>
						 </form>
						<?php					
						echo "</td>";
						echo "<td>";
						?>
						 <form method="post" action="utilisateur_backoffice.php">
							<button type="submit" name="supp_user" value="<?php echo $utilisateur['Pseudonyme']; ?>">supprimer l'utilisateur</button>
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