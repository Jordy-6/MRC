<?php



require 'bdd.php';

$tables = ['citation_film', 'citation_serie', 'citation_livre'];

$table = $tables[rand(0, 2)];
$sql = 'SELECT * FROM '.$table.' ORDER BY RAND() LIMIT 1';

$select = $co->prepare($sql);

$select->execute();

$citation = $select->fetch();

if($table == 'citation_serie'){
    $_SESSION['categorie'] = 'citation_serie';
    $_SESSION['c_id'] = $citation['id'];
    echo '<div class="citation"><p>"'.$citation['contenu'].'"</p> 
     <span class="perso">'.$citation['personnage'] .'</span> <span class="autres"> '.$citation['nom_serie'].' saison '.$citation['saison'].' episode '.$citation['episode'].'</span>';
    ?>
        <br><br><a href="ajoutfav.php">Ajouter à vos favoris</a></div>
    <?
}
else if($table == 'citation_film'){
    $_SESSION['categorie'] = 'citation_film';
    $_SESSION['c_id'] = $citation['id'];
    echo '<div class="citation"><p>"'.$citation['contenu'].'"</p><span class="perso">'.$citation['personnage'].'</span> <span class="autres">'.$citation['nom_film'].' '.$citation['minutes'].'</span>';
    ?>
        <br><br><a href="ajoutfav.php">Ajouter à vos favoris</a></div>
    <?
}
else if($table == 'citation_livre'){
    $_SESSION['categorie'] = 'citation_livre';
    $_SESSION['c_id'] = $citation['id'];
    echo '<div class="citation"><p>"'.$citation['contenu'].'"</p><span class="perso">'.$citation['personnage'].'</span> <span class="autres">'.$citation['nom_livre'].' Chapitre '.$citation['page'].'</span>';
    ?>
        <br><br><a class="fav" href="ajoutfav.php">Ajouter à vos favoris</a></div>
    <?

}



?>


    <!-- <form action="" method="post"> -->
        <!-- <input type="image" src="img/coeur.png" alt="" id="StatutFavoris1" onclick="changeStatutFavoris(1)"> -->
    <!-- </form> -->


    <!-- <img id="StatutFavoris2" class="favoris" src="img/coeur.png" onclick="changeStatutFavoris(2)" alt="Icone favoris"> -->
  <!-- <script src="script.js"></script> -->
 
    
    


