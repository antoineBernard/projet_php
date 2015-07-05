<?php
	session_start ();
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
	<div class="contenu">
  <?php

    include 'bandeau.php';
    $id_jeu = $_POST['jeu_commentaire'];
  ?>
  
  <div class="boutons_navigation">
  	<a href="Accueil.php" class="bouton" style="margin-right:10px;">Accueil</a>
  	<a href="Top10.php" class="bouton">Top 10</a>	
  </div>    
    
  <div id="formulaire_ajout_commentaire">
    <form action="PageJeux.php" method="post" id="ajout_commentaire">
		<fieldset><legend>Ajouter un commentaire</legend>
		 <label for="note">Note :</label><select name="note"><option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
															</select><br><br>
	      <label for="commentaire">Laisse un commentaire (maximum 346 caractères) :</label><textarea name="commentaire" placeholder="Laisse un commentaire !" maxlength="346" required></textarea><br><br>
	      <input type="hidden" name="retour_commentaire" value="<?php echo $id_jeu;?>"/>
	      <input type="submit" name="valider" value="Valider" style="margin-right:4%;"/><br>
	  </form>
  </div>
 </div>
  <div class="footer">
	  <a href="Formulaire_contact.php">Contact</a>
  </div>
    
</body>
</html>