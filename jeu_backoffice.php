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
	if(!empty($_POST['valider']))
	{
	?>
		<?php
			$nom_jeu=$_POST['nom_jeu'];
			$studio=$_POST['studio'];
			$editeur=$_POST['editeur'];
			$genre=$_POST['genre'];
			$univers=$_POST['univers'];
			$date_sortie=$_POST['date_sortie'];
			$note=$_POST['note'];
		    $description=$_POST['description'];
			$test=$_POST['test'];

			$nom_jeu=trim($nom_jeu);
			$nom_jeu=preg_replace('/\s{2,}/',' ',$nom_jeu);
			$studio=trim($studio);
			$studio=preg_replace('/\s{2,}/',' ',$studio);	
			$editeur=trim($editeur);
			$editeur=preg_replace('/\s{2,}/',' ',$editeur);
			$description=trim($description);
			$description=preg_replace('/\s{2,}/',' ',$description);
			$test=trim($test);
			$test=preg_replace('/\s{2,}/',' ',$test);
			
			$annee=substr($date_sortie,-4);
			$annee=(int)$annee;
			$mois=substr($date_sortie,3,2);
			$mois=(int)$mois;
			$jour=substr($date_sortie,0,2);
			$jour=(int)$jour;
			
			$ecrire=true;
			
			if($annee<1960 || $annee>2020)
			{
			?>
		       Entrez une année valide !
			<?php
			   $ecrire=false;
				
			}
			if($mois<1 || $mois>12)
			{
			?>
				Entre un mois valide !
			<?php
			    $ecrire=false;
			}
			if($jour<1 || $jour>31 || ($jour>30 && ($mois==2 || $mois==4 || $mois==6 || $mois==9 || $mois==11)) || ($jour>28 && $mois==2 && $annee%4!=0))
			{
			?>
				Entrez un jour valide !
			<?php
			    $ecrire=false;
			}
			if($ecrire)
			{

            $telechargementReussi=false;
			
			$destination="Images/".$_FILES['image']['name'];
			
			$telechargement=move_uploaded_file($_FILES['image']['tmp_name'],$destination);
			
			  if($telechargement)
			  {
			    $telechargementReussi=true;
			  }
			  else
			  {
			    echo "<div class='erreur_erase_admin'>";
				echo "Echec du téléchargement !";
				echo "</div>";
			  }
			
			  $editeurExiste=false;
			  
			  $reqVerif=$bdd->prepare('SELECT Editeur FROM editeurs');
			  $reqVerif->execute();
			  
			  while(($editeurBase = $reqVerif->fetch()) && $editeurExiste==false)
			  {
			  	if($editeurBase['Editeur']==$editeur)
			  	{
			  	  $editeurExiste=true;
			  	}
			  }
			  
			  if(!$editeurExiste){
			  	echo "L'éditeur entré n'existe pas !<br>";
			  }
			  
			  $reqVerif -> closeCursor();
			  
			  
			  $studioExiste=false;
			  
			  $reqVerif=$bdd->prepare('SELECT Nom_studio FROM studios');			  
			  $reqVerif->execute();
			  
			  while(($studioBase = $reqVerif->fetch()) && $studioExiste==false)
			  {
			  	if($studioBase['Nom_studio']==$studio)
			  	{
			  	  $studioExiste=true;
			  	}
			  }
			  $reqVerif -> closeCursor();			  
			  
			  if(!$studioExiste){
			  	echo "Le studio entré n'éxiste pas !<br>";
			  }
			  
			  if($editeurExiste && $studioExiste && $telechargementReussi)
			  {

 			    $req = $bdd->prepare('INSERT INTO jeux (Nom, Sortie, Nom_studio, Editeur, Genre, Univers, Note_redaction, Note, Description, Test,Nombre_notes,Jaquette) VALUES(:Nom, :Sortie, :Nom_studio, :Editeur, :Genre, :Univers, :Note_redaction, :Note, :Description, :Test, :Nombre_notes,:Jaquette)');

			    $ligne_jeu=array(
			  				     'Nom'=>$nom_jeu,
			  				     'Sortie'=>$date_sortie,
							     'Nom_studio'=>$studio,
							     'Editeur'=>$editeur,
							     'Genre'=>$genre,
							     'Univers'=>$univers,
							     'Note_redaction'=>$note,
							     'Note'=> $note,
							     'Description' =>$description,
							     'Test'=>$test,
							     'Nombre_notes'=>1,
							     'Jaquette'=>$destination
							     );
							 
			    $req->execute($ligne_jeu);	

			    $req->closeCursor();
			
			    echo "<div class='ajout_admin'>";
			    echo "Jeu créé !";
			    echo "</div>";
			  }
			}
	?>
	<?php
	}
	?>
	
	
	
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
     <div id="formulaire_jeu_backoffice">
      <form action="jeu_backoffice.php" method="post" id="ajout_jeu" enctype="multipart/form-data">
		<fieldset><legend>Ajouter un jeu</legend>
			<label for="nom_jeu">Nom du jeu :</label><input type="text" name="nom_jeu" maxlength="50" required /><br><br>
			<label for="studio">Studio :</label><input type="text" name="studio" maxlength="40" required /><br><br>
			<label for="editeur">Éditeur :</label><input type="text" name="editeur" maxlength="40" required /><br><br>
			<label for="genre">Genre :</label><select name="genre">
												<option value="Action">Action</option>
												<option value="Aventure">Aventure</option>
												<option value="FPS">FPS</option>
												<option value="Jeu de rôles">Jeu de rôles</option>
												<option value="Plates-formes">Plates-formes</option>
												<option value="Réflexion">Réflexion</option>		
												<option value="Simulation">Simulation</option>
												<option value="Stratégie">Stratégie</option>
												<option value="Survival">Survival</option>						
											  </select><br><br>	
			<label for="univers">Univers :</label><select name="univers">
													<option value="Contemporain">Contemporain</option>
													<option value="Fantastique">Fantastique</option>
													<option value="Historique">Historique</option>
													<option value="Horreur">Horreur</option>
													<option value="Science-fiction">Science-fiction</option>
													<option value="Steampunk">Steampunk</option>
												  </select><br><br>			
			<label for="date_sortie">Date de sortie :</label><input type="text" name="date_sortie" maxlength="10" placeholder="jj/mm/aaaa" required /><br><br>
			<label for="note">Note :</label><select name="note"><option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																</select><br><br>
			<label for="description">Description :</label><textarea name="description" placeholder="Description du jeu"required ></textarea><br><br>
			<label for="test">Test :</label><textarea name="test" placeholder="Test du jeu"required ></textarea><br><br>
			<label for="image">Jaquette :</label><input type="file" name="image" required/><br><br>
			
			<input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"><br>
		</fieldset>
    </form>
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
 </div>
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>
</body>
</html>