<?php
    //on se connecte à la base
        $servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "ProjetWeb";
        $dbport = 3306;

    // Create connection
        $bdd = new PDO("mysql:host=$servername;dbname=$database;charset=utf8","$username", "$password");
?>