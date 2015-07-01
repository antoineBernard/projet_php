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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
      
	    
	        <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
	    

	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
	
	<script>
	
	//le Jquery pour dynamiser le tableau avec Datatable
		//Quand le document est prêt
	    $(document).ready(function(){
  		 	 $('#tableau_user').DataTable();
		} );

	</script>

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
		Utilisateurs :
	</div>
	
   <div id="tableau_utilisateurs">
		<table id="tableau_user" class="tableau_utilisateurs">
		<thead>
			<tr>
				<th>Pseudonyme</th>
				<th>Email</th>
				<th>Date_inscription</th>
				<th>Administrateur</th>
				<th>Action</th>
			</tr>
		</thead>
			<tbody>
				<?php
				$req = $bdd->query('SELECT * FROM utilisateurs');
				$admin = " ";
				while($utilisateur = $req->fetch())
				{
					$_SESSION['pseudo_nouveau_admin'] = $utilisateur['Pseudonyme']; 
					if($utilisateur['Admin']==1)
						$admin = "OUI";
					
					else
						$admin = " ";
						
					echo "<tr>";
						echo "<td>".$utilisateur['Pseudonyme']."</td>";
						echo "<td>".$utilisateur['Adresse_email']."</td>";
						echo "<td>".$utilisateur['Date_inscription']."</td>";
						echo "<td>".$admin."</td>";
						echo "<td>";
						?>
						 <form method="post "action="">
							<button type="submit" value="<?php echo $utilisateur['Pseudonyme']; ?>">Nouvel administrateur</button>
						 </form>
						<?php					
						echo "</td>";
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