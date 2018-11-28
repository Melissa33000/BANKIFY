<?php session_start() ?>
<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
$_SESSION['budget'] = "Revenus";
include_once("../../inclusions/connectDB.php");
include_once("../../inclusions/fonctions.php");
if(!empty($_SESSION) AND isset($_SESSION['id'])){
    $id = $_SESSION['id'];
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
<html>
    <head>
        <title>Budget</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>
    <body id="bodyOnglet">
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PEUT ETRE A MODELISER DANS DU PHP POUR LE REPETER DANS BUDGET ENTREES -->
            <section id="pageOnglet" class="backBudget">
                <!--<header id="headerAPPonglet" style="background-color: #BA44AC">
                    <h1 style="color: white">Budget</h1>
                </header>-->
                <div id="partieHaute">
                    <div class="btn_app_budget">
                        <a href="sorties.php"><input type="button" value="Dépenses" id="btn_depenses" style="background-color: rgba(228,228,228,0.9)"/></a>
                        <a href="entrees.php"><input type="button" value="Revenus" id="btn_revenus" style="background-color: rgb(126,188,187)"/></a>
                    </div>
                    <div id="rubanProvisoire">
                        <form action="" method="post">
                            <label for="date">Changer de période : </label>
                                <input type="date" name="date" id="date" value="<? echo $date; ?>"/>
                                <input type="submit" value="Valider" />
                        </form>
                    </div>
                    <!-- --------------------------------------------------------------------------AFFICHAGE CHIFFRES GLOBAUX --------------------------------------------------------------------------->
                    <!-- Il n'y a pas prévision solde car c'est plus compliqué qu'on pensait -->
                    <div id="tableRubanBudget">
                        <?php
                        $queryDepenses = 'SELECT f_soldeEntrees('.$id.', "'.$annee.'-'.$mois.'-01") AS depenses';
                        $queryDevise = 'SELECT f_afficherDevise('.$id.') AS devise';
                        $queryBudget = 'SELECT f_budgetEntrees('.$id.', "'.$annee.'-'.$mois.'-01") AS budget';
                        $querySoldeActuel = 'SELECT SUM((SELECT f_soldeComptes('.$id.')) + (SELECT f_totalEntrees('.$id.', "'.$annee.'-'.$mois.'-01")) + (SELECT f_totalSorties('.$id.', "'.$annee.'-'.$mois.'-01"))) AS soldeActuel';
                        try{
                            $resultDepenses = $db->query($queryDepenses);
                            $resultDevise = $db->query($queryDevise);
                            $resultBudget = $db->query($queryBudget);
                            $resultSoldeActuel = $db->query($querySoldeActuel);
                            if(($row = $resultDepenses->fetchObject()) && ($row2 = $resultDevise->fetchObject()) && ($row3 = $resultBudget->fetchObject()) && ($row4 = $resultSoldeActuel->fetchObject())){
                                $depense = $row->depenses;
                                $devise = $row2->devise;
                                $budget = $row3->budget;
                                $soldeActuel = $row4->soldeActuel;
                            }
                            $script1 =''.$depense.''.$devise.'';
                            $script2 =''.$budget.''.$devise.'';
                            $script3 =''.$soldeActuel.''.$devise.'';
                        }catch(Exception $e){
                            echo 'La requête s\'est mal passée...';
                            print($e);
                        }
                        $resultDepenses->closeCursor();
                        $resultDevise->closeCursor();
                        $resultBudget->closeCursor();
                        $resultSoldeActuel->closeCursor();
                        ?>
                        <div class="itemRubanBudget">
                            <div>Revenus</div>
                            <div><span><b><?php echo $script1; ?></b></span></div>
                        </div>
                        <div class="itemRubanBudget">
                            <div>Budget estimé</div>
                            <div><span><b><?php echo $script2; ?></b></span></div>
                        </div>
                        <div class="itemRubanBudget">
                            <div>Solde actuel</div>
                            <div><span><b><?php echo $script3; ?></b></span></div>
                        </div>
                    </div>
                    <!-- --------------------------------------------------------------------------AFFICHAGE DIAGRAMMES DEPENSES PAR CATEGORIES ----------------------------------------------------------------------------------------->

                    <!-- Boutons glissières-->
                    <div id="btn-toggle">
                        <!-- Bouton glissière pour afficher / Masquer les catégories à 0€ -->
                        <label class="button-toggle-wrap">
                            <p class="my-text">Masquer les catégories nulles</p>
                            <input class="toggler" type="checkbox" data-toggle="button-toggle" id="btn-categorie"/>
                            <div class="button-toggle"><div class="handle"></div></div>
                        </label>
                        <!-- Bouton glissière pour afficher / Masquer le graphique des catégories -->
                        <label class="button-toggle-wrap">
                            <p class="text-graph">Afficher le graphique</p>
                            <input class="toggler" type="checkbox" data-toggle="button-toggle" id="btn-graph"/>
                            <div class="button-toggle"><div class="handle"></div></div>
                        </label>
                    </div>
                </div>
                <div id="partieBasse">
                    <div id="graph" style="display: none">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div id="budgetCat">
                        <?php
                        $queryMinIdCat = 'SELECT min(id) AS idMin from categorie where id_categorie is null and id>10000';
                        $queryMaxIdCat = 'SELECT max(id) AS idMax from categorie where id_categorie is null and id>10000';
                        $resultMinIdCat = $db->query($queryMinIdCat);
                        $resultMaxIdCat = $db->query($queryMaxIdCat);
                        if(($row = $resultMinIdCat->fetchObject()) && ($row2 = $resultMaxIdCat->fetchObject())){
                            $minIdCat = $row->idMin;
                            $maxIdCat = $row2->idMax;
                        }
                        $resultMinIdCat->closeCursor();
                        $resultMaxIdCat->closeCursor();

                        for($i = $minIdCat; $i <= $maxIdCat; $i++){

                            $queryBudgetCat = 'SELECT (SELECT categorie.libelle from categorie where categorie.id = '.$i.') AS libelleCat, f_entreesCat('.$id.', "'.$annee.'-'.$mois.'-01", '.$i.') AS depensesCat, f_budgetEntreesCat('.$id.', "'.$annee.'-'.$mois.'-01", '.$i.') AS budgetCat';
                            $resultBudgetCat = $db->query($queryBudgetCat);
                            $script = "";
                            if($row = $resultBudgetCat->fetchObject()){
                                $idCat = $i;
                                $libelleCat = $row->libelleCat;
                                $depensesCat = $row->depensesCat;
                                $budgetCat = $row->budgetCat;
                                $pourcentage = calculerPourcentage($depensesCat,$depense);

                                $script .= '<div class="itemBudgetCat" data-id="'.$idCat.'" data-montant="'.$depensesCat.'">';
                                    $script .= '<img src="../../images/ico/categories/'.$idCat.'.png">';
                                    $script .= '<p class="titreItem">'.$libelleCat.'<br>';
                                    $script .= '<span class="pourcentage">'.$pourcentage.'%</span></p>';
                                    $script .= '<p><span>' . $depensesCat . '</span> / ' . $budgetCat . '' .$devise.'</p>';
                                $script .= '</div>';

                                if($depensesCat != "0.00"){
                                    $graphCat[] = $libelleCat;
                                    $graphPourcentage[] = $pourcentage;
                                }
                            }
                            echo $script;
                        }
                        $resultBudgetCat->closeCursor();
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once("../../inclusions/footer.php"); ?>
    </body>
</html>
<!-- ICI SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
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
        // Cacher les pourcentages s'il n'y a pas eu de revenus ou de dépenses.
        $('.pourcentage').each(function () {
            let depense = $(this).parent().parent().data('montant');
            if(depense === "0.00"){
                $(this).hide();
            }
        });
    });
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
<script>
    // Graphique des catégories REVENUS
    <?php
    $list = '';
    foreach ($graphCat as $t)
        $list .= '"'.$t.' (%)",';
    $list2 = '';
    foreach ($graphPourcentage as $t)
        $list2 .= '"'.$t.'",';
    ?>

    let tabLabels = new Array(<?php echo substr($list, 0, -1); ?>);
    let tabPourcentage = new Array(<?php echo substr($list2, 0, -1); ?>);

    let ctx = $("#myChart");
    let myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: tabLabels,
            datasets: [{
                label: 'Revenus %',
                data: tabPourcentage,
                backgroundColor: ['#54DE3D','#00C472','#00A78E','#008792', '#00677E', '#2F4858', '#00A3C4', '#00BBC5', '#15D0B6', '#6CE29E', '#B2F083', '#F9F871', '#B7DB39', '#518E27', '#1F6100', '#003600'],
                borderColor: ['#F7F4EE'],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                /*yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]*/
            }
        }
    });
</script>