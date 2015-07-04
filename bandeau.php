
    	<title>Accueil</title>
        <meta charset="UTF-8"/>
    	<link rel="stylesheet" type="text/css" href="projet_Web.css">
    	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    	
    	<!-- css de base de Jquery -->
    	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    	
    	<!-- j'importe ma jolie librairie Jquery et JqueryUI pour faire de l'ajax (modifier des données HTML sans recharger la page -->
    	  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <script src="auto-complete.js"></script>

    	</script>
    </head>
    <body>
    
    	<div class="bandeau">
    	    <!--  autocomplete off pour empêcher le navigateur de proposer des jeux déjà saisie auparavant (dessus le systeme d'autocompletion du site-->
          <form id="recherche_nom_form" method="post" action="Resultat_recherche.php" autocomplete="off">
            <input type="text" value="" name="recherche_nom" placeholder="Rechercher par nom" id="recherche_jeux_nom"/>
                <!--on prepare les valeurs d'auto completion-->
                <div id="resultats-autocompletion">
                </div>
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

    