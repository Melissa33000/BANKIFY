<?php
session_start();
$_SESSION['id'] = 1;
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
      <title>Selection de compte</title>
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
                <h1>Liste des comptes</h1>
            </header>
            <body>
              <div class="entete">
                <div class="bloc-chgGlobCompt">
                  <a href="historique_global.php"><input type="button" class="bouton-chgGlobCompt" id="btnGlobal" value="Global"></a>
                  <a><input type="button" class="bouton-chgGlobCompt" id="btnCompte" value="Compte"></a>
                </div>
              </div>
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
      <div class="tab">
      <table>
        <tr>
          <th>Nom du Compte</th>
          <th>Solde</th>
        <tr>
      <?php 
        $script='';
        foreach ($tabComptes as $key=>$Compte){
          $script .='<tr>';
          $script .='<td>';
          $script .='<a class="compteClick" href="historique_operations.php?id='.$Compte->getId().'"><div class="clickableAccount">'.$Compte->getNom_compte().'</td>';
          if ($Compte->getSolde_actuel() != null){
            if ($Compte->getSolde_actuel()<0){
              $script .='<td><a class="compteClick" href="historique_operations.php?id='.$Compte->getId().'"><div class="SoldeInitial" name="Solde" style="color:red;" >'.$Compte->getSolde_actuel().$Compte->getSymbole_Devise().'</div></td>';
            }else{
              $script .='<td><a class="compteClick" href="historique_operations.php?id='.$Compte->getId().'"><div class="SoldeInitial" name="Solde" style="color:green;" >'.$Compte->getSolde_actuel().$Compte->getSymbole_Devise().'</div></td>';
            }
            $script .='</div>';
            $script .='</a>';
            $script .='</tr>';
          }else{
            if ($Compte->getSolde_initial()<0){
            $script .='<td><a class="compteClick" href="historique_operations.php?id='.$Compte->getId().'"><div class="SoldeInitial" name="Solde" style="color:red;" >'.$Compte->getSolde_initial().$Compte->getSymbole_Devise().'</div></td>';
            }else{
            $script .='<td><a class="compteClick" href="historique_operations.php?id='.$Compte->getId().'"><div class="SoldeInitial" name="Solde" style="color:green;" >'.$Compte->getSolde_initial().$Compte->getSymbole_Devise().'</div></td>';
            }
          }
        }
          print($script);

          $result->closeCursor();
      ?>
      </table>
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
