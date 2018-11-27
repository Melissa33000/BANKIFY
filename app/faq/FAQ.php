<?php
include_once("../../inclusions/connectDB.php");
if(!empty($_GET) AND isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_POST)){
        $date = $_POST['date'];
    }
}else{
   // header('location:../404.php');
   // exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>FAQ</title>
        <?php include("../../inclusions/head.php"); ?>
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
                    <h1>FAQ</h1>
                </header>
                <div class="main">
                    <div class="searchbarfaq">
                        <div class="barreRecherche"><input type="search" placeholder="Rechercher..."></div>
                        <div class="blocBtnRecherche">
                            <button type="submit" class="btnRecherche"><span class="icon"><i class="fa fa-search"></i></span></button>
                        </div>
                    </div>
                    <div class="conteneurfaq">
                        <section class="section base-question">
                            <section class="section categorie-question">
                                <ul class="Liste">
                                    <li class="Objet">
                                        <a class="lien-objet" href="questions_frequentes.php">
                                            Questions fréquentes
                                        </a>
                                    </li>
                                    <li class="Objet">
                                        <a class="lien-objet" href="premiers_pas.php">
                                            Premiers pas
                                        </a>
                                    </li>
                                    <li class="Objet">
                                        <a class="lien-objet" href="fonctionnalites.php">
                                            Fonctionnalités
                                        </a>
                                    </li>
                                </ul>
                            </section>
                        </section>
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
        $('.navAPPli7').addClass('selected');
        $('.navAPPli7').css('background-color', '#21C6B3');
        $('.navAPPli7').css('cursor', 'pointer');
        $('.navAPPli7').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli7').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli7').css('text-shadow', '#000 2px 2px 2px');
    });
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
