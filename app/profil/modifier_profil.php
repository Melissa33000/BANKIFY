<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
session_start();
// Connexion à la database :
include_once ("../../inclusions/connectDB.php");
// Si on a reçu une variable id c'est qu'on est là pour modifier le formulaire
if(!empty($_SESSION)) {
    if (isset($_SESSION['id'])) {
        // Je stocke dans $id c'est plus lisible
        $id = $_SESSION['id'];
        // Si on a reçu une variable id + une variable POST c'est qu'on a modifié un formulaire
        if (!empty($_POST)) {
            // On récupère les données modifiées.
            $civ = $_POST['civilite'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $daten = $_POST['daten'];
            $email = $_POST['email'];
            $adresse = $_POST['adresse'];
            $adresse2 = $_POST['adresse2'];
            $cp = $_POST['cp'];
            $cpville = $_POST['cpville'];
            $pays = $_POST['pays'];
            // ON VERIFIE QUE LE MAIL QUE L'UTILISATEUR RENSEIGNE N'EXISTE PAS DEJA POUR QUELQU'UN D'AUTRE
            $queryVerifMail = 'SELECT count(email) AS nbr FROM utilisateur WHERE id != :id AND email= :email';
            $statementVerifMail = $db->prepare($queryVerifMail);
            $statementVerifMail->bindValue(":id", $id);
            $statementVerifMail->bindValue(":email", $email);
            $statementVerifMail->execute();
            if($row = $statementVerifMail->fetchObject()) {
                $nbrMailBDD = $row->nbr;
                $statementVerifMail->closeCursor();
                if ($nbrMailBDD > 0) {
                    // Requête pour remettre son e-mail actuel dans le champ du profil
                    $query ='SELECT email FROM utilisateur WHERE id=:id';
                    $statement = $db->prepare($query);
                    $statement->bindValue(":id", $id);
                    $statement->execute();
                    if($row = $statement->fetchObject()){
                        $emailBDD = $row->email;
                        $statement->closeCursor();
                    }
                    // Vu que le mail existe déjà on met un message d'erreur
                    $msgErrorBDD = "<div id=\"error_datasrv\">Vous ne pouvez pas utiliser cet e-mail car il est déjà pris par quelqu'un d'autre.<br> Contactez le support en cas de problème.</div>";
                    // + on va mettre une bordure rouge au champ mail + remettre son mail à lui (dans la BDD actuellement)
                    $jsErrorBDD = "<script type=\"text/javascript\">document.getElementById(\"email\").value = \"".$emailBDD."\";document.getElementById(\"email\").style.borderColor = \"#D21929\";document.getElementById(\"email\").focus();</script>";
                }else{
                    // ON EFFECTUE UN UPDATE DANS LA BDD
                    $query = 'UPDATE utilisateur ';
                    $query .= 'INNER JOIN civilite ON utilisateur.id_civilite = civilite.id ';
                    $query .= 'INNER JOIN adresse ON utilisateur.id_adresse = adresse.id ';
                    $query .= 'INNER JOIN cpville ON adresse.id_cpville = cpville.id ';
                    $query .= 'INNER JOIN pays ON pays.id = cpville.id_pays ';
                    $query .= 'SET utilisateur.id_civilite = (SELECT id FROM civilite WHERE libelle = :civ), ';
                    $query .= 'utilisateur.nom = :nom, ';
                    $query .= 'utilisateur.prenom = :prenom, ';
                    $query .= 'utilisateur.date_naissance = :daten, ';
                    $query .= 'utilisateur.email = :email, ';
                    $query .= 'adresse.ligne_adresse = :adresse, ';
                    $query .= 'adresse.ligne_adresse2 = :adresse2, ';
                    $query .= 'adresse.id_cpville = :cp ';
                    $query .= 'WHERE utilisateur.id = :id';

                    // ON PREPARE LA REQUETE ET ON BIND LES CHAMPS
                    $statement = $db->prepare($query);
                    $statement->bindValue(':civ', $civ);
                    $statement->bindValue(':nom', $nom);
                    $statement->bindValue(':prenom', $prenom);
                    $statement->bindValue(':daten', $daten);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':adresse', $adresse);
                    $statement->bindValue(':adresse2', $adresse2);
                    $statement->bindValue(':cp', $cp);
                    $statement->bindValue(':id', $id);
                    //On exécute le tout
                    $statement->execute();
                    $statement->closeCursor();
                    // Redirection vers le récap profil dans 5 secondes pour qu'il voit son nouveau profil :D
                    // On envoie du get à la page profil pour l'affichage du message de confirmation
                    header('Location: profil.php?u=t');
                }
            }
        } else {
            //SI ON A DU GET ID MAIS PAS DU POST ON DOIT JUSTE AFFICHER LES DONNEES ACTUELLES DU CLIENT
            $query = 'SELECT civilite.libelle as civilite, utilisateur.nom, utilisateur.prenom, utilisateur.date_naissance, utilisateur.email, adresse.ligne_adresse, adresse.ligne_adresse2, CONCAT(cpville.cp, \' - \', cpville.ville) as ville, cpville.id AS cp, pays.nom AS pays ';
            $query .= 'FROM utilisateur ';
            $query .= 'INNER JOIN civilite ON utilisateur.id_civilite = civilite.id ';
            $query .= 'INNER JOIN adresse ON utilisateur.id_adresse = adresse.id ';
            $query .= 'INNER JOIN cpville ON adresse.id_cpville = cpville.id ';
            $query .= 'INNER JOIN pays ON pays.id = cpville.id_pays ';
            $query .= 'WHERE utilisateur.id = :id';
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            if ($row = $statement->fetchObject()) {
                $civ = $row->civilite;
                $nom = $row->nom;
                $prenom = $row->prenom;
                $daten = $row->date_naissance;
                $email = $row->email;
                $adresse = $row->ligne_adresse;
                $adresse2 = $row->ligne_adresse2;
                $cpville = $row->ville;
                $cp = $row->cp;
                $pays = $row->pays;
            }
            $statement->closeCursor();
        }
    }// PAS DE GET ID
}else{
    // PAS DE GET PAS DE POST
    header('location:../../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier profil</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>

    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet" class="backModifProfil">
                <!--<header id="headerAPPonglet">
                    <h1>Modification du profil</h1>
                </header>-->
                <!-- ERREUR EMAIL EXISTE DEJA -->
                <?php
                if(isset($msgErrorBDD)){
                    echo $msgErrorBDD;
                }
                ?>
                <!-- ERREUR CHAMPS VIDES JAVASCRIPT -->
                <div id="error_datajs"></div>
                <div class="formulaire2">
                    <form action="" method="post" onsubmit="return verif_formulaire_profil()">

                            <div class="champ_form">
                                <!-- On a une instruction en php qui compare avec la db si la civilité sur client = monsieur ou madame pour le précocher dans le formulaire -->
                                <input type="radio" name="civilite" value="Monsieur" id="civilite_mr" <?php if($civ == "Monsieur"){ echo 'checked'; }  ?>/><label for="civilite_mr" class="labelciv">&nbsp;Mr</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="civilite" value="Madame" id="civilite_mme" <?php if($civ == "Madame"){ echo 'checked'; }  ?>/><label for="civilite_mme" class="labelciv">&nbsp;Mme</label></span><span class="etoile">  *
                            </div>

                            <div class="champ_form">
                                <input type="text" name="nom" id="nom" maxlength="50" onkeyup="return verif_nom()" value="<?php echo $nom; ?>" class="inputForm" placeholder="Nom"/><span id="nomOK" style="width : 27px"></span><span class="etoile"> *</span>
                                <div class="message_erreur" id="error_nom_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <input type="text" name="prenom" id="prenom" maxlength="50" onkeyup="return verif_prenom()" value="<?php echo $prenom; ?>" class="inputForm" placeholder="Prénom"/><span id="prenomOK"></span><span class="etoile">  *</span>
                                <div class="message_erreur" id="error_prenom_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <!-- J'ai mis un onblur sur la date de naissance sinon le message apparait à chaque changement de jour, mois, année et c'est assez relou -->
                                <input type="date" name="daten" onblur="return verif_ddn()" id="dateN" value="<?php echo $daten; ?>" class="inputForm"/><span id="ddnOK"></span><span class="etoile">  *</span>
                                <div class="message_erreur" id="error_ddn_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <input type="text" name="email" id="email" maxlength="50" onkeyup="return verif_mail()" value="<?php echo $email; ?>" class="inputForm" placeholder="E-mail"/><span id="emailOK"></span><span class="etoile">  *</span>
                                <div class="message_erreur" id="error_email_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <input type="text" name="adresse" maxlength="100" onkeyup="return verif_adresse()" id="adresse" value="<?php echo $adresse; ?>" class="inputForm" placeholder="Adresse"/><span id="adresseOK"></span>
                                <div class="message_erreur" id="error_adresse_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <input type="text" name="adresse2" maxlength="100" onkeyup="return verif_adresse2()" id="adresse2" value="<?php echo $adresse2; ?>" class="inputForm" placeholder="Compément d'adresse"/><span id="adresse2OK"></span>
                                <div class="message_erreur" id="error_adresse2_contenu"></div>
                            </div>

                            <div class="champ_form">
                                <input type="text" id="cp" name="cpville" onblur="return verif_cpville()" value="<?php echo $cpville; ?>" autocomplete="off" class="inputForm" placeholder="Code Postal"/><span id="cpvilleOK"></span><span class="etoile"> *</span>
                                <div class="message_erreur" id="error_cp_contenu"></div>
                                <input type="hidden" id="idcp" name="cp" value="<?php echo $cp; ?>"/>
                            </div>

                            <div class="champ_form">
                                <input type="text" id="pays" name="pays" value="<?php echo $pays; ?>"  readonly autocomplete="off" class="inputForm" placeholder="Pays"/><i class="far fa-question-circle" data-info="Le pays sera automatiquement attribué selon votre code postal et votre ville à la validation du formulaire." id="icoInfo"></i>
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        /* autocomplete cp-ville */
        $('#cp').autocomplete({
            source : "../budget/api.php",
            minLength : 2,
            select: function(event, ui){
                $('#cp').val(ui.item.ville);
                $('#idcp').val(ui.item.id);
                console.log(ui.item.id);
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item){
            return $('<option value="' + item.id + '">' + item.ville + '</option>').appendTo(ul);

        };
    });//
</script>
<!-- On fait apparaitre un script qui va reset le champ e-mail + focus + bordure rouge si l'adresse existe déjà dans la BDD -->
<?php
if(isset($jsErrorBDD)){
   echo $jsErrorBDD;
}
?>