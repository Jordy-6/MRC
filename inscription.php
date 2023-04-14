<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inscription</title>
		<link rel="stylesheet" href="inscription.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
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

		<main>
			<div>
				<h1>Inscription</h1>
				<form action="" method="POST">
				<label for="email"></label>
				<input type="email" name="email" id="email" placeholder="Email">
				<br>
				<br>
				<label for="pseudo"></label>
				<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo">
				<br>
				<br>
				<label for="mdp"></label>
				<input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe">
				<br>
				<br>
				<label for="mdp2"></label>
				<input type="password" name="mdp2" id="mdp2" placeholder="Confirmation de mot de passe">
				<br>
				<br>
				<input type="submit" value="Inscription" name="envoyer">
				</form>
				<p>Vous avez déja un compte ? <a href="connexion.php">Connectez vous</a></p>
			</div>
		</main>
	</body>
</html>

<?php
	if(isset($_POST['envoyer'])){
		// Si j'ai reçu le bouton de soumission, c'est que le formulaire a été envoyé.

		if($_POST['mdp'] == $_POST['mdp2']){
			// Si les deux mots de passe sont identiques
			require_once 'bdd.php';
			$sql = 'SELECT * FROM utilisateur WHERE email = :e';
			$select = $co->prepare($sql);
			$select->execute([
				'e' => $_POST['email']
			]);

			$utilisateur = $select->fetch(); // Récupère un résultat

			if(!empty($utilisateur)){
				echo '<p class="result">Cet utilisateur existe déjà</p>';
			}
			else{
				$sql = 'INSERT INTO utilisateur (email, mdp, pseudo) VALUES(:e, :mdp, :p)';
				$insert = $co->prepare($sql);
				$insert->execute([
					'e' => $_POST['email'],
					'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
					'p' => $_POST['pseudo']
				]);

				if($insert->rowCount() > 0){
					echo '<p class="result">Inscription effectuée</p>';						
				}
				else{
					echo '<p class="result">Veuillez réessayer votre inscription</p>';
				}
			}
		}
		else{
			echo '<p class="result">Les deux mots de passe ne sont pas identiques</p>';
		}
	}
?>