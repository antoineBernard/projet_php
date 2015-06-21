
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
    		  <a href="Accueil.php"><img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
    		  <a href="Proposition_jeu.php" id="bouton_proposition">Propose ton jeu</a>
    		  
    		<?php
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

    