<?php
include_once("./inclusions/connectDB.php");

// Vérification de la saisie de l'email
if(!empty($_POST['email'])) {
    $email = $_POST['email'];

    // Sélection dans la BDD des données de l'utilisateur dont l'e-mail a été saisi
    $SQLStatement = $dbConn->prepare('SELECT * FROM Utilisateur WHERE email = :email');
    $SQLStatement->bindValue(':email', $_POST['email']);

    if (!$SQLStatement->execute()) {
        print("il y a eu un problème avec la base de données<br />");
        var_dump($SQLStatement->errorInfo());
        die();
    }
    $SQLResult = $SQLStatement->fetchObject();
    $SQLStatement->closeCursor();

    // Vérification que les données renvoyées par la BDD ne sont pas vides
    if (!isset($SQLResult->email)) {
        $msgErrorBDD = "<div id=\"error_datasrv\">Vous ne pouvez pas utiliser cet e-mail car il est déjà pris par quelqu'un d'autre.<br> Contactez le support en cas de problème.</div>";
        $jsErrorBDD = "<script type=\"text/javascript\">document.getElementById(\"email\").value = \"\";document.getElementById(\"email\").style.borderColor = \"#D21929\";document.getElementById(\"email\").focus();</script>";
    } else {
        // Création d'un nouveau mot de passe
        function genererChaineAleatoire($longueur = 16)
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($longueur / strlen($x)))), 1, $longueur);
        }

        //Utilisation de la fonction
        $NouveauMotPasse = genererChaineAleatoire(16);

        // Enregistrement de ce mot de passe dans la BDD
        $SQLStatement = $dbConn->prepare('UPDATE Utilisateur set mdp = :new_mdp WHERE email = :email');
        $SQLStatement->bindValue(':email', $_POST['email']);
        $SQLStatement->bindValue(':new_mdp', $NouveauMotPasse);

        if (!$SQLStatement->execute()) {
            print("Erreur d'exécution de la requête d'insertion !<br />");
            var_dump($SQLStatement->errorInfo());
            die();
        }
        $msgMail = "<div id=\"success_datasrv\">Vous avez reçu par email votre mot de passe</div>";
    }
}
    // A finir = Envoi de l'email avec le nouveau mot de passe

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mot de passe oublié</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/style_Melissa.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    </head>

    <body class="backgroundimage">
        <div class="formDesign">
        <?php
        if(isset($msgMail)){
            echo $msgMail;
        }
        ?>
        <!-- ERREUR MDP EXISTE DEJA -->
        <?php
        if(isset($msgErrorBDD)){
            echo $msgErrorBDD;
        }
        ?>
            <h1>Mot de passe oublié</h1>
            <form action="" method="post" id="connexion2">

                <div class="champs_form_C">
                    <div class="label_form_C">
                        <label class="labelprofil_C"  for="email">Adresse e-mail :</label>
                    </div>
                    <div class="champ_form_C">
                        <input type="text" name="email" id="email" maxlength="50" onkeyup="return verif_mail()"/><span class="etoile">  *</span>
                    </div>
                </div>

                    <div class="bouton_form">
                        <input type="submit" value="Valider"/>
                        <input type="reset" value="Annuler"/></a>
                    </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            // PAGE MOT DE PASSE
            /* afficher/cacher mdp
             ToggleClass var intervertir les deux champs. Par exemple si class="fa-eye" il va changer par class="fa-eye-slash" et inversement.
            L'icone est "reliée" à son champ mdp car dans son attribut toggle elle renseigne son id. */
            $('.unhide_mdp').click(function(){
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                console.log(input);
                if(input.attr("type") == "password"){
                    input.attr("type", "text");
                }else{
                    input.attr("type", "password");
                }
            });
        </script>

    </body>
</html>

                   
