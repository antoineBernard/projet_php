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
	  	<a href="/Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
	  	<a href="Top10.php" class="bouton">Top 10</a>	
	  </div>
<?php
if($autorisation == 1)
{
?>
	<div class="notre_selection">
		Jeux : 
	</div>
	
	   
<?php
	if(isset($_POST['new_jeux_mois']))
	{
		
		$nomJeu = $_POST['new_jeux_mois'];
			
		$nom = $bdd->prepare('SELECT Nom FROM jeux 
                                  WHERE Nom = :Nom AND Nomine = 1');
        $nom->execute(array(
                'Nom' => $nomJeu));
            
        $resultat = $nom->fetch();
        
        if($resultat)
        {
        	echo "<div class='erreur_erase_admin'>";
			echo "Erreur : Le jeu ".$nomJeu." à déjà été nommé jeux de la semaine ou jeux du mois !";
			echo "</div>";	
        }
		else
		{
			$requetetAll = $bdd->query('UPDATE jeux SET Jeu_mois = 0');
			$requette = $bdd->prepare('UPDATE jeux SET Nomine = 1, Jeu_mois = 1 WHERE Nom=:Nom');
            
            $ligne=array('Nom'=>$nomJeu);

            $requette->execute($ligne);
            $requette->closeCursor();
			echo "<div class='ajout_admin'>";
			echo $nomJeu." est maintenant le jeu du mois !";
			echo "</div>";
		}
		
	}
	elseif(isset($_POST['new_jeux_semaine']))
	{
		$nomJeu = $_POST['new_jeux_semaine'];
			
		$nom = $bdd->prepare('SELECT Nom FROM jeux 
                                  WHERE Nom = :Nom AND Nomine = 1');
        $nom->execute(array(
                'Nom' => $nomJeu));
            
        $resultat = $nom->fetch();
        
        if($resultat)
        {
        	echo "<div class='erreur_erase_admin'>";
			echo "Erreur : Le jeu ".$nomJeu." à déjà été nommé jeux de la semaine ou jeux du mois !";
			echo "</div>";	
        }
		else
		{
			$requetetAll = $bdd->query('UPDATE jeux SET Jeu_semaine = 0');
			$requette = $bdd->prepare('UPDATE jeux SET Nomine = 1, Jeu_semaine = 1 WHERE Nom=:Nom');
	        
	        $ligne=array('Nom'=>$nomJeu);
	
	        $requette->execute($ligne);
	        $requette->closeCursor();
			echo "<div class='ajout_admin'>";
			echo $nomJeu." est maintenant le jeu de la semaine !";
			echo "</div>";
			}
	}
	
?>
	
   <div id="tableau_utilisateurs">
		<table id="tableau_user" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>Nom du jeu</th>
				<th>Nom du studio</th>
				<th>Note de la redaction</th>
				<th>Note total</th>
				<th>Nombre notes</th>
				<th>Déjà nominé dans le passé</th>
				<th>Jeu du mois actuel</th>
				<th>Jeu de la semaine actuel</th>

			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM jeux ORDER BY Note DESC');
				$jeuxMois = " ";
				$jeuxSemaine = " ";
				$nomine = " ";
				while($jeux = $req->fetch())
				{
					if($jeux['Jeu_mois'] == 1)
						$jeuxMois = "<b>OUI</b>";
					else
						$jeuxMois = " ";
						
					if($jeux['Jeu_semaine'] == 1)
						$jeuxSemaine = "<b>OUI</b>";
					else
						$jeuxSemaine = " ";
					if($jeux['Nomine'] == 1)
						$nomine = "<b>OUI</b>";
					else
						$nomine = " ";
					
					
					
					echo "<tr>";
						echo "<td>".$jeux['Nom']."</td>";
						echo "<td>".$jeux['Nom_studio']."</td>";
						echo "<td>".$jeux['Note_redaction']."</td>";
						echo "<td>".$jeux['Note']."</td>";
						echo "<td>".$jeux['Nombre_notes']."</td>";
						echo "<td>".$nomine."</td>";
						echo "<td>".$jeuxMois."</td>";
						echo "<td>".$jeuxSemaine."</td>";
						echo "<td>".$admin."</td>";
						echo "<td>";
						?>
						 <form method="post" action="nomination_backoffice.php">
							<button type="submit" name="new_jeux_mois" value="<?php echo $jeux['Nom']; ?>">Definir comme jeux du mois</button>
						 </form>
						<?php					
						echo "</td>";
						echo "<td>";
						?>
						
						 <form method="post" action="nomination_backoffice.php">
							<button type="submit" name="new_jeux_semaine" value="<?php echo $jeux['Nom']; ?>">Definir comme jeux de la semaine</button>
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