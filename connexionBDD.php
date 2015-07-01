<?php
			try
			{
				$servername = getenv('IP');
				$username = getenv('C9_USER');
    		    $password = "";
				$database = "ProjetWeb";
				$bdd=new PDO("mysql:host=$servername;dbname=$database;charset=utf8",$username,$password);					
			}
			catch(Exception $e){
				echo "Erreur de connexion avec la base : projetweb\n";
				echo 'Message : '.$e->getMessage()."\n";
			}
?>