<!DOCTYPE html>
<html>
<head>
	<title>Trouve ton jeu !</title>
    <meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="projet_Web.css">
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>
  <body>

    <div class="bandeau">
      <form id="recherche_nom_form" method="post" action="Resultat_recherche.html">
       <input type="text" name="recherche_nom" placeholder="Rechercher par nom"/>
     </form>
     <img src="Images/logo_projet_web_blanc.png" style="position:absolute;height:80%;top:10%;left:47.5%;"/>
	  <a href="Proposition_jeu.html" id="bouton_proposition">Propose ton jeu</a>
    </div>
	
	<div class="boutons_navigation">
	   <a href="Accueil.html" class="bouton" style="margin-right:10px;">Accueil</a>
	   <a href="Top10.html" class="bouton">Top 10</a>  
    </div>
	
	<div class="notre_selection">
		Notre sélection pour vous
	</div>
    <div class="clear"></div>
	<div class="barre_resultat"></div>

	<div class="jeux_suggeres">
  	   <?php
			$genre=$_POST['genre'];
			$univers=$_POST['univers'];
			$annee=(int)$_POST['annee_sortie'];
			if($annee<1960 || $annee>2020)
			{
		       echo "Entrez une année valide !";
			}
			else
			{
			  echo $genre." ".$univers." ".$annee;	
			}
		?>
	</div>
	
    <div class="footer">
	  <a href="Formulaire_contact.html">Contact</a> / Réseaux sociaux
    </div>
  </body>
</html>