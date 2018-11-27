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
                    <h1>Historique global des opérations</h1>
                </header>
                <?php
  include_once 'operations.php';

  $SQLQuery = "SELECT operation.date, type_operation.libelle as typeOp, categorie.libelle as nomCat, compte.nom as nomCompte,  operation.nom as nomOp, operation.montant as montantOp, devise.symbole as symbDev FROM operation ";
  $SQLQuery.="INNER JOIN compte ON operation.id_compte=compte.id ";
  $SQLQuery.="INNER JOIN devise ON compte.id_devise=devise.id ";
  $SQLQuery.="INNER JOIN type_operation ON operation.id_type_operation=type_operation.id ";
  $SQLQuery.="INNER JOIN categorie ON operation.id_categorie=categorie.id ";
  $SQLQuery.="WHERE categorie.id BETWEEN 1 AND 16 OR 10001 AND 10015 ";
  $SQLQuery.="ORDER BY operation.date DESC";
  $result = $db->query($SQLQuery);
  while($row = $result->fetchobject()){
            /*print_r($row) ;*/
            $tabOperations[] = new Operation($row->date, $row->typeOp, $row->nomCat, $row->nomCompte, $row->nomOp, $row->montantOp, $row->symbDev);
  }
  $result->closecursor();
?>

  <body>
    <div class="main2">
      <div class="entete">
        <div class="bloc-chgGlobCompt">
          <a><input type="button" class="bouton-chgGlobCompt" id="btnGlobal" value="Global"></a>
          <a href="inspection_Compte.php"><input type="button" class="bouton-chgGlobCompt" id="btnCompte" value="Compte"></a>
        </div>
        <div class="searchBarHistGlob">
          <input type="search" placeholder="Rechercher...">
          <button type="submit" class="btnSearch"><span class="icon"><i class="fa-fa-search"></i></span></button>
        </div>
      </div>
      <div class="bloc-historiqueGlobal">
        <?php 
            $script='';
            $ancienneDate = '';
            foreach ($tabOperations as $operation){
              if ($ancienneDate != $operation->getJour().$operation->getMois().$operation->getAnnee()){

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
                      <div class="btnModifSupprimer"><a href="../historique/historique_global.php" class="btnSupprimer"><img src="../../images/delete.png" width="32px"></a></div>
                      </div>
                      </div>
                      </div>';
                      $ancienneDate = $operation->getJour().$operation->getMois().$operation->getAnnee();
                }else{
                  $script.='<div class="bloc-operation">';
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
                      <div class="btnModifSupprimer"><a href="../compte/ModifierCompte.html" class="btnModif"><img src="../../images/edit.png" width="32px"></a></div>
                      <div class="btnModifSupprimer"><a href="../historique/historique_global.php" class="btnSupprimer"><img src="../../images/delete.png" width="32px"></a></div>
                      </div>
                      </div>
                      </div>';
                      $ancienneDate = '';

                }
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
      var btnGlobal=document.getElementById('btnGlobal');
      btnGlobal.style.backgroundColor='lightblue';
      btnGlobal.style.borderRight='none';
    }
    
</script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
