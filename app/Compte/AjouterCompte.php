<?php
session_start();
$_SESSION['id'] = 2;
$_SESSION['nom'] = "Hilaire";
$_SESSION['prenom'] = "Sirika";

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
    <title> Ajout d'un compte </title>
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
            <h1>Ajouter un compte</h1>
          </header>
        <form method="POST" actions="" onsubmit="return verif()">
          <?php 
            $bdd = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
            if (!empty($_GET)){
              $id = isset($_GET['id'])?$_GET['id']:0;
            if (!empty($_POST)){
              $numero = $_POST['Numero'];
              $nom_compte  = $_POST['NomCompte'];
              $solde_initial = $_POST['SoldeInitial'];
              $decouvert_max = $_POST['decouvert_max']; 
              $etat = 1;
              $nom = $_SESSION['nom'];
              $prenom = $_SESSION['prenom'];
              $type_compte = $_POST['type_compte'];
              $isoDev = "Eur";
              $SQLQuery = 'UPDATE compte SET numero, nom_compte , solde_initial , decouvert_max, etat , nom, prenom, type_compte, iso';
              $SQLQuery .= ' INNER JOIN utilisateur ON compte.id = utilisateur.id';
              $SQLQuery .= ' INNER JOIN type_compte ON compte.id = type_compte.id';
              $SQLQuery .= ' INNER JOIN devise ON compte.id = devise.id';
              $SQLQuery .= ' WHERE id = :id';
              $SQLStatement = $bdd->prepare($SQLQuery);
              $SQLStatement->bindValue(':numero', $numero);
              $SQLStatement->bindValue(':nom_compte', $nom_compte);
              $SQLStatement->bindValue(':solde_initial', $solde_initial);
              $SQLStatement->bindValue(':decouvert_max', $decouvert_max);
              $SQLStatement->bindVAlue(':etat',$etat);
              $SQLStatement->bindVAlue(':nom',$nom);
              $SQLStatement->bindVAlue(':prenom',$prenom);
              $SQLStatement->bindVAlue(':type_compte',$type_compte);
              $SQLStatement->bindVAlue(':isoDev',$isoDev);
            if ($SQLStatement->execute()){
              print('<script type="text/javascript">document.location.href=\'Accueil.php\';</script>');
            }else{
              print("Erreur d'exécution de la requête de modification !<br />");
              var_dump($SQLStatement->errorInfo());
            }
            }else{
              $SQLQuery = 'SELECT * FROM compte WHERE compte.id = :id';
              $SQLStatement = $bdd->prepare($SQLQuery);
              $SQLStatement->bindValue(':id', $id);
              $SQLStatement->execute();
              $SQLResult = $SQLStatement->fetchobject();
              $numero = $SQLResult->numero;
              $nom_compte = $SQLResult->nom_compte;
              $solde_initial = $SQLResult->solde_initial;
              $decouvert_max = $SQLResult->decouvert_max;
              $SQLStatement->closeCursor();
            }
            }else{
            if (!empty($_POST)){
              $numero = $_POST['Numero'];
              $nom_compte  = $_POST['NomCompte'];
              $solde_initial = $_POST['SoldeInitial'];
              $decouvert_max = $_POST['decouvert_max']; 
              $etat = 1;
              $nom = $_SESSION['nom'];
              $prenom = $_SESSION['prenom'];
              $type_compte = $_POST['type_compte'];
              $isoDev = "Eur";
              $SQLQuery = 'CALL proc_addCompte(:numero,:nom_compte,:solde_initial,:decouvert_max,:etat,:nom,:prenom,:type_compte,:isoDev)';
              $SQLStatement = $bdd->prepare($SQLQuery);
              $SQLStatement->bindValue(':numero', $numero);
              $SQLStatement->bindValue(':nom_compte', $nom_compte);
              $SQLStatement->bindValue(':solde_initial', $solde_initial);
              $SQLStatement->bindValue(':decouvert_max', $decouvert_max);
              $SQLStatement->bindVAlue(':etat',$etat);
              $SQLStatement->bindVAlue(':nom',$nom);
              $SQLStatement->bindVAlue(':prenom',$prenom);
              $SQLStatement->bindVAlue(':type_compte',$type_compte);
              $SQLStatement->bindVAlue(':isoDev',$isoDev);
            if ($SQLStatement->execute()){
              print('<script type="text/javascript">document.location.href=\'Accueil.php\';</script>');
            }else{
              print("Erreur d'exécution de la requête d'insertion !<br />");
              var_dump($SQLStatement->errorInfo());
            }
            }else{
              $numero = '';
              $nom_compte = '';
              $solde_initial = '';
              $decouvert_max = '';
            }
            }
         ?>         
        <div class="Formulaire">
          <div class="fieldset">
            <div class="ligneChamp">
              <div class="nomchamp" > <label>Nom du compte :</label> </div>
              <div class="champ" > <input class = "resize" id="NomCompte" type="text"  name="NomCompte" placeholder="Nom de votre compte.."> 
              </div>
            </div>
            <div class="ligneChamp">
              <div class="nomchamp" > <label>Type de compte:</label> </div>
              <div class="champ" width="70%" > 
                <select id='Selection' name='type_compte' >
                  <?php
                  $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                  $query = 'SELECT libelle FROM type_compte';
                  $result = $conn->query($query);
                  $script = "";
                  while($row=$result->fetchobject()){
                    $libelle = $row->libelle;
                    $script .= '<option>'.$libelle.'</option>';
                  }
                  echo $script;
                  $result->closecursor();
                  ?>
                </select>
              </div>
            </div>
            <div class="ligneChamp">
              <div class="nomchamp" > <label>Numéro de compte :</label> </div>
              <div class="champ" > <input class = "resize" type="text" id="Numero" name="Numero" placeholder="Numéro de votre compte.."> </div>
            </div>
            <div class="ligneChamp">
              <div class="nomchamp" > <label> Solde initial :</label> </div>
              <div class="champ" > <input class = "resize" type="text" id="SoldeInitial" name="SoldeInitial" placeholder="Insérer votre solde initial.."></div>
            </div>
            <div class="ligneChamp">
              <div class="nomchamp" > <label> Découvert autorisé :</label> </div>
              <div class="champ" > <input class = "resize"  type="text" id="decouvert_max" name="decouvert_max" placeholder="Votre découvert autorisé.."> 
              </div>
            </div>
              <div class="ligneChamp">
                <div class="nomchamp" > <label> Devise:</label> </div>
                <div class="champ" > 
                  <SELECT id='Selection' name="isoDev">
                    <?php
                    $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                    $query = 'SELECT libelle , symbole FROM Devise';
                    $result = $conn->query($query);
                    $script = "";
                    while($row=$result->fetchobject()){
                      $libelle_devise = $row->libelle;
                      $symbole_devise = $row->symbole;
                      $script .= '<option>'.$symbole_devise.' : '.$libelle_devise.'</option>';
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
        $('.navAPPli1').addClass('selected');
        $('.navAPPli1').css('background-color', '#FD3F4F');
        $('.navAPPli1').css('cursor', 'pointer');
        $('.navAPPli1').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli1').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli1').css('text-shadow', '#000 2px 2px 2px');
    });

    function verif(){
      var ttNomCompte = document.getElementById("NomCompte");
      var ttNumCompte = document.getElementById("NumCompte");
      var ttSoldeInitial = document.getElementById("SoldeInitial");
      if (!estRemplie(ttNomCompte)){
         alert("Un nom de compte est nécessaire pour continuer l'ajout d'un compte !");
         ttNomCompte.focus();
         return false;
      }
      if (!estRemplie(ttSoldeInitial)){
        alert("Pour pouvoir ajouter un compte, vous devez saisir un solde de départ !");
        ttSoldeInitial.focus();
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
</script>
<script src="../../scripts/javascript.js" type="text/javascript">
</script>
