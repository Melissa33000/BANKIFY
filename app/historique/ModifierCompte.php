<?php
include_once("../../inclusions/connectDB.php");
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
        <title> Modifier opération </title>
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
            <h1>Modification d'une opération</h1>
          </header>
          <?php
          if  (!empty($_GET)){
            // je reçois qqche dans l'adresse
            $id = isset($_GET['id'])?$_GET['id']:0;
            $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
            if(!empty($_POST)){
              $nom = $_POST['NomOp'];
              $montant = $_POST['MontantOp'];
              $SQLQuery = 'UPDATE operation SET nom_client = :nom, prenom_client = :prenom WHERE id_client = :id';
              $SQLStatement = $conn->prepare($SQLQuery);
              $SQLStatement->bindValue(':id', $id);
              $SQLStatement->bindValue(':nom', $nom);
              $SQLStatement->bindValue(':prenom', $prenom);
            }else{
              $SQLQuery = 'SELECT *, frequence.libelle as libFreq, moyen_paiement.libelle as libMoyPai, tiers.nom as nomTiers FROM operation';
              $SQLQuery.= ' INNER JOIN tiers ON operation.id_tiers = tiers.id ';
              $SQLQuery.= ' INNER JOIN frequence ON operation.id_frequence = frequence.id ';
              $SQLQuery.= ' INNER JOIN payer ON operation.id = payer.id_operation ';
              $SQLQuery.= ' INNER JOIN moyen_paiement ON moyen_paiement.id = payer.id_moyen_paiement ';
              $SQLQuery.= 'WHERE operation.id='.$_GET['id'];
              $SQLResult = $conn->query($SQLQuery);
              if($SQLRow = $SQLResult->fetchobject()){
                $nom = $SQLRow->nom;
                $montant = $SQLRow->montant;
                $date = $SQLRow->date;
                $frequenceSelect = $SQLRow->libFreq;
                $moyenPaiementSelect = $SQLRow->libMoyPai;
                $nomTiersSelect = $SQLRow->nomTiers;
              }
            }
            $SQLResult->closeCursor();
          }
          ?>
          <form method="POST" actions="" onsubmit="return verif()">
            <div class="Formulaire">
              <div class="fieldset">
                <div class="galère">
                  <div class="nomchamp" > <label>Nom de l'opération :</label> </div>
                  <div class="champ" ><input class = "resize" id="NomOp" type="text" name="NomOp" placeholder="Nom de l'opération .." value="<?php print($nom) ?>"></div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Montant :</label> </div>
                  <div class="champ" > <input class = "resize"id="MontantOp" type="text" name="MontantOp" placeholder="Nom de l'opération .." value="<?php print($montant) ?>"></div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Date :</label> </div>
                  <div class="champ" ><input class = "resize" id="date" type="date" name="date" value="<?php print($date) ?>"></div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Fréquence :</label> </div>
                  <div class="champ" width="70%" > 
                    <select id='freq'>
                      <?php
                        $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                        $query = 'SELECT libelle FROM frequence';
                        $result = $conn->query($query);
                        $script = "";
                        while($row=$result->fetchobject()){
                          $frequence = $row->libelle;
                          if($frequenceSelect == $frequence){
                            $script .= '<option selected>'.$frequence.'</option>';
                          }else{
                            $script .= '<option>'.$frequence.'</option>';
                          }
                        }
                        echo $script;
                        $result->closecursor();
                      ?>
                    </select>
                  </div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Moyen de paiement :</label> </div>
                  <div class="champ" width="70%" > 
                    <select id='moyenPaiement'>
                      <?php
                        $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                        $query = 'SELECT libelle FROM moyen_paiement';
                        $result = $conn->query($query);
                        $script = "";
                        while($row=$result->fetchobject()){
                          $moyen_paiement = $row->libelle;
                          if($moyenPaiementSelect == $moyen_paiement){
                            $script .= '<option selected>'.$moyen_paiement.'</option>';
                          }else{
                            $script .= '<option>'.$moyen_paiement.'</option>';
                          }
                        }
                        echo $script;
                        $result->closecursor();
                      ?>
                    </select>
                  </div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Tiers :</label></div>
                  <div class="champ" width="70%" > 
                    <select id='Tiers'>
                      <?php
                        $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                        $query = 'SELECT nom FROM tiers';
                        $result = $conn->query($query);
                        $script = "";
                        while($row=$result->fetchobject()){
                          $tiers = $row->nom;
                          if ($nomTiersSelect == $tiers) {
                            $script .= '<option selected>'.$tiers.'</option>';
                          }else{
                            $script .= '<option>'.$tiers.'</option>';
                          }
                        }
                        echo $script;
                        $result->closecursor();
                      ?>
                      <input type="text" name="ttAjouterTiers" placeholder="Entrée le nom d'un(e) tiers">
                      <input type="submit" name="btnAjouterTiers" value="Ajouter">
                    </select>
                  </div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Catégorie :</label></div>
                  <div class="champ" width="70%" > 
                    <select id='categorie'>
                      <option class="opt-cat" data-id ="0">-----</option>
                      <?php
                        $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                        $query = 'SELECT id, libelle FROM categorie WHERE id BETWEEN 1 AND 16';
                        $query.= ' ORDER BY libelle';
                        $result = $conn->query($query);
                        $script = "";
                        while($row=$result->fetchobject()){
                          $categorie = $row->libelle;
                          $id = $row->id;
                          $script .= '<option class="opt-cat" data-id ='.$id.'>'.$categorie.'</option>';
                        }
                        echo $script;
                        $result->closecursor();
                      ?>
                    </select>
                  </div>
                </div>
                <div class="galère">
                  <div class="nomchamp" > <label>Sous-Catégorie :</label></div>
                  <div class="champ" width="70%" > 
                    <select id='sousCat'>
                      <option>-----</option>
                      
                    </select>
                  </div>
                </div>
                <div id="button">
                  <input id="addbuttonV" type="submit"  value="Valider" >
                  <input id="addbuttonA" type="button" value="Annuler" onclick="window.location.href='Accueil.php'" />
                </div>
              </div>
            </div>
          </form>
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
      $('.opt-cat').click(function(){
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
