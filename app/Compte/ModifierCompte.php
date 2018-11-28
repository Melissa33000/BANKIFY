<?php
  include_once("../../inclusions/connectDB.php");
  include_once('Compte.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Modification d'un compte </title>
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
              <h1>Modification de compte</h1>
          </header>
    <form method="POST" actions="">
      <?php
      if (!empty($_GET)){
        $id = isset($_GET['id'])?$_GET['id']:0;
        if (!empty($_POST)){
          $nom = $_POST['nom'];
          $numero  = $_POST['numero'];
          $SoldeInitial = $_POST['SoldeInitial'];
          $decouvert_max = $_POST['decouvert_max'];
          $SQLQuery = 'UPDATE compte SET compte.nom = :nom, compte.numero = :numero, compte.solde_Initial = :SoldeInitial, compte.decouvert_max = :decouvert_max WHERE id = :id';
          $SQLStatement = $db->prepare($SQLQuery);
          $SQLStatement->bindValue(':id', $id);
          $SQLStatement->bindValue(':nom', $nom);
          $SQLStatement->bindValue(':numero', $numero);
          $SQLStatement->bindValue(':SoldeInitial', $SoldeInitial);
          $SQLStatement->bindValue(':decouvert_max', $decouvert_max);
          if ($SQLStatement->execute()){
            print('<script type="text/javascript">document.location.href="Accueil.php";</script>');
          }else{
            print("Erreur d'exécution de la requête de modification !<br />");
            var_dump($SQLStatement->errorInfo());
          }
          $SQLStatement->closeCursor();  
        }else{
          $SQLQuery = 'SELECT * , type_compte.libelle as libelleTC, devise.libelle as libelleDev FROM compte';
          $SQLQuery .=' INNER JOIN type_compte ON compte.id_type_compte = type_compte.id ';
          $SQLQuery .=' INNER JOIN devise ON compte.id_devise = devise.id ';
          $SQLQuery .='WHERE compte.id = :id';
          $SQLStatement = $db->prepare($SQLQuery);
          $SQLStatement->bindValue(':id', $id);
          $SQLStatement->execute();
          if($SQLResult = $SQLStatement->fetchobject()){
            $nom = $SQLResult->nom;
            $numero = $SQLResult->numero;
            $SoldeInitial = $SQLResult->solde_initial;
            $decouvert_max = $SQLResult->decouvert_max;
            $type_compteSelect = $SQLResult->libelleTC;
            $deviseSelect = $SQLResult->libelleDev;
          }
          $SQLStatement->closeCursor();
        }
      }else{

      }
      ?>
    <div class="Formulaire">
      <div class="fieldset">
        <div class="ligneChamp">
          <div class="nomchamp" > <label>Nom du compte :</label> </div>
          <div class="champ" > <input class = "resize" type="text"  name="nom" placeholder="Nom de votre compte.." value ="<?php print($nom);?>"> 
          </div>
        </div>
          <div class="ligneChamp">
            <div class="nomchamp" > <label>Type de compte:</label> </div>
            <div class="champ" width="70%" > 
              <SELECT id='Selection'>
                <?php
                  $query = 'SELECT libelle FROM type_compte';
                  $result = $db->query($query);
                  $script = "";
                  while($row=$result->fetchobject()){
                    $libelle = $row->libelle;
                    if ($type_compteSelect == $libelle){
                      $script .= '<option selected>'.$libelle.'</option>';
                    }else{
                      $script .= '<option>'.$libelle.'</option>';
                    }
                  }
                  echo $script;
                  $result->closecursor();
                ?>
              </SELECT>
            </div>
          </div>
        <div class="ligneChamp">
          <div class="nomchamp" > <label>Numéro de compte :</label> </div>
          <div class="champ" > <input class = "resize" type="text" name="numero" placeholder="Numéro de votre compte.." value =" <?php if ($numero == ''){ print("N/C");}else{ print($numero);} ?>" > </div>
        </div>
        <div class="ligneChamp">
          <div class="nomchamp" > <label> Solde initial :</label> </div>
          <div class="champ" > <input class = "resize" type="text" name="SoldeInitial" placeholder="Insérer votre solde initial.." value ="<?php print($SoldeInitial) ?>"></div>
        </div>
        <div class="ligneChamp">
          <div class="nomchamp" > <label> Découvert autorisé :</label> </div>
          <div class="champ" > <input class = "resize" type="text" name="decouvert_max" placeholder="Votre découvert autorisé.." value ="<?php print($decouvert_max)?>"> </div>
        </div>
        <div class="ligneChamp">
          <div class="nomchamp" > <label> Devise:</label> </div>
          <div class="champ" > 
            <SELECT id='Selection'>
              <?php
                $query = 'SELECT libelle , symbole FROM Devise';
                $result = $db->query($query);
                $script = "";
                while($row=$result->fetchobject()){
                  $libelle_devise = $row->libelle;
                  $symbole_devise = $row->symbole;
                  if ($deviseSelect == $libelle){
                    $script .= '<option selected>'.$symbole_devise.' : '.$libelle_devise.'</option>';
                  }else{
                    $script .= '<option>'.$symbole_devise.' : '.$libelle_devise.'</option>';
                  }
                }
                echo $script;
                $result->closecursor();
              ?>
            </SELECT>
          </div>
        </div>
        <div id="button">
          <input id="addbuttonV" type="submit"  value="Valider" >
          <input id="addbuttonA" type="button" value="Annuler" onclick="window.location.href='Accueil.php'" />
        </div>
    </form>
      </div>
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
