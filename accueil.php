<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="accueil.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Dancing+Script&display=swap" rel="stylesheet">

	<title>MRC</title>
</head>
<header>
	<div class="logo">
		<img src="img/mrc-low-resolution-logo-black-on-transparent-background.png" alt="">
	</div>

	<div class="lien">	
		<ul>
			<?php
			if(isset($_SESSION) && array_key_exists('role', $_SESSION)){
				if($_SESSION['role'] == 'admin'){
					echo '<li><a href="favori.php">Vos Favoris</a></li>
						<li><a href="admin.php">Administrateur</a></li>
						<li><a href="deconnexion.php">Déconnexion</a></li>';
				}
				else{
					echo '<li><a href="favori.php">Vos Favoris</a></li>
						<li><a href="deconnexion.php">Déconnexion</a></li>
						<li><a href="ajout.php">Ajouter vos citations</a></li>';
				}
				
			}
			else{
				echo '<li><a href="inscription.php">Inscription</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="ajout.php">Ajouter vos citations</a></li>';
			}
			
			?>
			
		</ul>
	</div>
</header>
<body>

	<input type="button" onclick='document.location.reload(false)' value="Changer de citation"/>
	<?php 
		require 'random.php';
	?>
	
	
</body>
</html>