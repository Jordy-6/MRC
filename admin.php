<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
		<title>Admin</title>
		<link rel="stylesheet" href="admin.css">
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
							<a href="favori.php">Favoris</a>
						</li>
						<li>
							<a href="deconnexion.php">Deconnexion</a>
						</li>   
					</ul>
				</div>	
    </header>
    <?php
        if(isset($_SESSION) && array_key_exists('role', $_SESSION)){
            if($_SESSION['role'] == 'admin'){
                $sql = 'SELECT c.nom AS categorie, p.citation AS citation, p.id AS id FROM proposition p INNER JOIN categorie c ON c.id = p.categorie';
                //Connexion a la bdd
                require 'bdd.php';

                $voir = $co->prepare($sql);
                //Execute la supression
                $voir->execute();
                
                $utilisateurs = $voir->fetchAll();

                if (!empty($utilisateurs)){
                    foreach ($utilisateurs as $u) {
                        echo '<p>'.$u['categorie'].'  "'.$u['citation'].'"';
                        ?>
                        - <a href="ajoutbdd.php?id=<?php echo $u['id']; ?>">Ajouter la citation</a>
                        - <a href="supprbdd.php?id=<?php echo $u['id']; ?>">Supprimer la citation</a></p>  
                        <br>
                        <?php
                    }
                } 
                else{
                    echo 'Aucune proposition de citation';
                }
            }
        }
        else{
            echo "<h1>Vous n'êtes pas autorisé à aller sur cette page</h1>";
        }
    ?>
</body>
</html>