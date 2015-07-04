<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
<body>
   <div class="contenu">
       <?php include 'bandeau.php'; ?>
        <div style="position:absolute;top:110px;left:15px;">
           <?php
            $message_erreur =" ";
            //on se connecte à la base
            include'connexionBDD.php';
        
        
            // Check connection
            if ($bdd->connect_error) {
                die("Connection failed: " . $bdd->connect_error);
            } 

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
               $message_erreur = "L'utilisateur n'existe pas"; 
            }
            else
            {
                $verify = password_verify("boubou", $mdpDeBDD);
                
                //on verifie si le mot de passe est bon
                if(password_verify($mdpSaisie, $mdpDeBDD))
                {
                    session_start();
                    
                    
                    $_SESSION['Pseudonyme'] = $pseudonyme;
                    
                    // $pseudo = $_SESSION['Pseudonyme'];
                    // echo "<p> Vous êtes connecté en tant que $pseudo !<p></div>";
                    
                    // On redirige le visiteur vers la page d'accueil
                    echo "<script> window.location.replace('Accueil.php') </script>";
                }
                else
                {
                    $message_erreur= "Mauvais mot de passe";
                }
            }
      
              ?>
        </div>
       
  
  <div class="boutons_navigation">
	<a href="Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>
       <div class ="nouveau_membre">
           <?php 
            echo "Connexion impossible : ".$message_erreur;
           ?>
           <div>
               <a href="Connexion_utilisateur.html" class="bouton" id="reesayer">Reesayer</a>
           </div>
           
           <div>
               <a href="Formulaire_contact.php" class="bouton" id="reesayer">Mot de passe perdu ?</a>
           </div>
           
       </div>

  </div>  
    <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
    </div>
</body>
</html>