<?php
    session_start();
    $_SESSION['id'] = 3;
    
    include_once("../../inclusions/connectDB.php");

    include_once 'operations.php';

    $id = isset($_SESSION['id'])?$_SESSION['id']:0;
    $SQLQuery = "SELECT operation.date, type_operation.libelle as typeOp, categorie.libelle as nomCat, compte.nom as nomCompte,  operation.nom as nomOp, operation.montant as montantOp, devise.symbole as symbDev, operation.id FROM operation ";
    $SQLQuery.="INNER JOIN compte ON operation.id_compte=compte.id ";
    $SQLQuery.="INNER JOIN devise ON compte.id_devise=devise.id ";
    $SQLQuery.="INNER JOIN type_operation ON operation.id_type_operation=type_operation.id ";
    $SQLQuery.="INNER JOIN categorie ON operation.id_categorie=categorie.id ";
    $SQLQuery.="INNER JOIN utilisateur ON utilisateur.id = compte.id_utilisateur ";
    $SQLQuery.="WHERE categorie.id BETWEEN 1 AND 16 OR 10001 AND 10015 AND utilisateur.id=".$_SESSION['id'];
    $SQLQuery.=" ORDER BY operation.date DESC";
    $SQLResult = $db->query($SQLQuery);
    while($SQLRow = $SQLResult->fetchobject()){
        /*print_r($row) ;*/
        $tabOperations[] = new Operation($SQLRow->date, $SQLRow->typeOp, $SQLRow->nomCat, $SQLRow->nomCompte, $SQLRow->nomOp, $SQLRow->montantOp,
                                        $SQLRow->symbDev, $SQLRow->id);
    }
    $SQLResult->closecursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Historique global</title>
        <?php include("../../inclusions/head.php"); ?>
        <meta charset="utf-8">
        <link href="../../css/style_sirika.css" rel="stylesheet">
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
                    <h1>Historique Global des opérations</h1>
                </header>
                <div class="main">
                    <div id="entete">
                        <div id="bloc-chgGlobCompt">
                            <a><input type="button" class="bouton-chgGlobCompt" id="btnGlobal" value="Global"></a>
                            <a href="historique_operations.php"><input type="button" class="bouton-chgGlobCompt" id="btnCompte" value="Compte"></a>
                        </div>
                        <div class="bloc-rechercheHG">
                            <form method="GET" class="searchBarHistGlob">
                                <input type="search" placeholder="Rechercher..."><button type="submit" class="btnSearch"><span class="icon"><i class="fa fa-search"></i></span></button>
                            </form>
                        </div>
                    </div>
                    <div class="bloc-historiqueGlobal">
                        <?php 
                            // Création des lignes des opérations
                            $script='';
                            $ancienneDate = '';
                            foreach ($tabOperations as $operation){
                                if($ancienneDate != $operation->getJour().$operation->getMois().$operation->getAnnee()){
                                    $script.='<div class="bloc-operation">
                                                    <div class="bandeauDate">
                                                    <div class="nbJour"><p>'.$operation->getJour().'</p></div>';
                                    $script.='  <div class="nbMois"><p>'.$operation->getMois().'</p></div>';
                                    $script.='  <div class="nbAnnee"><p>'.$operation->getAnnee().'</p></div></div>';
                                    $script.='<div data-id="'.$operation->getId().'" class="bandeauOperation">
                                                    <div class="logoOperation">';
                                    if($operation->getType()=='Entrée'){
                                        $script.='<div class="logoTypeOperation"><img src="../../images/transactions.png" width="32px" ></div></div>';
                                    }else{
                                        $script.='<div class="logoTypeOperation"><img src="../../images/transactions(1).png" width="32px" ></div></div>';
                                    }
                                    $script.='<div class="nomCompte">
                                                <p>'.$operation->getNomCompte().'</p>
                                                 </div>';
                                     $script.='<div class="montantOperation">
                                                <p>'.$operation->getMontant().$operation->getDevise().'</p>
                                                </div>';
                                    $script.='<div class="bloc-btnModifSupprimer">
                                                <div class="btnModifSupprimer"><a href="modifier_operation.php?id='.$operation->getId().'" class="btnModif"><img src="../../images/edit.png" width="32px"></a></div>
                                                <div class="btnModifSupprimer"><a href="historique_global.php?id='.$operation->getId().'" class="btnSupprimer" onclick=" return confirm(\'Êtes-vous sur ?\');"><img src="../../images/delete.png" width="32px"></a></div>
                                                </div>
                                                </div>
                                                </div>';
                                    $ancienneDate = $operation->getJour().$operation->getMois().$operation->getAnnee();
                                }else{
                                    $script.='<div class="bloc-operation">';
                                    $script.='<div data-id="'.$operation->getId().'" class="bandeauOperation">
                                                <div class="logoOperation">';
                                    if($operation->getType()=='Entrée'){
                                        $script.='<div class="logoTypeOperation"><img src="../../images/transactions.png" width="32px" ></div></div>';
                                    }else{
                                        $script.='<div class="logoTypeOperation"><img src="../../images/transactions(1).png" width="32px" ></div></div>';
                                    }
                                    $script.='<div class="nomCompte">
                                                <p>'.$operation->getNomCompte().'</p>
                                                </div>';
                                    $script.='<div class="montantOperation">
                                                <p data-id="'.$operation->getId().'">'.$operation->getMontant().$operation->getDevise().'</p>
                                                </div>';
                                    $script.='<div class="bloc-btnModifSupprimer">
                                                <div class="btnModifSupprimer"><a href="modifier_operation.php?id='.$operation->getId().'" class="btnModif"><img src="../../images/edit.png" width="32px"></a></div>
                                                <div class="btnModifSupprimer"><a href="historique_global.php?id='.$operation->getId().'" class="btnSupprimer" onclick=" return confirm(\'Êtes-vous sur ?\');"><img src="../../images/delete.png" width="32px"></a></div>
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
            </section>
        </div>
        <!-- FOOTER -->
        <?php include_once("../../inclusions/footer.php"); ?>
    </body>
</html>
<!-- ICI SCRIPTS -->

<!-- SCRIPT PHP -->
<?php
    // SUpprimer une opération
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($id > 0){
            $SQLQuery = "CALL proc_deleteOperation(:id)";
            try{
                $SQLStatement = $db->prepare($SQLQuery);
                $SQLStatement->bindValue(':id', $id);

                if($SQLStatement->execute()){
                    print('<script type="text/javascript">document.location.href="historique_global.php";</script>');
                }else{
                    print("Erreur dans la requête de suppression !");
                    var_dump($SQLStatement->errorInfo());
                }
            }catch(PDOException $ex){
                print("Erreur dans la préparation de la requête de suppression !");
                print($ex->getMessage());
            }
        }
        $SQLResult->closecursor();
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    //Script pour modifier le bouton "Global" afin que l'utilsateur sache où il se trouve.
        window.onload=function(){
            var btnGlobal=document.getElementById('btnGlobal');
            btnGlobal.style.backgroundColor='lightblue';
            btnGlobal.style.borderRight='none';
        }

        //Script pour déterminer les couleur en fonction du signe du montant de l'opération
        $('.montantOperation').each(function(){
            if ($(this).text().trim().substring(0,1)  == "-"){
                $(this).css('color','red');
            }
            else{
                $(this).css('color','green');
            }
        });

    // Coloriser l'onglet quand on est sur la page, je rajoute "selected" à la classe pour ne pas avoir de bug avec le "onmouseover"
    $(document).ready(function(){
        $('.navAPPli2').addClass('selected');
        $('.navAPPli2').css('background-color', '#F22C62');
        $('.navAPPli2').css('cursor', 'pointer');
        $('.navAPPli2').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli2').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli2').css('text-shadow', '#000 2px 2px 2px');
    });

    // Afficher détail d'une opération par un clique sur la ligne
    var script = '';
    var idLigneClique = 0;
    $('.bandeauOperation').click(function(){
        if(idLigneClique == $(this).data('id')){
            idLigneClique = 0;
            $(this).css("background-color","initial");
            $('.detail-Op').remove();
        }else{
            $('.detail-Op').remove();
            $('.bandeauOperation[data-id='+idLigneClique+']').css("background-color","initial");
            idLigneClique = $(this).data('id');
            $(this).css("background-color","#7BA8E8");
            xhr = getXhrReq();
            xhr.onreadystatechange = function(){
              if(xhr.readyState == 4){
                var obj = JSON.parse(xhr.responseText);
                $.each(obj, function(index, valeur){
                    script = '<div class="detail-Op">';
                    script += '<div class="nom-Op"> <b>Description :</b> '+obj[index].nomOp+'</div>';
                    if(obj[index].nomTiers == null){
                        script += '<div class = "tiers-Op"> <b>Tiers : </b>N/C</div>';
                    }else{
                        script += '<div class = "tiers-Op"> <b>Tiers :</b> '+obj[index].nomTiers+'</div>';
                    }
                    script += '<div class = "cat-Op"> <b>Catégorie</b> : '+obj[index].libelleCat+'</div>';
                    script += '</div>';
                    
                });
                console.log(script);
                $('.bandeauOperation[data-id='+idLigneClique+']').parent().append(script);
              }
            }
        
            var data = "idOp="+$(this).data('id');
            xhr.open('POST', '../../inclusions/api.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
            xhr.send(data);
        }
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
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
