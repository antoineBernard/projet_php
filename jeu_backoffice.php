<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un jeu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
		<div style="position:absolute;z-index:1;color:white;">
		<?php
			$nom_jeu=$_POST['nom_jeu'];
			$studio=$_POST['studio'];
			$editeur=$_POST['editeur'];
			$genre=$_POST['genre'];
			$univers=$_POST['univers'];
			$date_sortie=$_POST['date_sortie'];	
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
			
			if($annee<1960 || $annee>2020)
			{
			?>
		       Entrez une année valide !
			<?php
				
			}
			if($mois<1 || $mois>12)
			{
			?>
				Entre un mois valide !
			<?php
			}
			if($jour<1 || $jour>31 || ($jour>30 && ($mois==2 || $mois==4 || $mois==6 || $mois==9 || $mois==11)) || ($jour>28 && $mois==2 && $annee%4!=0))
			{
			?>
				Entrez un jour valide !
			<?php
			}
			if(!$nouv_jeu=fopen("tests_jeux/".$nom_jeu.".php","r"))
			{
				$url="tests_jeux/".$nom_jeu.".php";
				$nouv_jeu=fopen($url,"w");
				$page=("<!DOCTYPE html>
<html>
<head>
	<title>Nom du jeu</title>
    <meta charset=\"UTF-8\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../projet_Web.css\">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
  <body>
  <div class=\"contenu\">
    <?php
	  //j'ai fais un include pour alléger les répétitions de code
		include '../bandeau.php';
    ?>
   <div class=\"boutons_navigation\">
  	 <a href=\"/Accueil.php\" class=\"bouton actif\" style=\"margin-right:10px;\">Accueil</a>
  	 <a href=\"Top10.php\" class=\"bouton\">Top 10</a>	
   </div>

	<div class=\"fiche_jeu\"> 
	  <div class=\"presentation_jeu\">
        <p>".$description."</p>
      </div>



      <div class=\"note_jeu\">
		17/20
      </div>


      <div class=\"test_jeu\">
        <p>".$test."</p> 
      </div>
    </div>  

      <div class=\"commentaires_jeu\">
        <p>Commentaires d'utilisateurs</p>
      </div>
      
    <div class=\"footer\">
	  <a href=\"../Formulaire_contact.html\">Contact</a> / Réseaux sociaux
    </div>
  </div>
  </body>
</html>");
			fprintf($nouv_jeu,"%s",$page);
			fclose($nouv_jeu);
			try{
				$servername = getenv('IP');
				$username = getenv('C9_USER');
    		    $password = "";
				$database = "ProjetWeb";
				$bdd=new PDO("mysql:host=$servername;dbname=$database;charset=utf8",$username,$password);					
			}
			catch(Exception $e){
				echo "Erreur de connexion avec la base : projetweb\n";
				echo 'Message : '.$e->getMessage()."\n";
			}			
			$req = $bdd->prepare('INSERT INTO jeux (Nom, Sortie, Nom_studio, Genre, Univers, URL) VALUES(:Nom, :Sortie, :Nom_studio, :Genre, :Univers, :URL)');

			$ligne_jeu=array(
							 'Nom'=>$nom_jeu,
							 'Sortie'=>$date_sortie,
							 'Nom_studio'=>$studio,
							 'Genre'=>$genre,
							 'Univers'=>$univers,
							 'URL'=>'localhost/ProjetWeb/'.$url
							 );
							 
			echo $genre."   ".$univers."\n";
			
			$req->execute($ligne_jeu);	

			/*
			$req->bindParam(':Nom',$nom_jeu);
			$req->bindParam(':Sortie',$date_sortie);
			$req->bindParam(':Nom_studio',$studio);
			$req->bindParam(':Genre',$genre);
			$req->bindParam(':Univers',$univers);
			$req->bindParam(':URL',$url);
			  
			$req->execute();
			*/
			$req->closecursor();
			
			echo "Page crée !";
			}
			else
			{
				echo "Ce jeu existe déjà !";
			}
	?>
	</div>
	
	
	<?php
	//j'ai fais un include pour alléger les répétitions de code
		include 'bandeau.php';
    ?>
  <div class="boutons_navigation">
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
  
   <div id="formulaire_jeu_backoffice">
    <form action="jeu_backoffice.php" method="post" id="ajout_jeu">
		<fieldset><legend>Ajouter un jeu</legend>
			<label for="nom_jeu">Nom du jeu :</label><input type="text" name="nom_jeu" maxlength="50" required /><br><br>
			<label for="studio">Studio :</label><input type="text" name="studio" maxlength="40" required /><br><br>
			<label for="editeur">Éditeur :</label><input type="text" name="editeur" maxlength="40" required /><br><br>
			<label for="genre">Genre :</label><select name="genre">
												<option value="Action">Action</option>
												<option value="Aventure">Aventure</option>
												<option value="FPS">FPS</option>
												<option value="Jeu de rôles">Jeu de rôles</option>
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
			<label for="date_sortie">Année de sortie :</label><input type="text" name="date_sortie" maxlength="10" placeholder="jj/mm/yyyy" required /><br><br>
			<label for="description">Description :</label><textarea name="description" placeholder="Description du jeu"required ></textarea><br><br>
			<label for="test">Test :</label><textarea name="test" placeholder="Test du jeu"required ></textarea><br><br>
			
			<input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><input type="reset" name="annuler" value="Vider le formulaire"><br>
		</fieldset>
    </form>
   </div>
   
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
</body>
</html>