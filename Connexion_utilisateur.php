<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
        <div style="position:absolute;top:110px;left:15px;">
           <?php
            
            //on se connecte à la base
            include'connexionBDD.php';
        
        
            // Check connection
            if ($bdd->connect_error) {
                die("Connection failed: " . $bdd->connect_error);
            } 
            echo "Connected successfully (".$bdd->host_info.")";
            $pseudonyme = $_POST['pseudo'];
            $mdpSaisie = $_POST['mdp'];
            
           
            
            $req1 = $bdd->prepare('SELECT Mot_de_passe FROM utilisateurs 
                                  WHERE Pseudonyme = :pseudo');
            $req1->execute(array(
                'pseudo' => $pseudonyme));
            
            $resultat = $req1->fetch();
            
            $mdpDeBDD = $resultat['Mot_de_passe'];
            
            //si le pseudo existe déjà en BDD
            if(!$resultat)
            {
               echo "L'utilisateur n'existe pas"; 
            }
            else
            {
                $verify = password_verify("boubou", $mdpDeBDD);
                
                var_dump($verify);
                //on verifie si le mot de passe est bon
                if(password_verify($mdpSaisie, $mdpDeBDD))
                {
                    session_start();
                    
                    //Le code qui suit est très étrange ^^
                    
                    $_SESSION['Pseudonyme'] = $pseudonyme;
                    $pseudo = $_SESSION['Pseudonyme'];
                    echo "<p> Vous êtes connecté en tant que $pseudo !<p></div>";
                }
                else
                {
                    echo "Mauvais mot de passe";
                }
            }
      
              ?>
        </div>

    <div class="bandeau">
      <form id="recherche_nom_form" method="post" action="Resultat_recherche.php">
        <input type="text" name="recherche_nom" placeholder="Rechercher par nom"/>
      </form>
		  <a href="Accueil.php"><img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
		  <a href="Proposition_jeu.php" id="bouton_proposition">Propose ton jeu</a>
		  
		<?php
		/*
		pour savoir si une session est déjà ouverte : pour les versions des PHP supérieur à 5.4.0 (sur CLOU9 on est à 5.5.9), a vérifier sur nos machines.
		sur les versions antérieur : 
                                		if(session_id() == '') {
                                      session_start();
                                    }
		*/
		  if(session_status() == PHP_SESSION_NONE)
		  {
		    ?>
        <a href="Connexion_utilisateur.html" id="bouton_proposition">Se connecter</a>
        <?php
      }
		  else
		  {
		    $pseudo = $_SESSION['Pseudonyme'];
		    ?>
		    <a href="Profil_utilisateur.php" id="bouton_connectu"> <?php echo $pseudo; ?> connecté !</a>
		    <?php
		  }
    ?>
    </div>
       
  
  <div class="boutons_navigation">
	<a href="Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
       <div class ="nouveau_membre">
       </div>

    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
    </body>
</html>