<?php
/* CONNEXION AVEC PDO */
// Connexion à la BDD si je n'indique pas de port c'est 3306 par défaut
$db=null;
try {
    $db = new PDO('mysql:host=localhost;dbname=bankify', 'root', 'root');
}catch(PDOException $e){
    echo '<p style="text-align: center; color: red;">IL Y A UNE ERREUR DE CONNEXION A LA BASE DE DONNEES</p>';
    echo $e;
}
