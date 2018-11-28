<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
session_start();
include_once("../../inclusions/connectDB.php");
if(!empty($_SESSION) AND isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    if(!empty($_POST)){
        //A definir
    }
}else{
    header('location:../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Exporter ses données</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>
    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet" class="backExport">
                <!--<header id="headerAPPonglet">
                    <h1>=XXXX</h1>
                </header>-->
                <div id="pageExport">
                    <form action="" method="post" onsubmit="return verif_formulaire_export()">
                        <p>Cette page est en travaux ❤</p>
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
        $('.navAPPli6').addClass('selected');
        $('.navAPPli6').css('background-color', '#2E94F8');
        $('.navAPPli6').css('cursor', 'pointer');
        $('.navAPPli6').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli6').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli6').css('text-shadow', '#000 2px 2px 2px');
        $('.navAPPli6').css('z-index', '1');
    });
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>

