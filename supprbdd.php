<?php
        //On verifie que $_GET['id'] ai été envoyé
        if(isset($_GET['id']) ){
            //on recupere $_GET['id']
            $id = $_GET['id'];
            $sql = 'DELETE FROM proposition WHERE id = :id';
            //Connexion a la bdd
            require 'bdd.php';

            $suppression = $co->prepare($sql);
            //Execute la supression
            $suppression->execute([
                'id'=> $id,
            ]);

            if ( $suppression->rowCount() > 0 ){
                header('Location: admin.php');
            }
            else{
                echo '<p>Erreur</p>';
            }

        }
?>