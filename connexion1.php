<?php
session_start();
include_once("./inclusions/connectDB.php");

// Vérification de la saisie de l'email et du mot de passe :
if(!empty($_POST)){
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    // Vérification que l'email et le mot de passe soient bien associés au même utilisateur en BDD :
    $queryVerifConnect = 'SELECT id FROM utilisateur WHERE email="'.$email.'" AND mdp="'.$mdp.'"';
    $resultVerifConnect = $db->query($queryVerifConnect);
    if($resultVerifConnect->execute()){
        $row = $resultVerifConnect->fetchObject();
            if ($row == false) {
                $msgErrorBDD = "<div id=\"error_datasrv\">Votre adresse email ou votre mot de passe est incorrect !<br> Contactez le support en cas de problème.</div>";
            }else{
                // Comme tout est ok, création de la cession de l'utilisateur
                $_SESSION['utilisateur']=$row->id;

                // L'utilisateur est redirigé vers la page Accueil.php
                header('Location: app/Compte/Accueil.php');
                exit();
            }
        }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/style_Melissa.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    </head>

    <body class="backgroundimage">
    <div class="formDesign">
    <!-- ERREUR MDP EXISTE DEJA -->
    <?php
    if(isset($msgErrorBDD)){
        echo $msgErrorBDD;
    }
    ?>
        <h1>Connexion</h1>
        <form action="" method="post" id="connexion1">

            <div class="champs_form_C">
                <div class="label_form_C">
                    <label class="labelprofil_C"  for="email">Adresse e-mail :</label>
                </div>
                <div class="champ_form_C">
                    <input type="text" name="email" id="email" maxlength="50" /><span class="etoile">  *</span>
                </div>

                <div class="label_form_C">
                    <label class="labelprofil_C"  for="email">Mot de passe :</label>
                </div>
                <div class="champ_form_C">
                    <input type="password" name="mdp" id="new_mdp2" maxlength="16" /><span class="etoile">  *</span><i toggle="#new_mdp2" class="far fa-eye unhide_mdp"></i>
                </div>
            </div>

                <div class="bouton_form">
                    <input type="submit" value="Se connecter"/><br><br>
                    <a href="connexion2.php">Mot de passe oublié ?</a>
                </div>

        </form>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>

            // PAGE MOT DE PASSE
            /* afficher/cacher mdp */
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

