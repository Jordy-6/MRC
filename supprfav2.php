<?php
        //On verifie que $_GET['id'] ai été envoyé
        if(isset($_GET['id']) ){
            //on recupere $_GET['id']
            $sql = 'DELETE FROM jr_favori_serie WHERE id_fav = :id';
            //Connexion a la bdd
            require 'bdd.php';

            $suppression = $co->prepare($sql);
            //Execute la supression
            $suppression->execute([
                'id'=> $_GET['id'],
            ]);

            if ( $suppression->rowCount() > 0 ){
                header('Location: favori.php');
            }
            else{
                echo '<p>Erreur</p>';
            }

        }
?>