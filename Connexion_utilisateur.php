<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>

    <div class="bandeau">
      <form id="recherche_nom_form" method="post" action="Resultat_recherche.php">
        <input type="text" name="recherche_nom" placeholder="Rechercher par nom"/>
      </form>
		  <a href="Accueil.html"><img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
		  <a href="Proposition_jeu.html" id="bouton_proposition">Propose ton jeu</a>
		  <a href="Connexion_utilisateur.html" id="bouton_proposition">Se connecter</a>
    </div>
  
  <div class="boutons_navigation">
	<a href="Accueil.html" class="bouton actif" style="margin-right:10px;">Accueil</a>
	<a href="Top10.html" class="bouton">Top 10</a>	
  </div>
       <div class ="nouveau_membre">
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
echo "echo1";
            $reqVerif = $bdd->prepare('SELECT ID_utilisateur FROM utilisateurs WHERE Adresse_email = ? AND Mot_De_Passe = ?');
          
            $reqVerif->bind_param("ss",$email, $mot_de_passe);
            //j'execute la requete et la range dans resultat
            $resultat = $reqVerif->execute();
            

echo "echo2 : $resultat";
            //si le pseudo existe déjà en BDD
            if($resultat)
            {
              
              
                session_start();
                $_SESSION['ID_utilisateur'] = $resultat['ID_utilisateur'];
                $_SESSION['Pseudonyme'] = $pseudonyme;
                echo "<p> Vous êtes connecté en tant que $pseudonyme !<p></div>";

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
    
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
    </body>
</html>