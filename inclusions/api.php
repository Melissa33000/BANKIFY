<?php  
	if(isset($_POST['idcat'])){
		$conn = new pdo("mysql:host=localhost; charset=utf8; dbname=bankify; port=3307", 'root', 'root');
		$query = "SELECT libelle FROM categorie ";
		$query.="WHERE id_categorie = :idcat ";
		$query.="ORDER BY libelle";
		$SQLStatetement = $conn->prepare($query);
		$SQLStatetement->bindValue(':idcat', $_POST['idcat']);
		$SQLStatetement->execute();
		$SQLResult = $SQLStatetement->fetchAll();
		$SQLStatetement->closeCursor();
		print(json_encode($SQLResult));
	}else if(isset($_POST['idOp'])){
		$conn = new pdo("mysql:host=localhost; charset=utf8; dbname=bankify; port=3307", 'root', 'root');
		$query = "SELECT operation.nom AS nomOp, categorie.libelle AS libelleCat, tiers.nom AS nomTiers FROM operation ";
		$query .= "LEFT OUTER JOIN tiers ON operation.id_tiers=tiers.id ";
		$query .= "LEFT OUTER JOIN categorie ON operation.id_categorie=categorie.id ";
		$query .="WHERE operation.id = :idOp ";
		$SQLStatetement = $conn->prepare($query);
		$SQLStatetement->bindValue(':idOp', $_POST['idOp']);
		$SQLStatetement->execute();
		$SQLResult = $SQLStatetement->fetchAll();
		$SQLStatetement->closeCursor();
		print(json_encode($SQLResult));
	}else{
		print('Mauvais paramètre !');
	}
?>