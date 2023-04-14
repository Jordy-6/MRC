<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Déconnexion</title>
	<link rel="stylesheet" href="deconnexion.css">
</head>
<body>
	<header>
		<div class="logo">
			<img src="img/mrc-low-resolution-logo-black-on-transparent-background.png" alt="">
		</div>
		
		<div class="lien">
			<ul>
				<li>
					<a href="accueil.php">Accueil</a>
				</li>
				<li>
					<a href="connexion.php">Connexion</a>
				</li>
				<li>
					<a href="ajout.php">Ajouter votre citation</a>
				</li>   
			</ul>
		</div>	
	</header>

	
</body>
</html>
<?php
		session_start();
		if (array_key_exists('pseudo' , $_SESSION)){
			session_destroy();
			header('Location: accueil.php');
		}
		else{
			echo "<h1>Vous ne pouvez pas vous déconnecter si vous n'êtes pas connecté</h1>";
		}
?>




