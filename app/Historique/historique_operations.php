<?php
include_once("../../inclusions/connectDB.php");
include_once('../Compte/Compte.php');
if(!empty($_GET) AND isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_POST)){
        $date = $_POST['date'];
    }
}else{
    //header('location:../404.php');
    //exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Historique global des opérations </title>
        <?php include("../../inclusions/head.php"); ?>
        
        <link href="../../css/style_sirika.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
    </head>
    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet">
                <header id="headerAPPonglet">
                  <h1> Historique des opérations du compte </h1>
                </header>

                <?php
                  include_once 'operations.php';

                  if(!empty ($_GET)){
                    $id = isset($_GET['id'])?$_GET['id']:0;
                    $query = "SELECT operation.date, type_operation.libelle as typeOp, categorie.libelle as nomCat, compte.nom as nomCompte,  operation.nom as  nomOp, operation.montant as montantOp, devise.symbole as symbDev, operation.id FROM operation "; 
                    $query.="INNER JOIN compte ON operation.id_compte=compte.id ";  
                    $query.="INNER JOIN devise ON compte.id_devise=devise.id "; 
                    $query.="INNER JOIN type_operation ON operation.id_type_operation=type_operation.id ";  
                    $query.="INNER JOIN categorie ON operation.id_categorie=categorie.id "; 
                    $query.="WHERE categorie.id BETWEEN 1 AND 16 OR 10001 AND 10015 AND compte.id =".$_GET['id'];
                    $query.=" ORDER BY operation.date DESC";
                 
                    $result = $db->query($query);
                    while($row = $result->fetchobject()){
                            $tabOperations[] = new Operation($row->date, $row->typeOp, $row->nomCat, $row->nomCompte, $row->nomOp, $row->montantOp, $row->symbDev,$row->id);
                    }
                    $result->closecursor();
                  }
                  
                  if (isset($_GET['action']) AND $_GET['action'] == 'del'  AND isset($_GET['idoperation']) AND !empty($_GET)){
                    $idoperation = $_GET['idoperation'];
                    if ($id > 0){
                        $SQLQuery = "Call proc_deleteOperation(:id)";
                      try{
                        $SQLStatement=$db->prepare($SQLQuery);
                        $SQLStatement->bindValue(':id', $idoperation);
                        if ($SQLStatement->execute()){
                          print('<script type="text/javascript">document.location.href="historique_operations.php?id='.$id.'";</script>');
                        }else{
                          print("Erreur d'exécution de la requête de suppression !<br />");
                          var_dump($SQLStatement->errorInfo());
                        }
                      }catch (PDOException $ex){
                        print("Erreur de préparation de la requête de suppression !<br />");
                                      print($ex->getMessage());
                      }
                    }
                  }
                
                ?>
    <div class="main2">
      <div class="entete">
        <div class="bloc-chgGlobCompt">
          <a href="historique_global.php"><input type="button" class="bouton-chgGlobCompt" id="btnGlobal" value="Global"></a>
          <a href="inspection_compte.php"><input type="button" class="bouton-chgGlobCompt" id="btnCompte" value="Compte"></a>
        </div>
        <div class="searchBarHistGlob">
          <input type="search" placeholder="Rechercher...">
          <input type="submit" class="btnSearch" value="Rechercher">
        </div>
      </div>
      <div class="bloc-historiqueGlobal">

        <?php 
            $script='';
            foreach ($tabOperations as $operation){
              $script.='<div class="bloc-operation">
                    <div class="bandeauDate">
                    <div class="nbJour"><p>'.$operation->getJour().'</p></div>';
              $script.='  <div class="nbMois"><p>'.$operation->getMois().'</p></div>';
              $script.='  <div class="nbAnnee"><p>'.$operation->getAnnee().'</p></div></div>';
              $script.='<div class="bandeauOperation">
                    <div class="logoOperation">';
              if($operation->getType()=='Entrée'){
                $script.='<div class="logoTypeOperation"><img src="../../images/transactions.png" width="32px" ></div></div>';
              }else{
                $script.='<div class="logoTypeOperation"><img src="../../images/transactions1.png" width="32px" ></div></div>';
              }
              $script.='<div class="nomCompte">
                    <p>'.$operation->getNomCompte().'</p>
                    </div>';
              if ($operation->getMontant()<0){
                $script.='<div class="montantOperation" style="color:red">
                    <p>'.$operation->getMontant().$operation->getDevise().'</p>
                    </div>';
              }else{
                $script.='<div class="montantOperation" style="color:green">
                    <p>'.$operation->getMontant().$operation->getDevise().'</p>
                    </div>';
              }
              $script.='<div class="bloc-btnModifSupprimer">
                    <div class="btnModifSupprimer"><a href="../compte/ModifTristan.php" class="btnModif"><img src="../../images/edit.png" width="32px"></a></div>
                    <div class="btnModifSupprimer"><a onclick= "return confirm(\'Êtes-vous sûr de bien vouloir supprimer cette opérations ?\');" href="../historique/historique_operations.php?action=del&id='.$id.'&idoperation='.$operation->getId().'" class="btnSupprimer"><img src="../../images/delete.png" width="32px"></a></div>
                    </div>
                    </div>
                    </div>';
            }
            print($script);
        ?>
      </div>
    </div>
  </div>
                
        <!-- FOOTER -->
        <?php include_once("../../inclusions/footer.php"); ?>
    </body>
</html>
<!-- ICI SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    // Coloriser l'onglet quand on est sur la page, je rajoute "selected" à la classe pour ne pas avoir de bug avec le "onmouseover"
    $(document).ready(function(){
        $('.navAPPli2').addClass('selected');
        $('.navAPPli2').css('background-color', '#F22C62');
        $('.navAPPli2').css('cursor', 'pointer');
        $('.navAPPli2').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli2').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli2').css('text-shadow', '#000 2px 2px 2px');
    });

    window.onload=function(){
      var btnCompte=document.getElementById('btnCompte');
      btnCompte.style.backgroundColor='lightblue';
      btnCompte.style.borderRight='none';
    }
    
</script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
