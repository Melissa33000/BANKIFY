<?php session_start() ?>
<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
include_once("../../inclusions/connectDB.php");
include_once("../../inclusions/fonctions.php");
$_SESSION['budget'] = $_SESSION['budget'];
if(!empty($_SESSION) AND isset($_SESSION['id']) AND !empty($_POST)){
    $id = $_SESSION['id'];
    $idCat = $_POST['idCat'];
    $idSousCat = $_POST['idSousCat'];
    if(!empty($_POST['date'])){
        $date = $_SESSION['date'] = $_POST['date'];
        $mois = date("m", strtotime($date));
        $annee = date("Y", strtotime($date));
    }else if(!empty($_SESSION['date'])){
        $date = $_SESSION['date'];
        $mois = date("m", strtotime($date));
        $annee = date("Y", strtotime($date));
    }else{
        $date = date("Y-m-d");
        $mois = date("m", strtotime($date));
        $annee = date("Y", strtotime($date));
    }
}else{
    header('location:../../index.php');
    exit;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Budget - Sous-catégorie</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>
    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet" class="backBudget">
                <!--<header id="headerAPPonglet" style="background-color: #BA44AC">
                    <h1 style="color: white">Budget</h1>
                </header>-->
                <div id="partieHaute2">
                    <div class="btn_app_budget">
                        <?php
                            // Attention ici c'est la 4ème dimension...le input est même pas refermé par "> sinon ça buggait et ça me l'affichait. A cet instant précis du code j'ai su que
                            // ça ne servait à rien de comprendre des choses xD J'aurais p-e pas du mélanger js et php aussi... En tout cas ça fonctionne haahaha !!
                            if($_SESSION['budget'] == "Dépenses"){
                                echo '<a href="sorties.php"><input type="button" value="Dépenses" id="btn_depenses" style="background-color: rgb(236,74,89)" onclick="<?php $_SESSION["budget"] = "Dépenses"; ?></a>';
                                echo '<a href="entrees.php"><input type="button" value="Revenus" id="btn_revenus" style="background-color: rgba(228,228,228,0.9)" onclick="<?php $_SESSION["budget"] = "Revenus"; ?></a>';
                            }else if($_SESSION['budget'] == "Revenus"){
                                echo '<a href="sorties.php"><input type="button" value="Dépenses" id="btn_depenses" style="background-color: rgba(228,228,228,0.9)" onclick="<?php $_SESSION["budget"] = "Dépenses"; ?></a>';
                                echo '<a href="entrees.php"><input type="button" value="Revenus" id="btn_revenus" style="background-color: rgb(126,188,187)" onclick="<?php $_SESSION["budget"] = "Revenus"; ?></a>';
                            }
                        ?>
                    </div>
                    <div id="rubanProvisoire">
                        <?php
                        if(isset($idCat)){
                            if($idCat < 10000){
                                echo '<div class="retour" id="retour"><img src="../../images/ico/before.png" alt="Revenir en arrière" title="Revenir en arrière" class="icoreturn"/></div>';
                            }else{
                                echo '<div class="retour"><a href="entrees.php"><img src="../../images/ico/before.png" alt="Revenir en arrière" title="Revenir en arrière" class="icoreturn"/></a></div>';
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <label for="date">Changer de période : </label>
                            <input type="date" name="date" id="date" value="<? echo $date; ?>"/>
                            <input type="hidden" name="idCat" value="<? echo $idCat; ?>"/>
                            <input type="hidden" name="idSousCat" value="<? echo $idSousCat; ?>"/>
                            <input type="submit" value="Valider" />
                        </form>
                    </div>
                </div>

                <!-- -------------------------------------------------------------------------- AFFICHAGE DES OPERATIONS  ----------------------------------------------------------------------------------------->
                <div id="operations">
                    <div id="listingOperations" data-idcat="<?php echo $idCat; ?>">
                        <?php
                            $query = 'SELECT operation.id, operation.date, operation.nom, operation.montant, devise.symbole ';
                            $query .= 'FROM categorie ';
                            $query .= 'INNER JOIN operation ON categorie.id = operation.id_categorie ';
                            $query .= 'INNER JOIN compte ON operation.id_compte = compte.id ';
                            $query .= 'INNER JOIN utilisateur ON utilisateur.id = compte.id_utilisateur ';
                            $query .= 'INNER JOIN devise ON devise.id = compte.id_devise ';
                            $query .= 'WHERE utilisateur.id = :id ';
                            $query .= 'AND compte.etat = true ';
                            $query .= 'AND operation.date >= "'.$annee.'-'.$mois.'-01" ';
                            $query .= 'AND operation.date < date_add("'.$annee.'-'.$mois.'-01", INTERVAL 1 MONTH) ';
                            $query .= 'AND categorie.id =:idSousCat ';
                            $query .= 'ORDER BY operation.date DESC';
                            $statement = $db->prepare($query);
                            $statement->bindValue(":id", $id);
                            $statement->bindValue(":idSousCat", $idSousCat);
                            $statement->execute();
                            $script = "";
                            // Astuce pour regrouper les opérations qui ont la même date
                            $previousDateOp = "0000/00/00";
                            if($statement->rowCount() == 0){
                                $script .='<div class="nullOperations"> ';
                                $script .='Il n\'y a aucune opération à afficher. ';
                                $script .='</div>';
                            }else{
                                while($row = $statement->fetchObject()){
                                    $idOp = $row->id;
                                    $dateOp = $row->date;
                                    $nomOp = $row->nom;
                                    $montantOp = $row->montant;
                                    $devise = $row->symbole;
                                    if($previousDateOp == $dateOp){
                                        $script .='<div class="itemOperations" data-idop="'.$idOp.'"> ';
                                            $script .='<div class="operation" data-idop="'.$idOp.'"> ';
                                                $script .='<span class="dataOperation"><img src="../../images/ico/categories/'.$idSousCat.'.png"></span> ';
                                                $script .='<span class="dataOperation">'.$nomOp.'</span> ';
                                                $script .='<span class="dataOperation">'.$montantOp.''.$devise.'</span> ';
                                            $script .='</div>';
                                        $script .='</div>';
                                    }else{
                                        $script .='<div class="dateItemOperations"> ';
                                        $script .='<span>'.convertirDate($dateOp).'</span> ';
                                        $script .='</div>';
                                        $script .='<div class="itemOperations" data-idop="'.$idOp.'"> ';
                                                $script .='<div class="operation" data-idop="'.$idOp.'"> ';
                                                    $script .='<span class="dataOperation"><img src="../../images/ico/categories/'.$idSousCat.'.png"></span> ';
                                                    $script .='<span class="dataOperation">'.$nomOp.'</span> ';
                                                    $script .='<span class="dataOperation">'.$montantOp.''.$devise.'</span> ';
                                                $script .='</div>';
                                        $script .='</div>';
                                    }
                                $previousDateOp = $dateOp;
                                }
                            }
                        echo $script;
                        $statement->closeCursor();
                        ?>
                    </div>
                    <div id="detailOperations">
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
        $('.navAPPli3').addClass('selected');
        $('.navAPPli3').css('background-color', '#BA44AC');
        $('.navAPPli3').css('cursor', 'pointer');
        $('.navAPPli3').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli3').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli3').css('text-shadow', '#000 2px 2px 2px');
        $('.navAPPli3').css('z-index', '1');
    });
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
