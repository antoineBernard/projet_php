<?php
    require('database.php');

    //si il y a pas de mot clé
    if (!isset($_GET['motcle'])) {
    	die();
    }
    //je prend le mot clé
    $motcle = $_GET['motcle'];
    //je recherche avec ma fonction de database.php et met dans $data 
    $data = rechercheDuMot($motcle);
    
    //je l'envoi en json (bertrand : JSON c'est un format pour partager les données (indispensable pour communiqué entre différent langage parfois)
    echo json_encode($data);

?>
