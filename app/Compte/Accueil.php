<?php
session_start();
$_SESSION['id'] = 1;
include_once("../../inclusions/connectDB.php");
include_once('Compte.php');
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
    <title> Accueil </title>
    <?php include("../../inclusions/head.php"); ?>
    <link href="../../css/style_sirika.css" rel="stylesheet">
    <link href="../../css/style_Aurélien.css" rel="stylesheet">
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
                <h1>Accueil</h1>
            </header>
            <?php
              $query = "SELECT compte.numero as numero ,compte.nom as nom_compte,compte.solde_initial, compte.solde_initial + sum(montant) as solde_actuel ,devise.symbole as symbDev , compte.id as id FROM compte ";
              $query .="LEFT OUTER JOIN devise ON compte.id_devise = devise.id ";
              $query .="LEFT OUTER JOIN utilisateur ON compte.id_utilisateur = utilisateur.id ";
              $query .="LEFT OUTER JOIN operation ON compte.id = operation.id_compte ";
              $query .="WHERE utilisateur.id=".$_SESSION['id'];
              $query .=" group by compte.id";
              $result=$db->query($query);
              while($row=$result->fetchobject()){
                $tabComptes[]=new Compte($row->numero, $row->nom_compte,$row->solde_initial, $row->solde_actuel, $row->symbDev, $row->id);
              }
              $result->closeCursor();
              if (isset($_GET['id']) AND !empty($_GET)){
                $id = $_GET['id'];
                if ($id > 0){
                  $SQLQuery = "DELETE FROM compte WHERE id = :id";
                  try{
                    $SQLStatement=$db->prepare($SQLQuery);
                    $SQLStatement->bindValue(':id', $id);
                    if ($SQLStatement->execute()){
                      print('<script type="text/javascript">document.location.href="Accueil.php";</script>');
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
        <?php 
          $script='';
            foreach ($tabComptes as $key=>$Compte){
              $script .='<div class="ligneCompte"><div><label class="switch"><input type="checkbox" checked><span class="slider round"></span></div>';
              $script .='<div class="NomCompte">'.$Compte->getNom_compte().'</div>';
              if ($Compte->getNumero()!= ''){
                $script .='<div class="numero">N°'.$Compte->getNumero().'</div>';
              }else{
                $script .='<div class="numero"> N/C </div>';
              }
              if ($Compte->getSolde_actuel()!= null){
                if ($Compte->getSolde_actuel()<0){
                  $script .='<div class="SoldeInitial" name="Solde" style="color:red;" >'.$Compte->getSolde_actuel().$Compte->getSymbole_Devise().'</div>';
                }else{
                  $script .='<div class="SoldeInitial" name="Solde" style="color:green;" >'.$Compte->getSolde_actuel().$Compte->getSymbole_Devise().'</div>';
                }
              }else{
                if ($Compte->getSolde_initial()<0){
                $script .='<div class="SoldeInitial" name="Solde" style="color:red;" >'.$Compte->getSolde_initial().$Compte->getSymbole_Devise().'</div>';
              }else{
                $script .='<div class="SoldeInitial" name="Solde" style="color:green;" >'.$Compte->getSolde_initial().$Compte->getSymbole_Devise().'</div>';
              }
              }
              $script .='<div class="Icones">
                <a href ="ajouter_entree.php?id='.$Compte->getId().'"><img src="../../images/transactions.png" alt="Modifier" ></a>
                <a href ="ajouter_sortie.php?id='.$Compte->getId().'"><img src="../../images/transactions1.png" alt="Modifier" ></a>
                <a href ="ModifierCompte.php?id='.$Compte->getId().'"><img src="../../images/edit.png" alt="Modifier" ></a>
                <a onclick= "return confirm(\'Êtes-vous sûr de vouloir supprimer ce compte ?\');" href="Accueil.php?id='.$Compte->getId().'"><img src="../../images/delete.png" alt="Suppression" ></a>
                </div></div>';
            }
            print($script);
        ?>
        </div>
          <div id="gotoadd" > 
            <input id="buttonaddaccount" type="button" value="+ Ajouter un compte" onclick="window.location.href='AjouterCompte.php'" />
          </div>   
          </section> 
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
      $('.navAPPli1').addClass('selected');
      $('.navAPPli1').css('background-color', '#FD3F4F');
      $('.navAPPli1').css('cursor', 'pointer');
      $('.navAPPli1').css('box-shadow', '5px 5px 5px black');
      $('.navAPPli1').css('box-shadow', '5px 0px 3px black');
      $('.navAPPli1').css('text-shadow', '#000 2px 2px 2px');
  });
</script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
