<!DOCTYPE html>
<html>
<head>
	<title>Création jeu</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
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
			$genre=trim($genre);
			$genre=preg_replace('/\s{2,}/',' ',$genre);
			$genre=preg_replace('/\s{1,}-/','-',$genre);	
			$univers=trim($univers);
			$univers=preg_replace('/\s{2,}/',' ',$univers);
			$univers=preg_replace('/\s{1,}-/','-',$univers);
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
		       echo "Entrez une année valide !";
			}
			if($mois<1 || $mois>12)
			{
				echo "Entre un mois valide !";
			}
			if($jour<1 || $jour>31 || ($jour>30 && ($mois==2 || $mois==4 || $mois==6 || $mois==9 || $mois==11)) || ($jour>28 && $mois==2 && $annee%4!=0))
			{
				echo "Entrez un jour valide !";
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
				$bdd=new PDO("mysql:host=$servername;dbname=$database",$username,$password);					
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

</body>
</html>