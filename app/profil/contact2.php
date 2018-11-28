<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
session_start();
include_once("../../inclusions/connectDB.php");
if(!empty($_SESSION) AND isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    if(!empty($_GET['i'])){
        $insert = $_GET['i'];
        if($insert === 't'){
            // Affichage d'un message de confirmation
            $msgSuccess = "<div id=\"success_datasrv\">Votre message a bien été envoyé ! Vous recevrez la réponse sur votre boîte mail.</div>";
        }
    }
    $query = 'SELECT nom, prenom, email FROM utilisateur WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    if($statement->execute()){
        if($row = $statement->fetchObject()){
            $nom = $row->nom;
            $prenom = $row->prenom;
            $email = $row->email;
            $statement->closeCursor();
        }
    }else{
        echo 'Erreur de préparation de la requête de sélection des informations de l\'utilisateur !';
        var_dump($statement->errorInfo());
    }
    if(!empty($_POST)){
        $msgErrorBDD = "";
        $msgSuccess = "";
        // Vérification qu'il n'y a pas déjà plus de 2 messages non répondus de cette personne pour éviter le spam
        $query = 'SELECT count(id) AS nbrMsg FROM message WHERE id_utilisateur = :id AND etat = false';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        if($row = $statement->fetchObject()){
            $nbrMsg = $row->nbrMsg;
            if($nbrMsg >= 2){
                $msgErrorBDD = "<div id=\"error_datasrv\">Vous ne pouvez pas envoyer ce message car il semblerait que vous ayez déjà 2 messages non répondus.<br> Merci d'attendre une réponse du support !</div>";
            }else{
                $objetMsg = htmlspecialchars($_POST['objetMsg']);
                $msg = htmlspecialchars($_POST['msg']);

                $query = 'INSERT INTO message(objet, message, etat, id_utilisateur) ';
                $query .= 'VALUES(:objet, :msg, false, :id)';
                try{
                    $statement = $db->prepare($query);
                    $statement->bindValue(":objet", $objetMsg);
                    $statement->bindValue(":msg", $msg);
                    $statement->bindValue(":id", $id);
                    if($statement->execute()){
                        header('location: contact2.php?i=t');
                    }else{
                        echo 'Erreur lors de l\'ajout du message dans la BDD';
                        var_dump($statement->errorInfo());
                    }
                }catch(Exception $e){
                    echo 'Il semblerait que la préparation de la requête ne se soit pas bien passée...';
                    print($e->getMessage());
                }

            }
        }else{
            echo 'Il semble qu\'il y a eu une erreur lors de la requête qui compte le nombre de messages';
        }
    }else{
        // Pas de POST
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
                <!-- ERREUR DEJA PLUS DE DEUX MESSAGES NON REPONDUS POUR CET UTILISATEUR -->
                <?php
                if(isset($msgErrorBDD)){
                    echo $msgErrorBDD;
                }
                ?>
                <!-- SUCCESS ENVOI  -->
                <?php if(isset($msgSuccess)){ echo $msgSuccess;} ?>
                <div id="pageContact">
                    <div id="texteContact">
                        <h1>Contact</h1>
                        <p>
                            Vous recontrez un problème ?<br>
                            Vous avez constaté un bug ?<br>
                            Vous voulez nous dire bonjour ?
                        </p>
                        <p>
                            Ce formulaire est à votre disposition pour toutes ces possibilités et bien plus encore !<br>
                            Nous vous promettons de vous répondre dans les plus brefs délais.
                        </p>
                    </div>
                    <div id="formContact">
                        <form action="" method="post" onsubmit="return verif_formulaire_contact()">
                            <input type="text" placeholder="Objet du message" name="objetMsg"/>
                            <textarea title="Message" placeholder="Votre message" name="msg"></textarea>
                            <div>
                                <input type="submit" value="Envoyer">
                                <input type="button" value="Annuler">
                            </div>
                        </form>
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
    $('#option2').css("border-bottom","3px solid black");
    $('#option2').css("background","radial-gradient(circle at bottom left, #ffd11a, #F5701B, #FD3F4F, #C02382, #7855c3, #6666ff, #2E94F8, #39ac39)");
    $('#option2').css("-webkit-background-clip","text");
    $('#option2').css("-webkit-text-fill-color","transparent");
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>

