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
    <title> Ajout d'une entrée </title>
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
            <h1>Ajout d'une entrée</h1>
        </header>
      <form method="POST" actions="" onsubmit="return verif()">
        <?php
          if (!empty($_POST)){
            $nom = $_POST['nom'];
            $montant = $_POST['montant'];
            $date = $_POST['date'];
            $infosup = '';
            $tiers = $_POST['tiers'];
            $frequence = $_POST['frequence'];
            $idcompte = 2;
            $idMoyenPaiement = $_POST['moyenPaiement'];
            $idCategorie = $_POST['categorie'];
            $SQLQuery = 'CALL proc_addEntree(:nom, :montant , :date, :infosup , :tiers , :frequence, :idcompte , :idMoyenPaiement, :idCategorie)';
            $SQLStatement = $db->prepare($SQLQuery);
            $SQLStatement->bindValue(':nom' , $nom);
            $SQLStatement->bindValue(':montant' , $montant);
            $SQLStatement->bindValue(':date' , $date);
            $SQLStatement->bindValue(':infosup' , $infosup);
            $SQLStatement->bindValue(':tiers' , $tiers);
            $SQLStatement->bindValue(':frequence' , $frequence);
            $SQLStatement->bindValue(':idcompte' , $idcompte);
            $SQLStatement->bindValue(':idMoyenPaiement' , $idMoyenPaiement);
            $SQLStatement->bindValue(':idCategorie' , $idCategorie);
          if ($SQLStatement->execute()){
            print('<script type="text/javascript">document.location.href=\'Accueil.php\';</script>');
            }else{
              print("Erreur d'exécution de la requête d'insertion !<br />");
              var_dump($SQLStatement->errorInfo());
            }
          }

        ?>     
        <div class="Formulaire">
          <div class="fieldset">
            <div class="ligneChamp">
            <div class="nomchamp" > <label>Nom de l'opération :</label> </div>
            <div class="champ" > <input class = "resize" id="nom" type="text"  name="nom" placeholder="Nom de l'opération .." onblur="verifnom(this)"> </div>
          </div>
            <div class="ligneChamp">
              <div class="nomchamp" > <label>Montant :</label> </div>
              <div class="champ" > <input class = "resize"id="montant" type="text"  name="montant" placeholder="Nom de l'opération .."> 
              </div>
            </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Date :</label> </div>
                <div class="champ" > <input class = "resize" id="date" type="date"  name="date"> </div>
              </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label>Fréquence :</label> </div>
              <div class="champ" width="70%" > 
                <select id='frequence' name='frequence'>
                  <?php
                    $query = 'SELECT libelle FROM frequence';
                    $result = $db->query($query);
                    $script = "";
                    while($row=$result->fetchobject()){
                      $frequence = $row->libelle;
                      $script .= '<option>'.$frequence.'</option>';
                    }
                    echo $script;
                    $result->closecursor();
                  ?>
                </select>
              </div>
              </div>
                <div class="ligneChamp">
                  <div class="nomchamp" > <label>Moyen de paiement :</label> </div>
                  <div class="champ" width="70%" > 
                    <select id='moyenPaiement' name='moyenPaiement' >
                      <?php 
                        $query = 'SELECT id,libelle FROM moyen_paiement';
                        $result = $db->query($query);
                        $script = "";
                        while($row=$result->fetchobject()){
                          $moyen_paiement = $row->libelle;
                          $id = $row->id;
                          $script .= '<option value="'.$id.'">'.$moyen_paiement.'</option>';
                        }
                        echo $script;
                        $result->closecursor();
                      ?>
                    </select>
                  </div>
                </div>
                <div class="ligneChamp">
                  <div class="nomchamp" > <label>Tiers :</label> </div>
                    <div class="champ" width="70%" > 
                      <select id='tiers' name="tiers">
                        <?php
                          $query = 'SELECT nom FROM tiers';
                          $result = $db->query($query);
                          $script = "";
                          while($row=$result->fetchobject()){
                            $tiers = $row->nom;
                            $script .= '<option>'.$tiers.'</option>';
                          }
                          echo $script;
                          $result->closecursor();
                        ?>
                     </select>
                    </div>
                </div>
                <div class="ligneChamp">
                  <div class="nomchamp" > <label>Catégorie :</label> </div>
                <div class="champ" width="70%" > 
                  <select id='categorie' name="categorie">
                    <?php
                      $query = 'SELECT id, libelle FROM categorie WHERE id_categorie is null AND id < 10000';
                      $result = db->query($query);
                      $script = "";
                      while($row=$result->fetchobject()){
                        $categorie = $row->libelle;
                        $id = $row->id;
                        $script .= '<option class="opt-cat" data-id ="'.$id.'" value="'.$id.'" >'.$categorie.'</option>';
                      }
                      echo $script;
                      $result->closecursor();
                    ?>
                  </select>
                </div>
                </div>
              <div class="ligneChamp">
                 <div class="nomchamp" > <label>Sous-Catégorie :</label> </div>
              <div class="champ" width="70%" > 
                <select id='sousCat'>
                  <option>-----</option>
                </select>
              </div>
              </div>
              <div id="button">
                <input id="addbuttonV" type="submit" value="Valider" >
                <input id="addbuttonA" type="button" value="Annuler" onclick="window.location.href='Accueil.php'" />
              </div>
               </div>
                </div>
    </form>
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
      $('.navAPPli3').addClass('selected');
      $('.navAPPli3').css('background-color', '#BA44AC');
      $('.navAPPli3').css('cursor', 'pointer');
      $('.navAPPli3').css('box-shadow', '5px 5px 5px black');
      $('.navAPPli3').css('box-shadow', '5px 0px 3px black');
      $('.navAPPli3').css('text-shadow', '#000 2px 2px 2px');
    });

      function verif(){
        var ttNomOp = document.getElementById("nom");
        var ttMontantOp = document.getElementById("montant");
        var ttDate = document.getElementById("date");
        if (!estRemplie(ttNomOp)){
          alert("Un nom d'opération est nécessaire pour continuer l'ajout d'une entrée !");
          ttNomOp.focus();
          return false;
        }
        if (!estRemplie(ttMontantOp)){
           alert("Vous devez ajouter le montant de votre opération !");
           ttMontantOp.focus();
           return false;
        }
        if (!estRemplie(ttDate)){
          alert("Vous devez renseigner une date pour continuer l'ajout d'une entrée !");
          ttDate.focus();
          return false;
        }
        return true;
        }
        document.getElementsByTagName('form')[0].onsubmit=function (){
           return verif();
        }
      function estRemplie(champ){
        if(champ.value.trim()==''){
          champ.style.borderColor='red';
            champ.focus();
          return false;
        }else{
          champ.style.borderColor='initial';
          return true;
        }
      }

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
          console.log(data);
          xhr.open('POST', '../../inclusions/api.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
          xhr.send(data);
        });


    
</script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
