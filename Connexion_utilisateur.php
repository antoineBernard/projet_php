<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>

           <?php
            
            //on se connecte à la base
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "ProjetWeb";
            $dbport = 3306;
        
            // Create connection
            $bdd = new mysqli($servername, $username, $password, $database, $dbport);
        
        
            // Check connection
            if ($bdd->connect_error) {
                die("Connection failed: " . $bdd->connect_error);
            } 
            echo "Connected successfully (".$bdd->host_info.")";
            $pseudonyme = $_POST['pseudo'];
            $mot_de_passe = $_POST['mdp'];
            
           
            //on crypte le mot de passe
            $mot_de_passe = crypt($mdp);
            //on protége des injection js et html
            $pseudonyme = htmlspecialchars($pseudonyme);
            $reqVerif = $bdd->prepare('SELECT ID_utilisateur FROM utilisateurs WHERE Adresse_email = ? AND Mot_De_Passe = ?');
          
            $reqVerif->bind_param("ss",$email, $mot_de_passe);
            //j'execute la requete et la range dans resultat
            $resultat = $reqVerif->execute();
            
            //si le pseudo existe déjà en BDD
            if($resultat)
            {
                session_start();
                $_SESSION['ID_utilisateur'] = $resultat['ID_utilisateur'];
                $_SESSION['Pseudonyme'] = $pseudonyme;
                $pseudo = $_SESSION['Pseudonyme'];
                echo "<p> Vous êtes connecté en tant que $pseudo !<p></div>";
            }
            else
            {
                
        ?>
                  <div class="nouveau_membre" >
                      <p>l'utilisateur n'existe pas !</p>
                  </div>
              <?php
              
            }
      
              ?>

    <div class="bandeau">
      <form id="recherche_nom_form" method="post" action="Resultat_recherche.php">
        <input type="text" name="recherche_nom" placeholder="Rechercher par nom"/>
      </form>
		  <a href="Accueil.php"><img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
		  <a href="Proposition_jeu.html" id="bouton_proposition">Propose ton jeu</a>
		  
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

    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
    </body>
</html>