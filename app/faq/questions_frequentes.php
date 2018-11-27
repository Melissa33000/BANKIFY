<?php
include_once("../../inclusions/connectDB.php");
if(!empty($_GET) AND isset($_GET['id'])){
    $id = $_GET['id'];
    if(!empty($_POST)){
        $date = $_POST['date'];
    }
}else{
    //header('location:../404.php');
   // exit;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Questions fréquentes</title>
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
                    <h1>Questions fréquentes</h1>
                </header>
                <div class="bloc-principal">
                    <div class="objet-liste">
                        <div class="objet-liste-question">
                            <button onclick="afficher('reponse1')" class="bouton-question">Comment ajouter un compte bancaire ?</button>
                        </div>
                        <div id="reponse1" class="objet-liste-reponse" style="display:none">
                             <p>
                                Il vous suffit, sur la page de votre liste de comptes, de cliquer sur <i><b>Ajoutez un compte</b></i>. Vous serez ensuite redirigé vers le formulaire d'ajout de compte. Il vous suffira alors de le remplir et de cliquez sur <i><b> Valider</b></i>.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-question">
                            <button onclick="afficher('reponse2')"  class="bouton-question">Comment modifier un compte bancaire ?</button>
                        </div>
                        <div id="reponse2" class="objet-liste-reponse" style="display:none">
                             <p>Sur la page de votre liste de comptes cliquez sur l'icône <img src="../../images/edit.png" width="16px">
                              qui vous redirigera sur le formulaire de modification de compte. Modifiez les données voulues puis cliquez sur <i><b> Valider</b></i>.</p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-question">
                            <button onclick="afficher('reponse3')"  class="bouton-question">Comment supprimer un compte ?</button>
                        </div>
                        <div id="reponse3" class="objet-liste-reponse" style="display:none">
                             <p>
                                Sur la page de votre liste de comptes cliquez sur l'icône <img src="../../images/delete.png" width="16px">. Une fenêtre de confirmation apparaîtra. Si vous confirmez le compte sera effacé.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                        <div class="objet-liste-question">
                            <button onclick="afficher('reponse4')"  class="bouton-question">Comment modifier une opération ?</button>
                        </div>
                        <div id="reponse4" class="objet-liste-reponse" style="display:none">
                             <p>
                                Lorque vous êtes sur une page avec des opérations, cliquez sur l'icône <img src="../../images/edit.png" width="16px">. Vous serez redirigez vers le formulaire de modification et vous n'aurez plus qu'à modifier les données voulues et cliquez sur <i><b> Valider</b></i>.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                         <div class="objet-liste-question">
                            <button onclick="afficher('reponse5')"  class="bouton-question">Comment supprimer une opération ?</button>
                        </div>
                        <div id="reponse5" class="objet-liste-reponse" style="display:none">
                             <p>
                                Lorque vous êtes sur une page avec des opérations, cliquez sur l'icône <img src="../../images/delete.png" width="16px">. Une fenêtre de confirmation apparaîtra. Si vous confirmez l'opération sera effacé.
                            </p>
                        </div>
                    </div>
                    <div class="objet-liste">
                         <div class="objet-liste-question">
                            <button onclick="afficher('reponse6')"  class="bouton-question">Comment effectuer un virement ?</button>
                        </div>
                        <div id="reponse6" class="objet-liste-reponse" style="display:none">
                             <p>Dans le menu, cliquez sur <i><b>Virement</b></i>.</p>
                             <p>Sur la page des virement sélectionnez le compte débitaire et le compte bénéficiaire. Ensuite sélectionner le montant et cliquez sur <i><b>Valider</b></i>.</p>
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
