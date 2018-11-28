<?php
session_start();
include_once ('../../inclusions/connectDB.php');

if(!isset($_SESSION['utilisateur'])) {
    header("Location:connexion1.php");
    exit();
}

// Quand tout le monde sera en session, à utilisaer à la place du système avec l'id :
$id = $_SESSION['utilisateur'];
if (!empty($_POST)) {
    $date = $_POST['date'];
}


// Affichage de ses comptes actifs (affichage du compte avec solde et devise)
$SQLQuery = 'SELECT * FROM compte WHERE id_utilisateur = :utilisateuractuel';
$SQLStatement = $db->prepare($SQLQuery);

$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
if (!$SQLStatement->execute()) {
    print("il y a un problème avec la base de données<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLResult = $SQLStatement->fetchAll();
$SQLStatement->closeCursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Virement : choix comptes</title>
        <?php include("../../inclusions/head.php"); ?>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../../librairies/assets/owl.carousel.css">
        <link rel="stylesheet" href="../../librairies/assets/owl.theme.default.css">
        <link rel="stylesheet" href="../../css/style_Melissa.css"/>
    </head>

    <body id="bodyOnglet">
    <!-- HEADER -->
    <?php include_once("../../inclusions/headerAPP.php"); ?>
    <div id="navPage">
        <!-- NAV-->
        <?php include_once("../../inclusions/navAPP.php"); ?>
        <!-- PAGE / CONTENU ONGLET -->
        <section id="pageOnglet" style="width: calc(100% - 131px)">
            <header id="headerAPPonglet">
                <h1>Choix des comptes</h1>
            </header>
                <div id="error_datasrv"></div>
                <section id="virement1" class="virement">
                    <div class="titrevirement">COMPTE EMETTEUR</div>
                    <div class="owl-carousel owl-theme" id="compte_emetteur">
                        <?php foreach($SQLResult as $result) : ?>
                            <div class="item">
                                <input type="radio" name="compte_emetteur" value="<?php echo $result['id']; ?>">
                                <table>
                                    <tr>
                                        <td><span class ="policevirement"><?php echo $result['nom']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $result['solde_initial']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="titrevirement">COMPTE BENEFICIAIRE</div>
                    <div class="owl-carousel owl-theme" id="compte_beneficiaire">
                        <?php foreach($SQLResult as $result) : ?>
                            <div class="item">
                                <input type="radio" name="compte_beneficiaire" value="<?php echo $result['id']; ?>">
                                <table>
                                    <tr>
                                        <td><span class ="policevirement"><?php echo $result['nom']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $result['solde_initial']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="bouton_designvirement">
                        <input type="submit" id="valider" value="Valider"/>
                    </div>
                </section>
        </section>
    </div>
    <!-- FOOTER -->
    <?php include_once("../../inclusions/footer.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Coloriser l'onglet quand on est sur la page, je rajoute "selected" à la classe pour ne pas avoir de bug avec le "onmouseover"
        $(document).ready(function(){
            $('.navAPPli5').addClass('selected');
            $('.navAPPli5').css('background-color', '#5F90E8');
            $('.navAPPli5').css('cursor', 'pointer');
            $('.navAPPli5').css('box-shadow', '5px 5px 5px black');
            $('.navAPPli5').css('box-shadow', '5px 0px 3px black');
            $('.navAPPli5').css('text-shadow', '#000 2px 2px 2px');
        });
    </script>
    <script src="../../scripts/javascript.js" type="text/javascript"></script>
    <script src="../../librairies/owl.carousel.min.js"></script>
    <script src="virement.script.js"></script>
    </body>
</html>