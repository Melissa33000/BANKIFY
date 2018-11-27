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

$idEmetteur = $_GET['compteemetteur'];
$idBeneficiaire = $_GET['comptebeneficiaire'];

// Récolte des données des 2 comptes
$SQLQuery = 'SELECT * FROM compte WHERE id_utilisateur = :utilisateuractuel and id= :id_compteemetteur';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_compteemetteur', $idEmetteur);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la sélection des comptes !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}

$SQLResultCompteEmetteur = $SQLStatement->fetchObject();
$SQLStatement->closeCursor();

$SQLQuery = 'SELECT * FROM compte WHERE id_utilisateur = :utilisateuractuel and id= :id_comptebeneficiaire';
$SQLStatement = $dbConn->prepare($SQLQuery);
$SQLStatement->bindValue(':utilisateuractuel', $_SESSION['utilisateur']);
$SQLStatement->bindValue(':id_comptebeneficiaire', $idBeneficiaire);

if (!$SQLStatement->execute()) {
    print("Erreur d'exécution de lors de la sélection des comptes !<br />");
    var_dump($SQLStatement->errorInfo());
    die();
}
$SQLResultCompteBeneficiaire = $SQLStatement->fetchObject();
$SQLStatement->closeCursor();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation Virement</title>
        <?php include("../../inclusions/head.php"); ?>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../../css/style_Melissa.css"/>
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
                <h1>Confirmation du virement</h1>
            </header>

            <section class="virement" id="virement3">
                <fieldset>
                    <table>
                        <tr>
                            <div class="titrevirement">COMPTE EMETTEUR</div><br>
                            <td><span class ="policevirement">Nom du Compte :</span> <?php echo $SQLResultCompteEmetteur->nom ?></td>
                            <td><span class ="policevirement espacement">Solde actuel: </span><?php echo $SQLResultCompteEmetteur->solde_initial ?></td>
                        </tr>
                        <tr>
                            <td><span class ="policevirement">Numéro du Compte : </span><?php echo $SQLResultCompteEmetteur->numero ?></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <table>
                        <tr>
                            <div class="titrevirement">COMPTE BENEFICIAIRE</div><br>
                            <td><span class ="policevirement">Nom du Compte :</span> <?php echo $SQLResultCompteBeneficiaire->nom ?></td>
                            <td><span class ="policevirement espacement">Solde actuel:</span> <?php echo $SQLResultCompteBeneficiaire->solde_initial ?></td>
                        </tr>
                        <tr>
                            <td><span class ="policevirement">Numéro du Compte :</span> <?php echo $SQLResultCompteBeneficiaire->numero ?></td>
                        </tr>
                    </table>
                </fieldset>
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
    </body>
</html>