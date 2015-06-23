
    	<title>Accueil</title>
        <meta charset="UTF-8"/>
    	<link rel="stylesheet" type="text/css" href="projet_Web.css">
    	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    	
    	<!-- css de base de Jquery -->
    	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    	
    	<!-- j'importe ma jolie librairie Jquery et JqueryUI pour faire de l'ajax (modifier des données HTML sans recharger la page -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    	
    	<!-- du javascript comme s'il en pleuvait-->
    	<script>
       	$(document).ready(function() {
            $('#recherche_jeux_nom').autocomplete({
                serviceUrl: 'autocompletion.php',
                dataType: 'json'
            });
        });
    	</script>
    </head>
    <body>
    
    	<div class="bandeau">
          <form id="recherche_nom_form" method="post" action="Resultat_recherche_bandeau.php">
            <input type="text" id="recherche_jeux_nom" name="recherche_nom" placeholder="Rechercher par nom"/>
          </form>
    		  <a href="/Accueil.php"><img src="/Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/></a>
    		  <a href="Proposition_jeu.php" id="bouton_proposition">Propose ton jeu</a>
    		  
    		<?php
    		  if(!$_SESSION['Pseudonyme'])//si il n'y a pas de variable de session Pseudonyme c'est que l'utilisateur est deco
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

    