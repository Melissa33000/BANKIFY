<?php
  session_start();
  $_SESSION['id'] = 3;

  include_once("../../inclusions/connectDB.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Modifier opération </title>
        <?php include("../../inclusions/head.php"); ?>
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
            <h1>Modification d'une opération</h1>
          </header>
          <?php
          if  (!empty($_GET)){
            $id = isset($_GET['id'])?$_GET['id']:0;
            if(!empty($_POST)){
              $nom = $_POST['NomOp'];
              $montant = $_POST['MontantOp'];
              $date = $_POST['date'];
              $libFreq = $_POST['libFreq'];
              $libMoyPai = $_POST['libMoyPai'];
              $nomTiers = $_POST['nomTiers'];
              $SQLQuery = 'UPDATE operation';
              $SQLQuery.= ' INNER JOIN tiers ON operation.id_tiers = tiers.id ';
              $SQLQuery.= ' INNER JOIN frequence ON operation.id_frequence = frequence.id ';
              $SQLQuery.= ' INNER JOIN payer ON operation.id = payer.id_operation ';
              $SQLQuery.= ' INNER JOIN moyen_paiement ON moyen_paiement.id = payer.id_moyen_paiement ';
              $SQLQuery .= 'SET operation.nom = :nom, montant = :montant, date = :date , id_frequence = (SELECT id FROM frequence WHERE libelle = :libFreq) , id_tiers = (SELECT id FROM tiers WHERE nom = :nomTiers) , payer.id_moyen_paiement = :libMoyPai ';
              $SQLQuery .= 'WHERE operation.id = :id';
              $SQLStatement = $db->prepare($SQLQuery);
              $SQLStatement->bindValue(':id', $id);
              $SQLStatement->bindValue(':nom', $nom);
              $SQLStatement->bindValue(':montant', $montant);
              $SQLStatement->bindValue(':date', $date);
              $SQLStatement->bindValue(':libFreq', $libFreq);
              $SQLStatement->bindValue(':nomTiers', $nomTiers);
              $SQLStatement->bindValue(':libMoyPai', $libMoyPai);
              if($SQLStatement->execute()){
              print('<script type="text/javascript">document.location.href="historique_global.php";</script>');
            }else{
              print("Erreur d'éxécution de la requête d'insert !<br />");
            }
            $SQLStatement->closeCursor();
          }else{
            $SQLQuery = 'SELECT operation.nom, operation.montant, operation.date, frequence.libelle as libFreq, moyen_paiement.libelle as libMoyPai, tiers.nom as nomTiers, categorie.libelle AS libSousCat, operation.id_categorie, (SELECT id_categorie FROM categorie WHERE id = operation.id_categorie) AS idCatS, (SELECT libelle FROM categorie WHERE id = idCatS) AS libCatS FROM operation';
            $SQLQuery.= ' LEFT OUTER JOIN tiers ON operation.id_tiers = tiers.id ';
            $SQLQuery.= ' INNER JOIN frequence ON operation.id_frequence = frequence.id ';
            $SQLQuery.= ' INNER JOIN payer ON operation.id = payer.id_operation ';
            $SQLQuery.= ' INNER JOIN moyen_paiement ON moyen_paiement.id = payer.id_moyen_paiement ';
            $SQLQuery.= ' LEFT OUTER JOIN categorie ON categorie.id = operation.id_categorie ';
            $SQLQuery.= 'WHERE operation.id='.$_GET['id'];
            $SQLResult = $db->query($SQLQuery);
            if($SQLRow = $SQLResult->fetchobject()){
              $nom = $SQLRow->nom;
              $montant = $SQLRow->montant;
              $date = $SQLRow->date;
              $frequenceSelect = $SQLRow->libFreq;
              $moyenPaiementSelect = $SQLRow->libMoyPai;
              $nomTiersSelect = $SQLRow->nomTiers;
              $libCatSSelect = $SQLRow->libCatS;
              $libSousCatSelect = $SQLRow->libSousCat;
            }
            $SQLResult->closeCursor();
          }
            
        }
          ?>
          <div class="Formulaire">
            <form method="POST" actions="">
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Nom de l'opération :</label> </div>
                <div class="champ" ><input class = "resize" id="NomOp" type="text" name="NomOp" placeholder="Nom de l'opération .." value="<?php print($nom) ?>"></div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Montant :</label> </div>
                <div class="champ" > <input class = "resize"id="MontantOp" type="text" name="MontantOp" placeholder="Nom de l'opération .." value="<?php print($montant) ?>"></div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Date :</label> </div>
                <div class="champ" ><input class = "resize" id="date" type="date" name="date" value="<?php print($date) ?>"></div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Fréquence :</label> </div>
                <div class="champ" width="70%" > 
                  <select id='freq' name="libFreq">
                    <?php
                      $SQLQuery = 'SELECT libelle FROM frequence';
                      $SQLResult = $db->query($SQLQuery);
                      $script = "";
                      while($SQLRow=$SQLResult->fetchobject()){
                        $frequence = $SQLRow->libelle;
                        if($frequenceSelect == $frequence){
                          $script .= '<option selected>'.$frequence.'</option>';
                        }else{
                          $script .= '<option>'.$frequence.'</option>';
                        }
                      }
                      echo $script;
                      $SQLResult->closecursor();
                    ?>
                  </select>
                </div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Moyen de paiement :</label> </div>
                <div class="champ" width="70%" > 
                  <select id='moyenPaiement' name="libMoyPai">
                    <?php
                      $SQLQuery = 'SELECT id, libelle FROM moyen_paiement';
                      $SQLResult = $db->query($SQLQuery);
                      $script = "";
                      while($SQLRow=$SQLResult->fetchobject()){
                        $moyen_paiement = $SQLRow->libelle;
                        $id = $SQLRow->id;
                        if($moyenPaiementSelect == $moyen_paiement){
                          $script .= '<option value ="'.$id.'" selected>'.$moyen_paiement.'</option>';
                        }else{
                          $script .= '<option value ="'.$id.'">'.$moyen_paiement.'</option>';
                        }
                      }
                      echo $script;
                      $SQLResult->closecursor();
                    ?>
                  </select>
                </div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Tiers :</label></div>
                <div class="champ" width="70%" > 
                  <select id='Tiers' name="nomTiers">
                    <?php
                      $SQLQuery = 'SELECT nom FROM tiers';
                      $SQLResult = $db->query($SQLQuery);
                      $script = "";
                      while($SQLRow=$SQLResult->fetchobject()){
                        $tiers = $SQLRow->nom;
                        if ($nomTiersSelect == $tiers) {
                          $script .= '<option selected>'.$tiers.'</option>';
                        }else{
                          $script .= '<option>'.$tiers.'</option>';
                        }
                      }
                      echo $script;
                      $SQLResult->closecursor();
                    ?>
                  </select>                                        
                </div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Catégorie :</label></div>
                <div class="champ" width="70%" > 
                  <select id='categorie'>
                    
                    <?php
                      $SQLQuery = 'SELECT id, libelle FROM categorie WHERE id BETWEEN 1 AND 16 OR id>10000';
                      $SQLQuery.= ' ORDER BY libelle';
                      $SQLResult = $db->query($SQLQuery);
                      $script = "";
                      while($SQLRow=$SQLResult->fetchobject()){
                        $categorie = $SQLRow->libelle;
                        $id = $SQLRow->id;
                        if($libCatSSelect == $categorie || $libSousCatSelect == $categorie){
                          $script .= '<option class="opt-cat" data-id ='.$id.' selected>'.$categorie.'</option>';
                        }else{
                          $script .= '<option class="opt-cat" data-id ='.$id.'>'.$categorie.'</option>';
                        }
                      }
                      echo $script;
                      $SQLResult->closecursor();
                    ?>
                  </select>
                </div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Sous-Catégorie :</label></div>
                <div class="champ" width="70%" > 
                  <select id='sousCat'>
                    <option>-----</option>
                    
                  </select>
                </div>
              </div>
              <div id="button">
                <div class="btnValider">
                  <input id="addbuttonV" type="submit"  value="Valider">
                </div>
                <div class="btnAnnuler">
                  <input id="addbuttonA" type="button" value="Annuler" onclick="window.location.href='historique_global.php'" />
                </div>
              </div>
            </form>
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

    // XHR Requete
    function getXhrReq(){
        var xhr;
        if(window.XMLHttpRequest)
          xhr = new XMLHttpRequest();
        else
          xhr = new ActiveXObject("Microsoft.XMLHTTP");
        return xhr;
      }

      // Actualiser combobox sous-categorie en fonction de la categorie choisie
      $('.opt-cat').on("click",function(){
        xhr = getXhrReq();
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4){
            var obj = JSON.parse(xhr.responseText);
            script = '';
            $('#sousCat option').remove();
            $.each(obj, function(index, valeur){
              script += '<option>'+obj[index].libelle+'</option>';
            });
            $('#sousCat').append(script);

          }
        }
        
        var data = "idcat="+$(this).data('id');
        xhr.open('POST', '../../inclusions/api.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        xhr.send(data);
      });

  </script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
