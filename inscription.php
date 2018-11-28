<?php
include_once("./inclusions/connectDB.php");

$erreur = false;

if(!empty($_POST)){

    // echo $_POST['civilite'].$_POST['nom'].$_POST['prenom'].$_POST['dateN'].$_POST['adresse'].$_POST['adresse2'].$_POST['cp'].$_POST['ville'].$_POST['pays'].$_POST['email'].$_POST['mdp'].$_POST['confirmmdp'];

    // Vérification de l'existence des données obligatoires
    if(empty($_POST['civilite']) && empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['dateN']) && empty($_POST['email']) && empty($_POST['mdp']) && empty($_POST['confirmmdp']) && empty($_POST['cp']) && empty($_POST['ville']) && empty($_POST['confirmm'])){
        $erreur = true;
    }

    // Les différentes données qui sont non obligatoires et dont les champs peuvent ne pas être renseignées
    if(!empty($_POST['adresse'])){
        $adresse = $_POST['adresse'];
    } else {
        $adresse = "";
    }

    if(!empty($_POST['adresse2'])){
        $adresse2 = $_POST['adresse2'];
    } else {
        $adresse2 = "";
    }

    // Vérification que le mot de passe et que sa confirmation soient identiques
    if ($_POST['mdp'] != $_POST['confirmmdp']){
        $erreur = true;
        $msgError="Les mots de passe ne se correspondent pas !";
        print($msgError);
    }

    // En cas d'erreur constaté alors :
    if ($erreur == true) {
        print("Problème lors de la saisie des données");
        die();
    }

    if(isset($_POST['email'])) {
        $email=$_POST['email'];
        // Vérification que l'EMAIL saisie par l'Utilisateur n'existe pas déjà pour quelqu'un d'autre
        $queryVerifMail = 'SELECT count(email) AS nbr FROM utilisateur WHERE email="' . $email . '"';
        $resultVerifMail = $db->query($queryVerifMail);
        if ($row = $resultVerifMail->fetchObject()) {
            $nbrMailBDD = $row->nbr;
            if ($nbrMailBDD > 0) {
                $msgErrorBDD = "<div id=\"error_datasrv\">Vous ne pouvez pas utiliser cet e-mail car il est déjà pris par quelqu'un d'autre.<br> Contactez le support en cas de problème.</div>";
                $jsErrorBDD = "<script type=\"text/javascript\">document.getElementById(\"email\").value = \"\";document.getElementById(\"email\").style.borderColor = \"#D21929\";document.getElementById(\"email\").focus();</script>";
            }else{


                // ETAPES pour le remplissage de la table ADRESSE dans la BDD
                if($adresse != null and $adresse2 != null ){

                    // Insertion des données dans la table ADRESSE :
                    $SQLQuery = 'INSERT INTO adresse(ligne_adresse, ligne_adresse2, id_cpville) VALUES (:adresse_1, :adresse_2, (SELECT id FROM cpville WHERE cp = :cp AND ville = :ville))';
                    $SQLStatement = $db->prepare($SQLQuery);
                    $SQLStatement->bindValue(':adresse_1', $adresse);
                    $SQLStatement->bindValue(':adresse_2', $adresse2);
                    $SQLStatement->bindValue(':cp', $_POST['cp']);
                    $SQLStatement->bindValue(':ville', $_POST['ville']);

                    // Exécution de la requête :
                    if (!$SQLStatement->execute()) {
                        print("Erreur d'exécution de la requête d'insertion de l'Adresse !<br />");
                        var_dump($SQLStatement->errorInfo());
                        die();
                    }
                }

                // Remplissage de la table UTILISATEUR dans la BDD
                $SQLQuery = 'INSERT INTO utilisateur(nom, prenom, date_naissance, email, mdp, id_civilite, id_adresse) VALUES (:nom, :prenom, :ddn, :email, :motdepasse, (SELECT id from civilite WHERE libelle=:civilite), (SELECT id FROM adresse WHERE id = last_insert_id()))';
                $SQLStatement = $db->prepare($SQLQuery);
                $SQLStatement->bindValue(':nom', $_POST['nom']);
                $SQLStatement->bindValue(':prenom', $_POST['prenom']);
                $SQLStatement->bindValue(':ddn', $_POST['dateN']);
                $SQLStatement->bindValue(':email', $_POST['email']);
                $SQLStatement->bindValue(':motdepasse', $_POST['mdp']);
                $SQLStatement->bindValue(':civilite', $_POST['civilite']);

                // Exécution de la requête :
                if (!$SQLStatement->execute()) {
                    print("Erreur d'exécution de la requête d'insertion !<br />");
                    var_dump($SQLStatement->errorInfo());
                    die();
                }

                // Redirection de l'utilisateur vers la page accueilenattendant.php
                header('Location: accueilenattendant.php'); // Note pour plus tard : Modifier le nom par Accueil.php (page codée par Aurélien)
                exit();
            }
        }
    }
}
else {
    //REQUETE SQL POUR aller chercher les données dans cpville
    $queryVerifCp = 'SELECT * FROM cpville';
    $resultVerifCp = $db->query($queryVerifCp);
    $cpvilleresult = $resultVerifCp->fetchAll();

}

?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/style_Melissa.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    </head>
    <body class="backgroundimage">
    <div class="formDesign formAjust">
        <h1>Formulaire d'inscription</h1>
        <form id="inscription" action="" method="post" onsubmit="return verif_formulaire_profil()">
            <!-- ERREUR MDP EXISTE DEJA -->
            <?php
            if(isset($msgErrorBDD)){
                echo $msgErrorBDD;
            }
            ?>
            <!-- ERREUR CHAMPS VIDES JAVASCRIPT -->
            <div id="error_datajs"></div>

            <div class="champs_form">
                <div class="label_form">
                    <label class="labelciv2">Civilité :</label> <!-- &nbsp; c'est pour créer un espace qui se voit en html -->
                </div>
                <div class="champ_form">
                    <!-- On a une instruction en php qui compare avec la db si la civilité sur client = monsieur ou madame pour le précocher dans le formulaire -->
                    <input type="radio" name="civilite" value="Monsieur" id="civilite_mr" /><label for="civilite_mr" class="labelciv">&nbsp;Mr</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="civilite" value="Madame" id="civilite_mme" /><label for="civilite_mme" class="labelciv">&nbsp;Mme</label><span class="etoile">&nbsp;&nbsp;*</span>
                </div>

                <div class="label_form">
                    <label class="labelprofil" for="nom">Nom :</label>
                </div>
                <div class="champ_form">
                    <input type="text" name="nom" id="nom" maxlength="50" onkeyup="return verif_nom()"/><span class="etoile">  *</span>
                    <div class="message_erreur" id="error_nom_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="prenom">Prénom :</label>
                </div>
                <div class="champ_form">
                    <input type="text" name="prenom" id="prenom" maxlength="50" onkeyup="return verif_prenom()"/><span class="etoile">  *</span>
                    <div class="message_erreur" id="error_prenom_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="dateN">Date de naissance :</label>
                </div>
                <div class="champ_form">
                    <!-- J'ai mis un onblur sur la date de naissance sinon le message apparait à chaque changement de jour, mois, année et c'est assez relou -->
                    <input type="date" name="dateN" id="dateN" onblur="return verif_ddn()/><span class="etoile">  *</span>
                    <div class="message_erreur" id="error_ddn_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="adresse">Adresse :</label>
                </div>
                <div class="champ_form">
                    <input type="text" name="adresse" maxlength="100" onkeyup="return verif_adresse()" id="adresse"/><br/>
                    <div class="message_erreur" id="error_adresse_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="adresse2">Adresse ligne 2 :</label>
                </div>
                <div class="champ_form">
                    <input type="text" name="adresse2" maxlength="100" onkeyup="return verif_adresse2()" id="adresse2"/><br/>
                    <div class="message_erreur" id="error_adresse2_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="cp">Code postal :</label>
                </div>
                <div class="champ_form">
                    <select name="cp"  id="cp">
                        <?php
                        foreach ($cpvilleresult as $cp){
                            echo '<option value="'.$cp['cp'].'">'.$cp['cp'].'</option>';
                        }
                        ?>
                    </select><br/>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="ville">Ville :</label>
                </div>
                <div class="champ_form">
                    <select name="ville" id="ville">
                        <?php
                        foreach ($cpvilleresult as $cp){
                            echo '<option value="'.$cp['ville'].'">'.$cp['ville'].'</option>';
                        }
                        ?>
                    </select><br/><br/>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="email">Adresse e-mail :</label>
                </div>
                <div class="champ_form">
                    <input type="text" name="email" id="email" maxlength="50" onkeyup="return verif_mail()"/><span class="etoile">  *</span>
                    <div class="message_erreur" id="error_email_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="email">Mot de passe :</label>
                </div>
                <div class="champ_form">
                    <input type="password" name="mdp" id="new_mdp" maxlength="16" data-libelle="renseigner votre mot de passe" onkeyup="return verif_complexity_mdp()"/><span class="etoile">  *</span><i toggle="#new_mdp" class="far fa-eye unhide_mdp"></i>
                    <div class="message_erreur" id="error_newmdp_contenu"></div>
                </div>

                <div class="label_form">
                    <label class="labelprofil"  for="email">Confirmer le mot de passe :</label>
                </div>
                <div class="champ_form">
                    <input type="password" name="confirmmdp" id="new_mdp2" data-libelle="confirmer votre mot de passe"/><span class="etoile">  *</span><i toggle="#new_mdp2" class="far fa-eye unhide_mdp"></i>
                </div>
            </div>

            <div class="bouton_design">
                <input type="submit" value="Envoyer"/>
                <a href="accueilenattendant.php"><input type="reset" value="Annuler"/></a>
            </div>

        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="inscription.script.js"></script>

    </body>
    </html>

    <!-- On fait apparaitre un script qui va reset le champ e-mail + focus + bordure rouge si l'adresse existe déjà dans la BDD -->
<?php
if(isset($jsErrorBDD)){
    echo $jsErrorBDD;
}
?>