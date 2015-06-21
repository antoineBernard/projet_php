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
			$annee=(int)$_POST['annee_sortie'];	
			$annee=$_POST['annee_sortie'];	;
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
			
			if($annee<1960 || $annee>2020)
			{
		       echo "Entrez une année valide !";
			}
			else
			{
				if(!$nouv_jeu=fopen($nom_jeu,"r"))
				{
					$url="tests_jeux/".$nom_jeu.".php";
					$nouv_jeu=fopen($url,"w");
					$page=("<!DOCTYPE html>
<html>
<head>
	<title>Nom du jeu</title>
    <meta charset=\nUTF-8\n/>
	<link rel=\nstylesheet\n type=\ntext/css\n href=\nprojet_Web.css\n>
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
  <body>
  <div class=\ncontenu\n>
    <div class=\nbandeau\n>
      <form id=\nrecherche_nom_form\n method=\npost\n action=\nResultat_recherche.html\n>
        <input type=\ntext\n name=\nrecherche_nom\n placeholder=\nRechercher par nom\n/>
      </form>
	  <img src=\nImages/logo_projet_web_blanc.png\n style=\nposition:absolute;height:80%;top:10%;left:47.5%;\n/>
	  <a href=\nProposition_jeu.html\n id=\nbouton_proposition\n>Propose ton jeu</a>
    </div>

  <div class=\nboutons_navigation\n>
	<a href=\nAccueil.html\n class=\nbouton\n style=\nmargin-right:10px;\n>Accueil</a>
	<a href=\nTop10.html\n class=\nbouton\n>Top 10</a>	
  </div>

	<div class=\nfiche_jeu\n> 
	  <div class=\npresentation_jeu\n>
        <p>".$description."</p>
      </div>



      <div class=\nnote_jeu\n>
		17/20
      </div>


      <div class=\ntest_jeu\n>
        <p>".$test."</p> 
      </div>
    </div>  

      <div class=\ncommentaires_jeu\n>
        <p>Commentaires d'utilisateurs</p>
      </div>
      
    <div class=\nfooter\n>
	  <a href=\nFormulaire_contact.html\n>Contact</a> / Réseaux sociaux
    </div>
  </div>
  </body>
</html>");
				fprintf($nouv_jeu,"%s",$page);
				fclose($nouv_jeu);
				
				$servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "ProjetWeb";
        $dbport = 3306;
				
        $bdd = new mysqli($servername, $username, $password, $database, $dbport);
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
            }
        else{
        	  $url=$servername.'/'.$url;
          	//$req = $bdd->prepare('INSERT INTO jeux (Nom, Sortie, Nom_Studio, Genre, Univers,URL) VALUES($nom_jeu,$annee, $studio, $genre, $univers,$url)');        	
          
          	
            $req = $bdd->prepare('INSERT INTO jeux (Nom, Sortie, Nom_Studio, Genre, Univers, URL) VALUES(?, ?, ?, ?, ?, ?)');        	
        	  $req->bind_param("ssssss",$nom_jeu, $annee->format('Y'),$studio, $genre, $univers, $url);
        	  $req->execute();
        }
        
        
				echo "Page crée !";
				}
				else
				{
					echo "Ce jeu existe déjà !";
				}
			}
	
	
	?>

</body>
</html>