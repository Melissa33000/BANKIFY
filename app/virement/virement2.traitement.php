<?php
session_start();
include_once ('../../inclusions/connectDB.php');

// floatval : Fonction qui convertit une chaîne en nombre à virgule flottante
$_POST['montant'] = floatval($_POST['montant']);

// Vérification de la conformité de la saisie du montant du virement
if(!isset($_POST['montant']) or !is_float($_POST['montant']) or !($_POST['montant']>0)){
    print("Le montant n'est pas conforme<br />");
    die();
}

// Récolte des données des 2 comptes
$SQLQuery = 'SELECT * FROM compte WHERE id_utilisateur = :utilisateuractuel and id= :id_compteemetteur';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_compteemetteur', $_POST['id_compteemetteur']);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la sélection des comptes!<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}

$SQLResultCompteEmetteur = $SQLStatement->fetchObject();
$SQLStatement->closeCursor();

$SQLQuery = 'SELECT * FROM compte WHERE id_utilisateur = :utilisateuractuel and id= :id_comptebeneficiaire';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_comptebeneficiaire', $_POST['id_comptebeneficiaire']);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la sélection des comptes!<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLResultCompteBeneficiaire = $SQLStatement->fetchObject();
$SQLStatement->closeCursor();

// Calcul du solde final après virement
$SQLResultFinalEmetteur= $SQLResultCompteEmetteur->solde_initial - $_POST['montant'];

if ($SQLResultFinalEmetteur < $SQLResultCompteEmetteur->decouvert_max){
    print("Le découvert autorisé est dépassé");
    die();
}

$SQLResultFinalBeneficiaire= $SQLResultCompteBeneficiaire->solde_initial + $_POST['montant'];

// Actualisation des données en BDD
$SQLQuery = 'UPDATE compte SET solde_initial =:soldeapresvirement WHERE id_utilisateur = :utilisateuractuel and id= :id_compteemetteur';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_compteemetteur', $_POST['id_compteemetteur']);
$SQLStatement->bindValue(':soldeapresvirement', $SQLResultFinalEmetteur);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la mise à jour du compte émétteur !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLStatement->closeCursor();

$SQLQuery = 'UPDATE compte SET solde_initial =:soldeapresvirement WHERE id_utilisateur = :utilisateuractuel and id= :id_comptebeneficiaire';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_comptebeneficiaire', $_POST['id_comptebeneficiaire']);
$SQLStatement->bindValue(':soldeapresvirement', $SQLResultFinalBeneficiaire);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la mise à jour du compte bénéficiaire !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLStatement->closeCursor();

// POUR PLUS TARD, créer BOUTON FREQUENCE à connecter avec BDD !!!!!!!
//if(!isset($_POST['id_frequence'])){
//$_POST['id_frequence'] = 1;
//} codage a continuer. Pour l'instant en dure pour qe ca soit unique

// Insertion de données dans la table opération
$SQLQuery = 'INSERT INTO operation(nom, montant, date, infosup, /*id_tiers,*/ id_frequence ,  id_compte, id_type_operation, id_categorie) VALUES (:nomdeloperation, :montant, NOW(), :informationscomplementaires, /*:tiers,*/ :frequence, :compte_emetteur, 2, :categorie)';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':nomdeloperation', $_POST['nomdeloperation']);
$SQLStatement->bindValue(':montant', $_POST['montant']);
$SQLStatement->bindValue(':informationscomplementaires', $_POST['informationscomplementaires']);
//$SQLStatement->bindValue(':tiers', $_POST['id_tiers']);
$SQLStatement->bindValue(':frequence', 1);
$SQLStatement->bindValue(':compte_emetteur', $_POST['id_compteemetteur']);
$SQLStatement->bindValue(':categorie', 1);
// pour :tiers, :frequence et :categories , je ne sais pas encore comment seront les bindValue -> à coder !!

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la mise à jour du compte émetteur !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLStatement->closeCursor();

$SQLQuery = 'INSERT INTO operation(nom, montant, date, infosup, /*id_tiers,*/ id_frequence ,  id_compte, id_type_operation, id_categorie) VALUES (:nomdeloperation, :montant, NOW(), :informationscomplementaires, /*:tiers,*/ :frequence, :compte_beneficiaire, 1 , :categorie)';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':nomdeloperation', $_POST['nomdeloperation']);
$SQLStatement->bindValue(':montant', $_POST['montant']);
$SQLStatement->bindValue(':informationscomplementaires', $_POST['informationscomplementaires']);
//$SQLStatement->bindValue(':tiers', $_POST['id_tiers']);
$SQLStatement->bindValue(':frequence', 1);
$SQLStatement->bindValue(':compte_beneficiaire', $_POST['id_comptebeneficiaire']);
// plus tard mettre les bonnes catégories
$SQLStatement->bindValue(':categorie', 1);
// pour id tiers, id frequence et id categories , je sais pas encore comment seront les bindValue -> à coder

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la mise à jour du compte bénéficiaire !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLStatement->closeCursor();

/*
CODE si l'insertion de id compte_emetteur et id_beneficiaireinsertion avait été validé dans la table opération :

$SQLQuery = 'INSERT INTO operation(nom, montant, date, infosup, id_frequence, id_compteemetteur, id_comptebeneficiaire, id_type_operation) VALUES (:nomdeloperation, :montant, NOW(), :informationscomplementaires, :ifrequence, :compte_emetteur, :compte_beneficiaire, 2)';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':nomdeloperation', $_POST['nomdeloperation']);
$SQLStatement->bindValue(':montant', $_POST['montant']);
$SQLStatement->bindValue(':informationscomplementaires', $_POST['informationscomplementaires']);
$SQLStatement->bindValue(':frequence', 1);
$SQLStatement->bindValue(':compte_emetteur', $_POST['id_compteemetteur']);
$SQLStatement->bindValue(':compte_beneficiaire', $_POST['id_comptebeneficiaire']);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de l'insertion de l'opération !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLStatement->closeCursor();
*/

// L'utilisateur est redirigé vers la page virement3.php en passant les valeurs des variables des comptes
header('Location:virement3.php?compteemetteur='.$_POST['id_compteemetteur'].'&comptebeneficiaire='.$_POST['id_comptebeneficiaire']);
exit();

?>