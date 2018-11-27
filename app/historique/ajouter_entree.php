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
                <?php

            $bdd = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
            if (!empty($_POST)){
                $nom = $_POST['NomOp'];

                    
                    

                  if ($SQLStatement->execute()){
                        print('<script type="text/javascript">document.location.href=\'ajouter_entree.php\';</script>');
                    }else{
                        print("Erreur d'exécution de la requête d'insertion !<br />");
                        var_dump($SQLStatement->errorInfo());
                    }
                }else{
                    $nom = '';
                    $prenom = '';
                }
         ?>
    <form method="POST" actions="" onsubmit="return verif()">
         
    <div class="Formulaire">
      <div class="fieldset">
            <div class="galère">
            <div class="nomchamp" > <label>Nom de l'opération :</label> </div>
            <div class="champ" > <input class = "resize" id="NomOp" type="text"  name="NomOp" placeholder="Nom de l'opération .."> </div>
          </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Montant :</label> </div>
                  <div class="champ" > <input class = "resize"id="MontantOp" type="text"  name="MontantOp" placeholder="Nom de l'opération .."> </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Date :</label> </div>
                  <div class="champ" > <input class = "resize" id="date" type="date"  name="date"> </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Fréquence :</label> </div>
               <div class="champ" width="70%" > 
                     <SELECT id='freq' onchange='myfunction()'>
                           <?php
                           $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                           $query = 'SELECT libelle FROM frequence';
                           $result = $conn->query($query);
                           $script = "";
                           while($row=$result->fetchobject()){
                              $frequence = $row->libelle;
                              $script .= '<option>'.$frequence.'</option>';
                           }
                           echo $script;
                           $result->closecursor();
                           

                           ?>
                     </SELECT>
                  </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Moyen de paiement :</label> </div>
               <div class="champ" width="70%" > 
                     <SELECT id='moyenPaiement' onchange='myfunction()'>
                           <?php
                           $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                           $query = 'SELECT libelle FROM moyen_paiement';
                           $result = $conn->query($query);
                           $script = "";
                           while($row=$result->fetchobject()){
                              $moyen_paiement = $row->libelle;
                              $script .= '<option>'.$moyen_paiement.'</option>';
                           }
                           echo $script;
                           $result->closecursor();
                           

                           ?>
                     </SELECT>
                  </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Tiers :</label> </div>
               <div class="champ" width="70%" > 
                     <SELECT id='Tiers' onchange='myfunction()'>
                           <?php
                           $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                           $query = 'SELECT nom FROM tiers';
                           $result = $conn->query($query);
                           $script = "";
                           while($row=$result->fetchobject()){
                              $tiers = $row->nom;
                              $script .= '<option>'.$tiers.'</option>';
                           }
                           echo $script;
                           $result->closecursor();
                           

                           ?>
                     </SELECT>
                  </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Catégorie :</label> </div>
               <div class="champ" width="70%" > 
                     <SELECT id='Tiers' onchange='myfunction()'>
                           <?php
                           $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                           $query = 'SELECT libelle FROM categorie WHERE id_categorie is null AND id < 10000';
                           $result = $conn->query($query);
                           $script = "";
                           while($row=$result->fetchobject()){
                              $categorie = $row->libelle;
                              $script .= '<option>'.$categorie.'</option>';
                           }
                           echo $script;
                           $result->closecursor();
                           

                           ?>
                     </SELECT>
                  </div>
               </div>
               <div class="galère">
                  <div class="nomchamp" > <label>Sous-Catégorie :</label> </div>
               <div class="champ" width="70%" > 
                     <SELECT id='sousCat' onchange='myfunction()'>
                           <?php
                           $conn = new PDO("mysql:host=localhost;charset=utf8;dbname=bankify;port=3307",'root','root');
                           $query = 'SELECT id, libelle FROM categorie WHERE id_categorie is not null AND id_categorie < 10000';
                           $result = $conn->query($query);
                           $script = "";
                           while($row=$result->fetchobject()){
                              $categorie = $row->libelle;
                              $script .= '<option>'.$categorie.'</option>';
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

    function myFunction() {
        var x = document.getElementById("Selection").value;
 
      }

      function verif(){
               var ttNomOp = document.getElementById("NomOp");
               var ttMontantOp = document.getElementById("MontantOp");
      
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
