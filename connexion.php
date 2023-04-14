<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="connexion.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Connexion</title>
		<meta charset="utf-8">
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
							<a href="inscription.php">Inscription</a>
						</li>
						<li>
							<a href="ajout.php">Ajouter votre citation</a>
						</li>   
					</ul>
				</div>	
		</header>

		<main>
			<h1>Connexion</h1>
			<form action="" method="POST">
				<label for="email"></label>
				<input type="email" name="email" id="email" placeholder="Email">
				<br>
				<label for="mdp"></label>
				<input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
				<br>
				<input type="submit" value="Connexion" name="envoyer">
				<p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
			</form>

			
		</main>
		

	</body>
</html>
<?php

	if(isset($_POST['envoyer'])){
		 // Si j'ai reçu le bouton de soumission, c'est que le formulaire a été envoyé.
		 $email = trim($_POST['email']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
		 $mdp = trim($_POST['mdp']);
		 $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut
	 
		 if(empty($email)){
			 echo '<p class="result" >Le champ email est vide</p>';
			 $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
		 }
	 
		 if(empty($mdp)){
			 echo '<p class="result">Le champ mot de passe est vide</p>';
			 $erreur = true;
		 }
	 
		 	 
		 if($erreur == false){
			// Si j'ai reçu le bouton de soumission, c'est que le formulaire a été envoyé.
			require_once 'bdd.php';
			$sql = 'SELECT * FROM utilisateur WHERE email = :e';
			$select = $co->prepare($sql);
			$select->execute([
				'e' => $_POST['email']
			]);
			$utilisateur = $select->fetch(); // Récupère un utilisateur
			if(!empty($utilisateur)){
				if((password_verify($_POST['mdp'], $utilisateur['mdp']))){
					
					$_SESSION['pseudo'] = $utilisateur['pseudo'];
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['id'] = $utilisateur['id'];
					$_SESSION['role'] = $utilisateur['role'];

					
					if($_SESSION['role'] == 'admin'){
						header('Location: admin.php');
					}
					else{
						header('Location: favori.php');
					}
				}
				else {
					echo '<p class="result">Mot de passe incorrect</p>';	
					?>
						<p class="result"><a href="reset.php">Vous avez oublié votre mot de passe ?</a></p>
					<?php											
				}
			}
			else{
				echo '<p class="result">Identifiants incorrects</p>';
			}
		}
		else{
			echo '<p class="result">Certains champs sont vides, remplissez les avant de continuer</p>';
		}
	
	}

?>