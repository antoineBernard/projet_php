<?php

//fonction pour trouver les valeurs en base
    function rechercheDuMot($mot) {
        // Connexion à la base de données
        $servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "ProjetWeb";
        $dbport = 3306;
        
        try {
            $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
 
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