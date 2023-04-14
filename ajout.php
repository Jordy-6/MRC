<?php
//On se connecte à la BDD
require 'bdd.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ajout.css">		
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRC</title>
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
						<a href="inscription.php">Inscription</a>
					</li>   
				</ul>
			</div>
    </header>

    <main>
        <h1>Proposez nous vos citations</h1>
        <form action="" method="POST">
            
            <label for="sujet">Sujet :</label>
            <select name="sujet" id="sujet">
                <?php

                    $sql = 'SELECT * FROM categorie';

                    //Prepare l'insertion
                    $select = $co->prepare($sql);
                    // Execute l'insertion en ajoutant les données
                    $select->execute();
                    $categories = $select->fetchAll();

                    foreach ($categories as $c) {
                        ?>
                        <option value="<?= $c['id']?>"><?= $c['nom']?></option>
                        <?php
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="citation"></label>
            <input type="text" placeholder="Votre citation" name="citation" id="citation">
            <br>
            <br>
            <input type="submit" name="envoyer" value="Envoyer">
        </form>
    </main>
    
</body>
</html>


<?php 
        
        // Si le champ 'envoyer' (name) à été recu
        if( isset($_POST['envoyer']) ){
            
            $sujet = $_POST['sujet'];
            $citation = trim($_POST['citation']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
            

            $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut

            if(empty($citation)){
                echo '<p class="result">Le champ est vide, écrivez votre citation</p>';
                $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
            }

            
            //S'il n'a pas d'erreurs
            if($erreur == false){
                
                $sql = 'INSERT INTO proposition(categorie,citation) VALUES (:s, :c)';

                //Prepare l'insertion
                $insert = $co->prepare($sql);
                // Execute l'insertion en ajoutant les données
                $insert->execute([
                    's' => $sujet,
                    'c' => $citation,
                ]);

                if($insert->rowCount()> 0){
                    echo '<p class="result">Merci pour votre contribution</p>';
                }
                else{
                    echo '<p class="result">Erreur</p>';
                }
            }

        }
        
        
    
    ?>

<!-- SELECT c.nom AS categorie, p.citation AS citation FROM proposition p INNER JOIN categorie c ON c.id = p.categorie -->