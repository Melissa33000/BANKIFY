<?php
include_once("../../inclusions/connectDB.php");
if(!empty($_GET) AND isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_POST)){
        $date = $_POST['date'];
    }
}else{
    header('location:../404.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>XXX</title>
        <?php include("../../inclusions/head.php"); ?>
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
                    <h1>=XXXX</h1>
                </header>





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
        $('.navAPPli4').addClass('selected');
        $('.navAPPli4').css('background-color', '#8A6CCB');
        $('.navAPPli4').css('cursor', 'pointer');
        $('.navAPPli4').css('box-shadow', '5px 5px 5px black');
        $('.navAPPli4').css('box-shadow', '5px 0px 3px black');
        $('.navAPPli4').css('text-shadow', '#000 2px 2px 2px');
    });
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
