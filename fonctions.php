<?php

function choixJeuNomine(){

  include 'connexion.php';
    
  $extraction=$bdd->prepare('SELECT * FROM jeux WHERE Nomine=0');
    
  $extraction->excute();
    
  while($tab_jeux[]=$extration->fetch())
  {
  }
    
  $extraction->closeCursor();
    
  $noteMax=0;
  $indexMax=0;
  $plusRecent=1980;
  for($i=0;i<count($tab_jeux);$i++)
    {
     if($tab_jeux[$i]['Note']>$noteMax)  
     {
      $annee=substr($tab_jeux[$i]['Sortie'],-4);
	  $annee=(int)$annee;    
	  $plusRecent=$annee;
			
	  $noteMax=$tab_jeux[$i]['Note'];
	  $indexMax=$i;
			 
     }
	 elseif($tab_jeux[$i]['Note']==$noteMax && $annee>$plusRecent)
	 {
	  $annee=substr($tab_jeux[$i]['Sortie'],-4);
	  $annee=(int)$annee; 
	  $plusRecent=$annee;
     	
      $indexMax=$i;
	 }
    }
    
    $jeuDesigne=$tab_jeux[$i];
    $id_jeuDesigne=$jeuDesigne['ID_jeu'];
    
    $maj=$bdd->prepare("UPDATE jeux SET Nomine=1 WHERE ID_jeu=$id_jeuDesigne");
    $maj->execute();
    $maj->closeCursor();
    
    return $jeuDesigne;
}
?>