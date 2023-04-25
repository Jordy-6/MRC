<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
		<title>Ajout citation BDD</title>
		<link rel="stylesheet" href="ajoutbdd.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body>
    <header>
            <div class="logo">
				<img src="img/mrc-low-resolution-logo-black-on-transparent-background.png" alt="">
			</div>
            <div class="lien">
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="favori.php">Vos Favoris</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </div>
            
    
    </header>
</body>
</html>

<?php

if( isset($_GET['id']) ){
    //on recupere $_GET['id']
    $id = $_GET['id'];

    $sql = 'SELECT * FROM jr_proposition WHERE id = :id';
    //Connexion a la bdd
    require_once 'bdd.php';

    $voir = $co->prepare($sql);
    //Execute la supression
    $voir->execute([
        'id'=> $id,
    ]);

    if ($voir->rowCount() > 0){
        //La personne existe dans la base
        $utilisateur = $voir->fetch();
        //var_dump($utilisateur);
        echo '<p>'.$utilisateur['citation'].'<br><br></p>';
        
        if( $utilisateur['categorie'] == "1"){
            $sql = 'SELECT contenu FROM jr_citation_film WHERE contenu = :c';
            $select = $co->prepare($sql);
            $select->execute([
                'c' => $utilisateur['citation']
            ]);
            $utilisateur = $select->fetch();
            if(empty($utilisateur)){
                ?>
                <form action="" method="POST">
                    <label for="nom_film"></label>
                    <input type="text" placeholder="Nom du film" name="nom_film" id="nom_film">
                    <br>
                    <br>
                    <label for="perso"></label>
                    <input type="text" placeholder="Personnage" name="perso" id="perso">
                    <br>
                    <br>
                    <label for="temps"></label>
                    <input type="text" placeholder="Timestamp" name="temps" id="temps">
                    <br>
                    <br>
                    <label for="citation"></label>
                    <input type="text" placeholder="Citation" name="citation" id="citation">
                    <br>
                    <br>
                    <input type="submit" name="envoyer" value="Envoyer">  
                </form>
                <?php
                if( isset($_POST['envoyer']) ){
                    
                    $film = trim($_POST['nom_film']);
                    $nom_perso = trim($_POST['perso']);
                    $time = trim($_POST['temps']);
                    $citation = trim($_POST['citation']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
                    
        
                    $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut
        
                    if(empty($citation) || empty($film) || empty($time) || empty($nom_perso)){
                        echo '<p>Certains champs sont vides</p>';
                        $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
                    }
        
                    
                    //S'il n'a pas d'erreurs
                    if($erreur == false){


                        
                        $sql = 'INSERT INTO jr_citation_film(nom_film,personnage,minutes,contenu) VALUES (:n, :p, :m, :c)';
        
                        //Prepare l'insertion
                        $insert = $co->prepare($sql);
                        // Execute l'insertion en ajoutant les données
                        $insert->execute([
                            'n' => $film,
                            'p' => $nom_perso,
                            'm' => $time,
                            'c' => $citation,
                        ]);
        
                        if($insert->rowCount()> 0){
                            echo '<p>Merci pour votre contribution</p>';
                        }
                        else{
                            echo '<p>Erreur</p>';
                        }
                    }
                    
                }
            }
            else{
                echo '<h1>La citation existe deja dans la base de données</h1>';
            }
        }


        else if($utilisateur['categorie'] == "2"){
            $sql = 'SELECT contenu FROM jr_citation_serie WHERE contenu = :c';
            $select = $co->prepare($sql);
            $select->execute([
                'c' => $utilisateur['citation']
            ]);
            $utilisateur = $select->fetch();
            if(empty($utilisateur)){
                ?>
                <form action="" method="POST">
                    <label for="nom_serie"></label>
                    <input type="text" placeholder="Nom de la série" name="nom_serie" id="nom_serie">
                    <br>
                    <br>
                    <label for="season"></label>
                    <input type="text" placeholder="Saison" name="season" id="season">
                    <br>
                    <br>
                    <label for="ep"></label>
                    <input type="text" placeholder="Episode" name="ep" id="ep">
                    <br>
                    <br>
                    <label for="perso"></label>
                    <input type="text" placeholder="Personnage" name="perso" id="perso">
                    <br>
                    <br>
                    <label for="citation"></label>
                    <input type="text" placeholder="Citation" name="citation" id="citation">
                    <br>
                    <br>
                    <input type="submit" name="envoyer" value="Envoyer">  
                </form>
                <?php
                if( isset($_POST['envoyer']) ){
                    
                    $serie = trim($_POST['nom_serie']);
                    $saison = trim($_POST['season']);
                    $episode = trim($_POST['ep']);
                    $nom_perso = trim($_POST['perso']);
                    $citation = trim($_POST['citation']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
                    
        
                    $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut
        
                    if(empty($citation) || empty($serie) || empty($nom_perso) || empty($saison) || empty($episode)){
                        echo '<p>Erreur</p>';
                        $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
                    }
        
                    
                    //S'il n'a pas d'erreurs
                    if($erreur == false){
                        
                        $sql = 'INSERT INTO jr_citation_serie(nom_serie,saison,episode,contenu,personnage) VALUES (:n, :s, :e, :c, :p)';
        
                        //Prepare l'insertion
                        $insert = $co->prepare($sql);
                        // Execute l'insertion en ajoutant les données
                        $insert->execute([
                            'n' => $serie,
                            's' => $saison,
                            'e' => $episode,
                            'c' => $citation,
                            'p' => $nom_perso
                        ]);
        
                        if($insert->rowCount()> 0){
                            echo '<p>Merci pour votre contribution</p>';
                        }
                        else{
                            echo '<p>Erreur</p>';
                        }
                    }
        
                }
            }
            else{
                echo '<h1>La citation existe deja dans la base de données</h1>';
            }
        }

        if( $utilisateur['categorie'] == "3"){
            $sql = 'SELECT contenu FROM jr_citation_livre WHERE contenu = :c';
            $select = $co->prepare($sql);
            $select->execute([
                'c' => $utilisateur['citation']
            ]);
            $utilisateur = $select->fetch();
            if(empty($utilisateur)){
                ?>
                <form action="" method="POST">
                    <label for="nom_livre"></label>
                    <input type="text" placeholder="Nom du livre" name="nom_livre" id="nom_livre">
                    <br>
                    <br>
                    <label for="perso"></label>
                    <input type="text" placeholder="Personnage" name="perso" id="perso">
                    <br>
                    <br>
                    <label for="page"></label>
                    <input type="text" placeholder="Chapitre" name="page" id="page">
                    <br>
                    <br>
                    <label for="citation"></label>
                    <input type="text" placeholder="Citation" name="citation" id="citation">
                    <br>
                    <br>
                    <input type="submit" name="envoyer" value="Envoyer">  
                </form>
                <?php
                
                if( isset($_POST['envoyer']) ){
                    
                    $livre = trim($_POST['nom_livre']);
                    $nom_perso = trim($_POST['perso']);
                    $page = trim($_POST['page']);
                    $citation = trim($_POST['citation']); //Recupère la valeur du champ 'mail' et trim supprime les espaces au debut et à la fin
                    
        
                    $erreur = false; //On considere qu'il n'y a pas d'erreur pas defaut
        
                    if(empty($citation) || empty($livre) || empty($page) || empty($nom_perso)){
                        echo '<p>Un des champs est vide</p>';
                        $erreur = true; // Dès qu'on rencontre une erreur, on la passe à True
                    }
        
                    
                    //S'il n'a pas d'erreurs
                    if($erreur == false){
                        
                        $sql = 'INSERT INTO jr_citation_livre(nom_livre,personnage,page,contenu) VALUES (:n, :p, :m, :c)';
        
                        //Prepare l'insertion
                        $insert = $co->prepare($sql);
                        // Execute l'insertion en ajoutant les données
                        $insert->execute([
                            'n' => $livre,
                            'p' => $nom_perso,
                            'm' => $page,
                            'c' => $citation,
                        ]);
        
                        if($insert->rowCount()> 0){
                            echo '<p>Merci pour votre contribution</p>';
                        }
                        else{
                            echo '<p>Erreur</p>';
                        }
                    }
        
                }
            }
            else{
                echo '<h1>La citation existe deja dans la base de données</h1>';
            }    
        }

        

    }


}   
else{
    echo 'Erreur';
}

    
        

?>



