<?php

//fonction pour trouver les valeurs en base
    function rechercheDuMot($mot) {
        // Connexion à la base de données
        include 'connexionBDD.php';
 
        // Requête
        $requete = "SELECT Nom FROM jeux";
 
        // Exécution de la requête SQL
        $resultat = $bdd->query($requete);
        
        $tableauNom = array();
        
        //je range les resultats dans le tableau avec la fonction PDO qui déchire
        $tableauNom = $resultat->fetchAll(PDO::FETCH_COLUMN);
        
        //je met bdd a null pour éviter les erreurs avec une nouvelle recherche
        $bdd = null;
        
        return $tableauNom;
    }
        
?>