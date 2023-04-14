<!doctype html>
<html>
	<head>
		<title>Favoris</title>
		<meta charset="utf-8">
        <link rel="stylesheet" href="favori.css">
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
            echo '<h2>Bonjour '.$_SESSION['pseudo'].'</h2>';

        require 'bdd.php';

        //pour favori_film
        $sql = 'SELECT * FROM favori_film JOIN citation_film ON  favori_film.id_citation = citation_film.id
                JOIN utilisateur ON  favori_film.id_utilisateur = utilisateur.id
                WHERE utilisateur.email = :e';


        $select = $co->prepare($sql);


        $select->execute([
            'e' => $_SESSION['email']
        ]);

        $utilisateurs = $select->fetchAll();


        //favori_serie
        $sql2 = 'SELECT * FROM favori_serie JOIN citation_serie ON  favori_serie.id_citation = citation_serie.id
                JOIN utilisateur ON  favori_serie.id_utilisateur = utilisateur.id
                WHERE utilisateur.email = :e';


        $select2 = $co->prepare($sql2);
        $select2->execute([
            'e' => $_SESSION['email']
        ]);
        $utilisateurs2 = $select2->fetchAll();



        //favorie_livre
        $sql3 = 'SELECT * FROM favori_livre JOIN citation_livre ON  favori_livre.id_citation = citation_livre.id
        JOIN utilisateur ON  favori_livre.id_utilisateur = utilisateur.id
        WHERE utilisateur.email = :e';


        $select3 = $co->prepare($sql3);


        $select3->execute([
            'e' => $_SESSION['email']
        ]);

        $utilisateurs3 = $select3->fetchAll();


        echo '<h1 class="cate">FILM</h1>';
        if (!empty($utilisateurs)){
                
        foreach($utilisateurs as $u){

            echo '<p> - '.$u['contenu'].' - '.$u['personnage'].' - '.$u['nom_film'];
            ?>
                <a href="supprfav1.php?id=<?php echo $u['id_fav']; ?>">Supprimer le favori</a></p>
                <br>
            <?php

        }                                                                       
        } 

        else{
            echo '<p>Aucun favoris dans cette catégorie</p>';
        }


        echo '<h1 class="cate">SERIES</h1>';
        if (!empty($utilisateurs2)){
                
        foreach($utilisateurs2 as $u2){

            echo '<p> - '.$u2['contenu'].' - '.$u2['personnage'].' - '.$u2['nom_serie'].' - '.$u2['saison'].' - '.$u2['episode'];
            ?>
                - <a href="supprfav2.php?id=<?php echo $u2['id_fav']; ?>">Supprimer</a></p>
                <br>
            <?php
        }                                                                       
        } 

        else{
            echo '<p>Aucun favoris</p>';
        }

        echo '<h1 class="cate">LIVRES</h1>';
        if (!empty($utilisateurs3)){
            foreach($utilisateurs3 as $u3){
                 echo '<p> - '.$u3['contenu'].' - '.$u3['personnage'].' - '.$u3['nom_livre'].' - Chapitre '.$u3['page'];
                ?>
                     - <a href="supprfav3.php?id=<?php echo $u3['id_fav']; ?>">Supprimer</a></p>
                    <br>
                <?php
            }                                                                       
        } 

        else{
            echo '<p>Aucun favoris</p>';
        }
    } 

    else{
        echo "<h1>Veuillez vous connecter pour retrouver vos favoris</h1>";
    }
?>



