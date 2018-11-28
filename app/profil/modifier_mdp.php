<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
session_start();
    include_once ("../../inclusions/connectDB.php");
?>
<!DOCTYPE html>
<html>
<?php
    if (!empty($_SESSION)) {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            // TODO VERIFIER QUE LA VALEUR DE L'ID + VERIFIER QUE C'EST BIEN CELUI DE L'UTILISATEUR
            if (!empty($_POST)) {
                $old_mdp = $_POST['mdp'];
                $new_mdp = hash('sha256',$_POST['new_mdp2']);
                $query = 'SELECT mdp FROM utilisateur WHERE id = :id';
                $statement = $db->prepare($query);
                $statement->bindValue(":id", $id);
                $statement->execute();
                if ($row = $statement->fetchObject()) {
                    $mdp_bdd = $row->mdp;
                }
                $statement->closeCursor();
                // ON vérifie que l'ancien mdp renseigné et bien l'actuel dans la BDD
                // On vérifie aussi sans hachage dans le cas où on lui a renvoyé un mot de passe.
                if ((hash('sha256',$old_mdp) == $mdp_bdd) || $old_mdp == $mdp_bdd) {
                    $query = 'UPDATE utilisateur ';
                    $query .= 'SET mdp = :mdp ';
                    $query .= 'WHERE id = :id';
                    $statement = $db->prepare($query);
                    $statement->bindValue(':mdp', $new_mdp);
                    $statement->bindValue(':id', $id);
                    $statement->execute();
                    $statement->closeCursor();
                    $msgSuccess = "<div id=\"success_datasrv\">Votre mot de passe a bien été mis à jour. <br> Vous allez être redirigé vers votre profil dans 2 secondes.</div>";
                    header('Refresh: 2;URL=profil.php');
                    // Je ne mets pas de exit; sinon on ne voit pas la page et ça fait page blanche pendant 2 secondes.
                } else {
                    //$script = '<script type="text/javascript"> alert("Votre ancien mot de passe est incorrect !") </script>';
                    //echo $script;
                    $msgErrorBDD = "<div id=\"error_datasrv\">Votre ancien mot de passe est incorrect !</div>";
                }
                // ON A DU GET PAS DE POST
            } else {

            }
            // ON A PAS DE GET (Logiquement on n'est pas censé pouvoir être sur cette page car ça veut dire qu'on est pas connecté, du moins je crois
        }
    }else{
        header('location:../../index.php');
        exit;
    }
?>
    <head>
        <title>Modifier le mot de passe</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>

    <body id="bodyOnglet">
    <!-- HEADER -->
    <?php include_once("../../inclusions/headerAPP.php"); ?>
    <div id="navPage">
        <!-- NAV-->
        <?php include_once("../../inclusions/navAPP.php"); ?>
        <!-- PAGE / CONTENU ONGLET -->
        <section id="pageOnglet" class="formMDP">
            <!--<header id="headerAPPonglet">
                <h1><span>Modification du mot de passe</span></h1>
            </header>-->
            <!-- ERREUR MDP EXISTE DEJA -->
            <?php
            if(isset($msgErrorBDD)){
                echo $msgErrorBDD;
            }
            ?>
            <!-- ERREUR CHAMPS JAVASCRIPT -->
            <div id="error_datajs"></div>
            <!-- SUCCESS MDP  -->
            <?php
            if(isset($msgSuccess)){
                echo $msgSuccess;
            }
            ?>
            <div class="formulaire">
                <form action="" method="post" onsubmit="return verif_formulaire_mdp()">

                        <div class="champ_form">
                            <input type="password" data-libelle="renseigner votre mot de passe actuel" name="mdp" maxlength="16" id="mdp" class="inputForm" placeholder="Mot de passe actuel"/><i toggle="#mdp" class="far fa-eye fa-lg unhide_mdp"></i>
                        </div>

                        <div class="champ_form">
                            <input type="password" data-libelle="renseigner votre nouveau mot de passe" maxlength="16" onkeyup="return verif_complexity_mdp()" name="new_mdp" id="new_mdp" class="inputForm" placeholder="Nouveau mot de passe"/><i toggle="#new_mdp" class="far fa-eye fa-lg unhide_mdp"></i>
                            <div class="message_erreur" id="error_newmdp_contenu"></div>
                        </div>

                        <div class="champ_form">
                            <input type="password" data-libelle="confirmer votre nouveau mot de passe" maxlength="16" name="new_mdp2" id="new_mdp2" class="inputForm" placeholder="Confirmer mot de passe"/><i toggle="#new_mdp2" class="far fa-eye fa-lg unhide_mdp"></i>
                        </div>

                    <div class="bouton_form">
                        <input type="submit" value="Envoyer"/>
                        <a href="profil.php"><input type="button" value="Annuler"/></a>
                    </div>
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
<script src="../../scripts/javascript.js" type="text/javascript"></script>