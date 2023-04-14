<?php
session_start();

    if (array_key_exists('id' , $_SESSION)){
        if($_SESSION['categorie'] == 'citation_serie'){
            $sql = 'INSERT INTO favori_serie(id_utilisateur,id_citation) VALUES (:u, :e)';
            require_once 'bdd.php';
            $insert = $co->prepare($sql);
            $insert->execute([
                'u' => $_SESSION['id'],
                'e' => $_SESSION['c_id']
            ]);
            if($insert->rowCount()> 0){
                echo '<p>Ajouté dans les favoris</p>';
                echo $_SESSION['categorie'];
            }
            else{
                echo '<p>Erreur</p>';
                echo $_SESSION['categorie'];
            }
        }

        else if($_SESSION['categorie'] == 'citation_film'){
            $sql = 'INSERT INTO favori_film(id_utilisateur,id_citation) VALUES (:u, :e)';
            require_once 'bdd.php';
            $insert = $co->prepare($sql);
            $insert->execute([
                'u' => $_SESSION['id'],
                'e' => $_SESSION['c_id']
            ]);
            if($insert->rowCount()> 0){
                echo '<p>Ajouté dans les favoris</p>';
                echo $_SESSION['categorie'];
                echo $_SESSION['c_id'];
            }
            else{
                echo '<p>Erreur</p>';
                echo $_SESSION['categorie'];
                echo $_SESSION['c_id'];

            }
        }
        else if($_SESSION['categorie'] == 'citation_livre'){
            $sql = 'INSERT INTO favori_livre(id_utilisateur,id_citation) VALUES (:u, :e)';
            require_once 'bdd.php';
            $insert = $co->prepare($sql);
            $insert->execute([
                'u' => $_SESSION['id'],
                'e' => $_SESSION['c_id']
            ]);
                if($insert->rowCount()> 0){
                    echo '<p>Ajouté dans les favoris</p>';
                    echo $_SESSION['categorie'];
                    echo $_SESSION['c_id'];
                }
                else{
                    echo '<p>Erreur</p>';
                    echo $_SESSION['categorie'];
                    echo $_SESSION['c_id'];
                }
        }
    }
    else{
        echo 'Veuillez vous connecter pour ajouter la citation';
    }

?>