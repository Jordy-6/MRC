<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
        <title>Nouveau mot de passe</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="reset.css">
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
            <h1>Réinistialisation du mot de passe</h1>
            <form action="" method="POST">
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email ">
                <br>
                <label for="mdp"></label>
                <input type="password" name="mdp" id="mdp" placeholder="Nouveau mot de passe">
                <br>
                <label for="mdp2"></label>
                <input type="password" name="mdp2" id="mdp2" placeholder="Confirmer le nouveau mot de passe">
                <br>
                <input type="submit" value="Connexion" name="envoyer">
            </form>
        </main>	
    </body>
</html>

<?php

if(isset($_POST['envoyer'])){
    // Si j'ai reçu le bouton de soumission, c'est que le formulaire a été envoyé.
    $email = trim($_POST['email']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
    $mdp = trim($_POST['mdp']);
    $mdp2 = trim($_POST['mdp2']);

    $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut

    if(empty($email)){
        echo '<p class="result">Le champ email est vide</p>';
        $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
    }

    if(empty($mdp)){
        echo '<p class="result">Le champ nouveau mot de passe est vide</p>';
        $erreur = true;
    }

    if(empty($mdp2)){
        echo '<p class="result">Le champ confirmation du nouveau mot de passe est vide</p>';
        $erreur = true; 
    }

    if($erreur == false){
            require_once 'bdd.php';
            $sql = 'SELECT * FROM jr_utilisateur WHERE email = :e';
			$select = $co->prepare($sql);
			$select->execute([
				'e' => $email
			]);
			$utilisateur = $select->fetch();
            if(!empty($utilisateur)){
                if($mdp == $mdp2){
                    require_once 'bdd.php';

                    $sql2 = 'UPDATE jr_utilisateur SET mdp = :m  WHERE email = :e';
                    $select2 = $co->prepare($sql2);
                    $select2->execute([
                        'm' => password_hash($mdp, PASSWORD_DEFAULT),
                        'e' => $email
                    ]);
                
                    echo '<p class="result">Mot de passe bien changé</p>';
                }
                else{
                    echo '<p class="result">Les mots de passe ne sont pas identiques</p>';
                }
            }
            else{
                echo '<p class="result">Email inexistant, veuillez réessayer</p>';
            }
    }
    
    if ($select->rowCount() > 0){
        //La mise à jour est effectué
        header('Location: connexion.php');
    }
    
} 
?>
