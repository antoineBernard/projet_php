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
  	<a href="/Accueil.php" class="bouton actif" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
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
            //echo "Connected successfully (".$bdd->host_info.")";
            $pseudonyme = $_POST['pseudo'];
            $mot_de_passe = $_POST['mdp'];
            $confirm_mdp = $_POST['confirm_mdp'];
            $email = $_POST['email'];
            
            if($mot_de_passe == $confirm_mdp)
            {
        
                //on crypte le mot de passe
                $mot_de_passe_crypt = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                
                //-----------------------on verifie si l'utilisateur n'existe pas déjà
                //je prépare ma requête
                $reqVerif = $bdd->prepare('SELECT ID_utilisateur FROM utilisateurs WHERE Adresse_email = ?');
                //on met qu'un "s car il n'y a qu'un seul paramètre bindé de type String"
                $reqVerif->bind_param("s",$email);
                //j'execute la requete
                $reqVerif->execute();
                $resultat = $reqVerif->fetch();

                //si le pseudo existe déjà en BDD
                if($resultat)
                {
        ?>
                  <div class="nouveau_membre" >
                    <p>L'utilisateur déjà inscrit...</p>
                  </div>
        <?php
                }
                else
                {
                    //filter_var c'est une fonction pour vérifier la validité d'un mail
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                    //insertion dans la base
                echo "regarde ICI ===> $pseudonyme"."<br>";
                     $req = $bdd->prepare('INSERT INTO utilisateurs(Pseudonyme, Mot_de_passe, Adresse_email, Date_inscription) VALUES(?, ?, ?, CURDATE())');
                     //"sss", car 3 paramètre bindé de type String
                     $req->bind_param("sss", $pseudonyme, $mot_de_passe_crypt, $email);
                     $req->execute();
    
                     ?>$lmo
                     
                      <div class="nouveau_membre" >
                          <p>L'utilisateur à été ajouté !</p>
                      </div>
                  <?php
                    }
                    else
                    {
                  ?>
                        <div class="nouveau_membre" >
                          <p>Email non valide !</p>
                        </div> 
                  <?php
                    }
                }
            }
            else
            {
                ?>
                <div class="nouveau_membre" >
                          <p>Les deux mot de passe inscrit sont différents !</p>
                </div>
                <?php
            }
            
                  ?>
    
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
    </body>
</html>