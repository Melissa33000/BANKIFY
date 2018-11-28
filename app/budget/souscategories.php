<?php session_start() ?>
<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
include_once("../../inclusions/connectDB.php");
include_once("../../inclusions/fonctions.php");
$_SESSION['budget'] = "Dépenses";
if(!empty($_SESSION) AND isset($_SESSION['id']) AND !empty($_POST)){
    $id = $_SESSION['id'];
    //$idCat = $_GET['idCat'];
    $idCat = $_POST['idCat'];
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
                    <div class="retour"><a href="sorties.php"><img src="../../images/ico/before.png" alt="Revenir en arrière" title="Revenir en arrière" class="icoreturn"/></a></div>
                </header>-->
                <div id="partieHaute2">
                    <div class="btn_app_budget">
                        <a href="sorties.php"><input type="button" value="Dépenses" id="btn_depenses" style="background-color: rgb(236, 74, 89)"/></a>
                        <a href="entrees.php"><input type="button" value="Revenus" id="btn_revenus"  style="background-color: rgba(228,228,228,0.9)""/></a>
                    </div>
                    <div id="rubanProvisoire">
                        <div class="retour"><a href="sorties.php"><img src="../../images/ico/before.png" alt="Revenir en arrière" title="Revenir en arrière" class="icoreturn"/></a></div>
                        <form action="" method="post">
                            <label for="date">Changer de période : </label>
                            <input type="date" name="date" id="date" value="<? echo $date; ?>"/>
                            <input type="hidden" name="idCat" value="<? echo $idCat; ?>"/>
                            <input type="submit" value="Valider" />
                        </form>
                    </div>
                </div>
                <div id="souscategories">
                    <div id="listingSousCat">
                        <div class="headSousCat">
                            <span class="dataRowSousCat"></span>
                            <span class="dataRowSousCat">Sous-catégorie</span>
                            <span class="dataRowSousCat">Transactions</span>
                            <span class="dataRowSousCat">Montant total</span>
                        </div>
                        <div id="ligneTri">
                            <?php
                            $queryMinIdSousCat = 'select min(id) AS min from categorie where categorie.id_categorie ='.$idCat.'';
                            $queryMaxIdSousCat = 'select max(id) AS max from categorie where categorie.id_categorie ='.$idCat.'';
                            $resultMinIdSousCat = $db->query($queryMinIdSousCat);
                            $resultMaxIdSousCat = $db->query($queryMaxIdSousCat);
                            if(($row = $resultMinIdSousCat->fetchObject()) && ($row2 = $resultMaxIdSousCat->fetchObject())){
                                $minIdSousCat = $row->min;
                                $maxIdSousCat = $row2->max;
                            }
                            $resultMinIdSousCat->closeCursor();
                            $resultMaxIdSousCat->closeCursor();
                            for($i = $minIdSousCat; $i<=$maxIdSousCat; $i++){
                                $query = 'select IF(categorie.id is null,(select id from categorie where id ='.$i.') , categorie.id) as idSousCat, IF(categorie.libelle is null, (select libelle from categorie where id ='.$i.'), categorie.libelle) AS sousCat, count(operation.id) AS nbrOperations, if(sum(operation.montant) is null, 0, sum(operation.montant)) as montant, if(devise.symbole is null, (select symbole from devise inner join compte on devise.id = compte.id_devise inner join utilisateur on compte.id_utilisateur = utilisateur.id where utilisateur.id ='.$id.' group by utilisateur.id), devise.symbole) AS devise ';
                                $query .= 'FROM categorie ';
                                $query .= 'inner join operation ON categorie.id = operation.id_categorie ';
                                $query .= 'inner join compte ON operation.id_compte = compte.id ';
                                $query .= 'inner join utilisateur ON utilisateur.id = compte.id_utilisateur ';
                                $query .= 'inner join devise ON devise.id = compte.id_devise ';
                                $query .= 'WHERE utilisateur.id ='.$id.' ';
                                $query .= 'AND compte.etat = true ';
                                $query .= 'AND operation.date >= "'.$annee.'-'.$mois.'-01" ';
                                $query .= 'AND operation.date < date_add("'.$annee.'-'.$mois.'-01", INTERVAL 1 MONTH) ';
                                $query .= 'AND categorie.id ='.$i.'';
                                $result = $db->query($query);
                                $script = "";
                                while($row = $result->fetchObject()){
                                    $idSousCat = $row->idSousCat;
                                    $sousCat = $row->sousCat;
                                    $nbr = $row->nbrOperations;
                                    $montant = $row->montant;
                                    $devise = $row->devise;

                                    $script .= '<div class="rowSousCat" data-idcat="'.$idCat.'" data-idsouscat="'.$idSousCat.'" data-montant="'.$montant.'"> ';
                                        $script .='<span class="dataRowSousCat"><img src="../../images/ico/categories/'.$idSousCat.'.png"></span> ';
                                        $script .= '<span class="dataRowSousCat">'.$sousCat.'</span>';
                                        $script .= '<span class="dataRowSousCat">'.$nbr.'</span>';
                                        $script .= '<span class="dataRowSousCat"><span>'.$montant.'</span>'.$devise.'</span>';
                                    $script .= '</div>';

                                    $depensesTab[] = $montant;
                                    if($montant != "0.00"){
                                        $graphSousCat[] = $sousCat;
                                        $graphMontantSousCat[] = $montant;
                                    }
                                }
                                echo $script;
                                $result->closeCursor();

                            }
                            ?>
                        </div>
                    </div>
                    <div id="graphSousCategories">
                        <h1><?php echo additionner($depensesTab); ?>€</h1>
                        <p>Total des dépenses</p>
                        <canvas id="myChart"></canvas>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script>
    <?php
        $list = '';
        foreach ($graphSousCat as $t)
            $list .= '"'.$t.'",';

        $list2 = '';
        foreach ($graphMontantSousCat as $t)
            $list2 .= '"'.$t.'",';

    ?>

    let tabLabels = new Array(<?php echo substr($list, 0, -1); ?>);
    let tabMontants = new Array(<?php echo substr($list2, 0, -1); ?>);

    //Couleurs par sous-catégories
    let tabCouleurs = new Array();
    let tabBordures = new Array();
    if(($('.rowSousCat').data('idcat')) === 1){
        tabCouleurs.push("rgba(209, 174, 209,1)","rgba(190, 141, 190,0.8)","rgba(172, 109, 172,0.8)","rgba(146, 83, 146,0.8)","rgba(114, 65, 114,0.8)","rgba(81, 46, 81,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 2){
        tabCouleurs.push("rgba(255, 179, 198,1)","rgba(254, 128, 160,0.8)","rgba(254, 77, 122,0.8)","rgba(254, 27, 84,0.8)","rgba(228, 1, 58,0.8)","rgba(178, 1, 45,0.8)","rgba(127, 1, 32,0.8)","rgba(76, 0, 19,0.8)","rgba(25, 0, 6,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 3){
        tabCouleurs.push("rgba(255, 216, 128,1)","rgba(255, 201, 77,1)","rgba(255, 186, 26,1)","rgba(230, 160, 0,1)","rgba(179, 125, 0,1)");
    }else if(($('.rowSousCat').data('idcat')) === 4){
        //tabCouleurs.push("RGB(168, 237, 237)","RGB(130, 230, 230)","RGB(92, 222, 222)","RGB(15, 206, 206)","RGB(0, 185, 185)","RGB(0, 154, 154)","RGB(0, 124, 124)","RGB(0, 93, 93)","RGB(0, 63, 63)","RGB(0, 32, 32)");
        tabCouleurs.push("RGBA(168, 237, 237,1)","RGBA(130, 230, 230,0.8)","RGBA(92, 222, 222,0.8)","RGBA(15, 206, 206,0.8)","RGBA(0, 185, 185,0.8)","RGBA(0, 154, 154,0.8)","RGBA(0, 124, 124,0.8)","RGBA(0, 93, 93,0.8)","RGBA(0, 63, 63,0.8)","RGBA(0, 32, 32,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 5){
        //tabCouleurs.push("rgb(214, 186, 168)","rgb(198, 159, 134)","rgb(181, 131, 99)","rgb(156, 106, 74)","rgb(121, 82, 57)","rgb(87, 59, 41)","rgb(52, 35, 25)");
        tabCouleurs.push("rgba(214, 186, 168,1)","rgba(198, 159, 134,0.8)","rgba(181, 131, 99,0.8)","rgba(156, 106, 74,0.8)","rgba(121, 82, 57,0.8)","rgba(87, 59, 41,0.8)","rgba(52, 35, 25,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 6){
        //tabCouleurs.push("rgb(201, 207, 232)","rgb(165, 174, 217)","rgb(130, 142, 202)","rgb(94, 110, 187)","rgb(68, 84, 161)","rgb(53, 65, 125)","rgb(38, 47, 90)","rgb(23, 28, 54)","rgb(8, 9, 18)","rgb(201, 207, 232)","rgb(165, 174, 217)","rgb(130, 142, 202)","rgb(94, 110, 187)","rgb(68, 84, 161)","rgb(53, 65, 125)","rgb(38, 47, 90)","rgb(23, 28, 54)","rgb(8, 9, 18)","rgb(53, 65, 125)");
        tabCouleurs.push("rgba(201, 207, 232,1)","rgba(165, 174, 217,0.8)","rgba(130, 142, 202,0.8)","rgba(94, 110, 187,0.8)","rgba(68, 84, 161,0.8)","rgba(53, 65, 125,0.8)","rgba(38, 47, 90,0.8)","rgba(23, 28, 54,0.8)","rgba(8, 9, 18,0.8)","rgba(201, 207, 232,0.8)","rgba(165, 174, 217,0.8)","rgb(130, 142, 202,0.8)","rgba(94, 110, 187,0.8)","rgba(68, 84, 161,0.8)","rgba(53, 65, 125,0.8)","rgba(38, 47, 90,0.8)","rgba(23, 28, 54,0.8)","rgba(8, 9, 18,0.8)","rgba(53, 65, 125,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 7){
        tabCouleurs.push("rgba(168, 200, 215,1)","rgba(133, 178, 199,0.8)","rgba(98, 157, 183,0.8)","rgba(72, 131, 157,0.8)","rgba(56, 102, 122,0.8)","rgba(40, 73, 87,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 8){
        tabCouleurs.push("rgba(255, 179, 216,1)","rgba(255, 128, 190,0.8)","rgba(255, 77, 164,0.8)","rgba(255, 26, 138,0.8)","rgba(179, 0, 88,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 9){
        tabCouleurs.push("rgba(254, 180, 186,1)","rgba(253, 130, 140,0.8)","rgba(252, 80, 94,0.8)","rgba(251, 30, 48,0.8)","rgba(225, 4, 22,0.8)","rgba(175, 3, 17,0.8)","rgba(125, 2, 12,0.8)","rgba(75, 1, 7,0.8)","rgba(25, 0, 2,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 10){
        tabCouleurs.push("rgba(240,208,187,0.6)","rgba(251, 209, 182,0.8)","rgba(249, 179, 134,0.8)","rgba(246, 148, 85,0.8)","rgba(244, 118, 37,0.8)","rgba(218, 92, 11,0.8)","rgba(170, 72, 9,0.8)","rgba(121, 51, 6,0.8)","rgba(73, 31, 4,0.8)","rgba(24, 10, 1,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 11){
        tabCouleurs.push("rgba(179, 225, 255,1)","rgba(128, 205, 255,0.8)","rgba(77, 185, 255,0.8)","rgba(26, 166, 255,0.8)","rgba(0, 140, 230,0.8)","rgba(0, 109, 179,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 12){
        tabCouleurs.push("rgba(223, 202, 232,1)","rgba(202, 166, 216,0.9)","rgba(180, 131, 200,0.9)","rgba(159, 96, 185,0.9)","rgba(133, 70, 159,0.9)","rgba(104, 55, 124,0.9)","rgba(74, 39, 89,0.9)","rgba(44, 23, 53,0.9)","rgba(15, 8, 18,0.9)");
    }else if(($('.rowSousCat').data('idcat')) === 13){
        tabCouleurs.push("rgba(24,201,93,1)","rgba(0,178,125,0.8)","rgba(0,152,141,0.8)","rgba(0,125,139,0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 14){
        //tabCouleurs.push("rgb(149,165,233)","rgb(118,140,227)","rgb(103,127,224)","rgb(82,102,179)","rgb(72,89,157)","rgb(62,76,134)","rgb(52,64,112)","rgb(41,51,90)","rgb(31,38,67)","rgb(21,25,45)");
        //tabCouleurs.push("rgb(191, 201, 242)","rgb(149, 166, 233)","rgb(107, 130, 225)","rgb(64, 94, 216)","rgb(39, 69, 191)","rgb(30, 54, 148)","rgb(22, 38, 106)","rgb(13, 23, 64)","rgb(4, 8, 21)");
        tabCouleurs.push("rgba(136, 155, 231, 1)","rgba(103, 127, 224, 0.8)","rgba(69, 98, 217, 0.8)","rgba(52, 84, 213, 0.8)","rgba(38, 68, 186, 0.8)","rgba(31, 55, 152, 0.8)","rgba(24, 43, 119, 0.8)","","rgba(17, 31, 85, 0.8)","rgba(3, 6, 17, 0.8)");
    }else if(($('.rowSousCat').data('idcat')) === 15){
        tabCouleurs.push("rgba(253, 237, 181,0.9)","rgba(251, 225, 132,0.8)","rgba(249, 213, 82,0.8)","rgba(248, 201, 33,0.8)","rgba(222, 175, 7,0.8)","rgba(173, 136, 6,0.8)","rgba(123, 97, 4,0.8)","rgba(74, 58, 2,0.8)");

    }else if(($('.rowSousCat').data('idcat')) === 16){
        tabCouleurs.push("rgba(192, 255, 128,1)","rgba(166, 255, 77,0.8)","rgba(141, 255, 26,0.8)","rgba(115, 230, 0,0.8)","rgba(90, 179, 0,0.8)","rgba(38, 77, 0,0.8)");

    }

    let ctx = $("#myChart");
    let myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: tabLabels,
            datasets: [{
                label: 'Dépenses €',
                data: tabMontants,
                backgroundColor: tabCouleurs,
                borderColor: "#FFFFFF",
                borderWidth: 1
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
