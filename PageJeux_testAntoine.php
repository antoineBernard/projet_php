<?php
	session_start ();//indispensable pour garder la connexion
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
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
  	<a href="/Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
   	<?php
		
  	$servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "ProjetWeb";
    $dbport = 3306;

    // Create connection
    $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
    
    //$id_jeu = $_SESSION['ID_jeu'];
    
    if(!$id_jeu = $_POST['jeu_choisi'])
    {

      $id_jeu=$_POST['retour_commentaire'];
      
      $req_comm = $bdd->prepare('INSERT INTO commentaire (ID_jeu,Pseudo_utilisateur,Commentaire,Note) VALUES (:ID_jeu,:Pseudo_utilisateur,:Commentaire,:Note)');
      
      $ligne_comm=array(
                        //'Date_commentaire'=>getdate(),
                        'ID_jeu'=>$id_jeu,
                        'Pseudo_utilisateur'=>$_SESSION['Pseudonyme'],
                        'Commentaire'=>$_POST['commentaire'],
                        'Note'=>$_POST['note']
                       );
      $req_comm->execute($ligne_comm);
      $req_comm->closeCursor();
      
      $req_note=$bdd->query("SELECT Note_redaction,Nombre_notes FROM jeux WHERE ID_jeu=$id_jeu");
      
      $jeu=$req_note->fetch();
      
      $req_note->closeCursor();
      
      $req_moyenne=$bdd->query("SELECT Note FROM commentaire WHERE ID_jeu=$id_jeu");
      
      $sommeNotes=$jeu['Note_redaction'];
      
      while($noteCommentaire = $req_moyenne->fetch())
      {
        $sommeNotes=$sommeNotes+$noteCommentaire['Note'];
      }
      
      $req_moyenne->closeCursor();
      
      $nouvNbNote=$jeu['Nombre_notes']+1;

      $nouvNote=round($sommeNotes/$nouvNbNote,1);
      
      $req_note=$bdd->prepare("UPDATE jeux SET Note=$nouvNote,Nombre_notes=$nouvNbNote WHERE ID_jeu=$id_jeu");
      $req_note->execute();
      $req_note->closeCursor();
    }

			$reponse = $bdd->query("SELECT * FROM jeux WHERE ID_jeu= $id_jeu");

			$jeu = $reponse->fetch();
			
			   echo "<p> bienvenue sur la page du jeu : <b>".$jeu['Nom']."</b></br>";
			   echo "l'id du jeu en variable de session : $id_jeu";
			
    ?>

  
	<div class="fiche_jeu"> 
	  <div class="presentation_jeu">
	    <?php
        echo $jeu['Description'];
      ?>
      </div>



      <div class="note_jeu">
  		 <?php
  		   echo $jeu['Note']."/20";
  		 ?>
      </div>


      <div class="test_jeu">
         <?php
           echo $jeu['Test'];
         ?>
      </div>
      
    	<?php
    	  if($_SESSION['Pseudonyme'])
    	  {
    	    include 'connexionBDD.php';

    	    $utilisateur=$_SESSION['Pseudonyme'];

    	    
    	    $req_comm=$bdd->prepare('SELECT * FROM commentaire WHERE ID_jeu=:ID_jeu AND Pseudo_utilisateur=:Pseudo_utilisateur');
          
          $var_req=array(
                         'ID_jeu'=>$id_jeu,
                         'Pseudo_utilisateur'=>$utilisateur
                        );
          
          $req_comm->execute($var_req);
    	    
    	    if(!$bidon=$req_comm->fetch())
    	    {
    	     ?>
    	     <form method="post" action="ajout_commentaire.php">
    	        <input type="hidden" name="jeu_commentaire" value="<?php echo $jeu['ID_jeu']; ?>"/>
    	        <input type="submit" class="bouton commentaire" name="ajouterComm" value="Ajoute un commentaire !"/>
    	     </form>
    	     <div class="clear"></div>
    	    <?php
    	    }
    	    $req_comm->closeCursor();
    	  }
      ?>
      <div class="commentaires_jeu">
        <?php
        include 'connexionBDD.php';
        
        $req_extraction_comm=$bdd->query("SELECT * FROM commentaire WHERE ID_jeu=$id_jeu");
        
        
        while($commentaires[]=$req_extraction_comm->fetch())
        {
        }
        
        $curseur=0;
        $i=0;
        ?>
        <table class="commentaires_page_jeu">
          <tr>
          <?php 
          while($i<count($commentaires) && $i<($curseur+2))
          {
            $comm=$commentaires[$i];
            $i++;
            ?>
            <td><p><?php echo $comm['Commentaire']."<br><i>".$comm['Pseudo_utilisateur']."</i>"; ?></p></td>  
          <?php
          }
          $curseur+=2;
          ?>
          </tr>
          <tr>
          <?php
          while($i<count($commentaires) && $i<($curseur+2))
          {
            $comm=$commentaires[$i];
            $i++;
            ?>
            <td><p><?php echo $comm['Commentaire']."<br><i>".$comm['Pseudo_utilisateur']."</i>"; ?></p></td>  
          <?php
          }
          $curseur+=2;
          ?>
          </tr>
        </table>
      </div>
      
  </div>
  <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
  </div>
</body>
</html>