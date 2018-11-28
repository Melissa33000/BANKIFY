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
        <title>Nous contacter</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>
    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet" class="backContact">
                <!--<header id="headerAPPonglet">
                    <h1>=XXXX</h1>
                </header>-->
                <div id="pageContact">
                    <form action="" method="post" onsubmit="return verif_formulaire_contact()">
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
    $('#option2').css("border-bottom","3px solid black");
    $('#option2').css("background","radial-gradient(circle at bottom left, #ffd11a, #F5701B, #FD3F4F, #C02382, #7855c3, #6666ff, #2E94F8, #39ac39)");
    $('#option2').css("-webkit-background-clip","text");
    $('#option2').css("-webkit-text-fill-color","transparent");
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>

