<?php
session_start();
session_destroy();
// A changer lors de la réunion du projet mettre la page d'accueil de Mélissa
//header('location: ../index.php');
header('location: budget/entrees.php');
exit;
?>