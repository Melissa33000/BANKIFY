<?php
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
        <title>Premiers pas</title>
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
                    <h1>Premiers pas</h1>
                </header>
                <div class="bloc-principal">
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse1')" class="bouton-question">Ajouter un compte bancaire</button>
                        </div>
                        <div id="reponse1" class="objet-liste-reponse" style="display:none">
                             <p>
                                Il vous suffit, sur la page de votre liste de comptes, de cliquer sur <i><b>Ajoutez un compte</b></i>. Vous serez ensuite redirigé vers le formulaire d'ajout de compte. Il vous suffira alors de le remplir et de cliquez sur <i><b> Valider</b></i>.
                            </p>
                        </div>
                    </div>
                    
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse2')" class="bouton-question">Signification des couleurs dans les comptes</button>
                        </div>
                        <div id="reponse2" class="objet-liste-reponse" style="display:none">
                             <p>
                                Une couleur verte représente un crédit, c'est à dire une rentrée d'argent sur le compte à l'inverse, une couleur rouge représente un débit, c'est à dire une sortie d'argent sur le compte.
                            </p>
                        </div>
                        <div class="objet-liste">
                            <div class="objet-liste-option">
                                <button onclick="afficher('reponse3')" class="bouton-question">Se déconnecter</button>
                            </div>
                            <div id="reponse3" class="objet-liste-reponse" style="display:none">
                                 <p>
                                    Sur la page d'accueil de vos comptes il vous suffit de cliquez sur le bouton <i><b>Déconnexion</b></i>.
                                </p>
                            </div>
                        </div>
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

     // Script pour afficher la réponse à la question sélectionnée.
    function afficher(nom) {
        var x = document.getElementById(nom);
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
