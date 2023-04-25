<?php

	//$host = 'lb221694-001.eu.clouddb.ovh.net';
	//$bdd = 'ProjetsSIO2023';
	//$identifiant = 'adminSIO';
	//$mdp = 'BTSsio2022';

	$host = 'localhost';
	$bdd = 'mrc';
	$identifiant = 'root';
	$mdp = 'root'; 
 
	// essaie quelque chose
	try{
		// connexion à la base de données
		$co = new PDO('mysql:host='.$host.';port=8889;dbname='.$bdd, $identifiant, $mdp);
		//$co = new PDO('mysql:host='.$host.';dbname='.$bdd.';charset=utf8;port=35508,'.$identifiant, $mdp);
		//$co = new PDO("mysql:host=lb221694-001.eu.clouddb.ovh.net;dbname=ProjetsSIO2023;charset=utf8;port=35508", "adminSIO", "BTSsio2022");
	}
	// Si le try ne fonctionne pas :
	catch(Exception $e){
		echo $e->getMessage();
		die();
	}


?>