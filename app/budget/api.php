<?php
include_once("../../inclusions/connectDB.php");
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = 'SELECT (SELECT id from categorie WHERE id=(SELECT id_categorie from operation WHERE id=:id)) AS idSousCat, operation.montant,  devise.symbole, operation.nom, operation.date, IF(operation.infosup is null, "", operation.infosup) AS infosup, frequence.libelle AS frequence, compte.nom AS compte, IF(tiers.nom is null, "", tiers.nom) AS tiers, moyen_paiement.id AS idMoyenPaiement ,moyen_paiement.libelle AS moyenpaiement, (SELECT libelle from categorie WHERE id = (SELECT id_categorie FROM operation WHERE id =:id)) as categorie ';
    $query .= 'FROM operation ';
    $query .= 'INNER JOIN frequence ON operation.id_frequence = frequence.id ';
    $query .= 'INNER JOIN compte ON operation.id_compte = compte.id ';
    $query .= 'LEFT JOIN tiers ON operation.id_tiers = tiers.id ';
    $query .= 'INNER JOIN payer ON operation.id = payer.id_operation ';
    $query .= 'INNER JOIN moyen_paiement ON moyen_paiement.id = payer.id_moyen_paiement ';
    $query .= 'INNER JOIN categorie ON operation.id_categorie = categorie.id ';
    $query .= 'INNER JOIN devise ON compte.id_devise = devise.id ';
    $query .= 'WHERE operation.id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $result = $statement->fetchObject();
    $statement->closeCursor();
    print(json_encode($result));
    //Afficher les cp et ville dans une liste quand on tape dans modifier profil
}else if(isset($_GET['term'])){
    $query = 'SELECT CONCAT(cp, \' - \', ville) as ville, id FROM cpville WHERE cp LIKE :cp OR ville LIKE :cp ORDER BY cp LIMIT 10';
    $statement = $db->prepare($query);
    $statement->bindValue(':cp', $_GET['term'].'%');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($result);
} else{
    print('Erreur AJAX');
}

