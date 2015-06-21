<!DOCTYPE html>
<html>
<head>

<?php
    session_start();
    //on se connecte à la base
    
    include 'bandeau.php';
    
    echo "</head>";
    echo "</html>";
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "ProjetWeb";
    $dbport = 3306;
    $ses = $_SESSION['ID_utilisateur'];
    
    $pseudo = $_SESSION['Pseudonyme'];
    echo $pseudo."<br>";
    try
    {
    // Create connection
     $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
    //$bdd = new mysqli($servername, $username, $password, $database, $dbport);
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
    // Check connection
    if ($bdd->connect_error) {
        die("Connection failed: " . $bdd->connect_error);
    } 

    $reponse = $bdd->query('SELECT Pseudonyme, Adresse_email FROM utilisateurs');

    while ($donnees = $reponse->fetch())
    {
    	echo $donnees['Pseudonyme'] . ' ' . $donnees['Adresse_email'] . ' <br />';
    }
    
    $reponse->closeCursor();


?>
