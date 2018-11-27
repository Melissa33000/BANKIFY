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
        <title>Fonctionnalités</title>
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
                    <h1>Fonctionnalités</h1>
                </header>
                <div class="bloc-principal">
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse1')" class="bouton-question">Gérer les comptes</button>
                        </div>
                        <div id="reponse1" class="objet-liste-reponse" style="display:none">
                             <p>
                                Fonctionnalité essentielle d'une application bancaire. Vous pouvez modifier votre compte comme vous le souhaitez que ce soit le nom, la devise ou tout autre données et si votre compte vous semble totalement erroné vous avez la possibilité de le supprimer.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse2')" class="bouton-question">Gérer les opérations bancaires</button>
                        </div>
                        <div id="reponse2" class="objet-liste-reponse" style="display:none">
                             <p>
                                Comme "Gérer les comptes" c'est une fonctionnalité essentielle, là aussi vous pouvez modifier les opérations comme il vous plaira et vous aurez aussi la possibilité de la supprimer.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse3')" class="bouton-question">Effectuer un virement</button>
                        </div>
                        <div id="reponse3" class="objet-liste-reponse" style="display:none">
                             <p>
                                Il vous est possible d'effectuer des virements sur votre compte. Il vous sera demandé le type de l'opération (entrée/sortie) et vous aurez la possiblité de renseigner la catégorie, le moyen de paiement, le tiers concerné.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse4')" class="bouton-question">Consulter l'historique global</button>
                        </div>
                        <div id="reponse4" class="objet-liste-reponse" style="display:none">
                             <p>
                                Nous souhaitions que vous ayez la possibilité d'avoir une vision global des opérations effectuées sur vos différents comptes, lorsque vous en possédez plusieurs, afin que ce soit plus visible pour vous et vous permette donc de mieux gérer votre argent.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse5')" class="bouton-question">Consulter l'historique d'un compte</button>
                        </div>
                        <div id="reponse5" class="objet-liste-reponse" style="display:none">
                             <p>
                                Encore une fois c'est une fonctionnalité essentielle, nous devions vous permettre de voir les opérations effectuées sur un compte en particulier, surtout pour les utilisateurs ne possédant qu'un seul compte. Vous y retrouvez toutes les informations nécessaires sur les opérations effectuées sur le compte.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse6')" class="bouton-question">Consulter le budget</button>
                        </div>
                        <div id="reponse6" class="objet-liste-reponse" style="display:none">
                             <p>
                                C'est une fonctionnalité qui nous paraissez indispensable pour une application dont le but est de vous aider à gérer votre budget. Elle vous permettra de définir un budget afin de vous fixez des limites. Si la limite est dépassé vous serez alors averti par une notification.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse7')" class="bouton-question">Exporter les données</button>
                        </div>
                        <div id="reponse7" class="objet-liste-reponse" style="display:none">
                             <p>Nous souhaitions que vous ayez la possibilité d'exporter les données en CSV ou en PDF.</p>
                             <p>Le CSV est un format que l'on peut récupérer afin de l'utiliser avec un tableau Excel. Nous souhaitions que les personnes puissent récupérer les données de leur(s) comtpe(s) et de pouvoir travailler par la suite dans un tableau Excel.</p>
                             <p>Le format PDF vous permettra de récupérer un document regroupant les données de votre ou vos comptes.</p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse8')" class="bouton-question">Simuler mon budget</button>
                        </div>
                        <div id="reponse8" class="objet-liste-reponse" style="display:none">
                             <p>
                                <i>Cette fonctionnalité n'est pas encore disponible...</i>
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-option">
                            <button onclick="afficher('reponse9')" class="bouton-question">Modifier les paramètres</button>
                        </div>
                        <div id="reponse9" class="objet-liste-reponse" style="display:none">
                             <p>
                                Cette fonctionnalité vous permettra de modifier les paramètres de l'application afin de vous rendre l'application plus confortable.
                            </p>
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
