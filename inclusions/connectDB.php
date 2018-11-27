<?php

$dbConn = null;
try{
    $dsn = 'mysql:host=localhost:8889;dbname=bankify;charset=utf8';
    $username = 'root';
    $password = 'root';

    $dbConn = new PDO($dsn, $username, $password);
}catch (Exception $e){
    echo '<p style="text-align: center; color: red;">IL Y A UNE ERREUR DE CONNEXION A LA BASE DE DONNEES</p>';
    echo $e;
}
?>