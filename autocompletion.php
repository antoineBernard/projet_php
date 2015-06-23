<?php
       if(isset($_GET['query'])) {
        // jeux recherché par l'utilisateur !
        $q = htmlentities($_GET['query']);
 
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
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
        // On parcourt les résultats de la requête SQL
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les données dans un tableau
            $suggestions['suggestions'][] = $donnees['nom'];
        }
 
        // On renvoie le données au format JSON pour le plugin Jquery
        echo json_encode($suggestions);
    }

?>
