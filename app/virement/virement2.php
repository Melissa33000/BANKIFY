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
$SQLStatement = $db->prepare($SQLQuery);
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
$SQLStatement = $db->prepare($SQLQuery);
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
        <title>Effectuer un virement</title>
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
                <h1>Effectuer un virement</h1>
            </header>

            <section class="virement">
                <form action="virement2.traitement.php" method="post" class="virement">
                    <fieldset class="positionnement">
                        <table>
                            <tr>
                                <div class="titrevirement">COMPTE EMETTEUR</div>
                                <td><span class ="policevirement">Nom du Compte :</span> <?php echo $SQLResultCompteEmetteur->nom ?></td>
                                    <td><span class ="policevirement espacement">Solde actuel :</span> <?php echo $SQLResultCompteEmetteur->solde_initial ?></td>
                                    <input type="hidden" value="<?php echo $idEmetteur ?>" name="id_compteemetteur">
                            </tr>
                            <tr>
                                <td><span class ="policevirement">Numéro du Compte :</span>  <?php echo $SQLResultCompteEmetteur->numero ?></td>
                                <td><span class ="policevirement espacement" >Solde théorique :</span> <span id="soldeTEmetteurheoriqueApresVirement"> </span></td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="positionnement">
                        <table>
                            <tr>
                                <div class="titrevirement">COMPTE BENEFICIAIRE</div>
                                <td><span class ="policevirement">Nom du Compte :</span> <?php echo $SQLResultCompteBeneficiaire->nom ?></td>
                                <td><span class ="policevirement espacement">Solde actuel:</span> <?php echo $SQLResultCompteBeneficiaire->solde_initial ?></td>
                                <input type="hidden" value="<?php echo $idBeneficiaire ?>" name="id_comptebeneficiaire">
                            </tr>
                            <tr>
                                <td><span class ="policevirement">Numéro du Compte :</span> <?php echo $SQLResultCompteBeneficiaire->numero ?></td>
                                <td><span class ="policevirement espacement">Solde théorique :</span><span id="soldeBeneficiaireTheoriqueApresVirement"> </span></td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="positionnement">
                        <table>
                            <div class="titrevirement">OPERATION</div>
                            <div class ="policevirement">Montant :
                                <!-- Le "step=any c'est pour permettre de mettre des virgules, sinon par défaut le type number n'accepte pas les virgules -->
                                <input type="number" class="virementencart" id="montant" step="any" value=" " name="montant">
                            </div>
                            <label class ="policevirement" for="nomdeloperation">Nom de l'opération : </label>
                            <input type="text" class="virementencart"  id="nomdeloperation" name="nomdeloperation" maxlength="100" onkeyup="return nom_op()"/><br>
                            <div id="error_nomdeloperation_contenu"></div>

                            <label for="infoscomplementaires" class ="policevirement" >Informations complémentaires :</label><br>
                            <textarea class="virementencart"  id="infoscomplementaires" name="infoscomplementaires" maxlength="200" onkeyup="return infosup()" rows="4" cols="60"></textarea><br>
                            <div id="error_infoscomplementaires_contenu"></div>
                            <!--<label for="frequence">Frequence : </label>
                            <select size="1" id="frequence" name="frequence">
                                <option value="1" selected>Unique</option>
                                <option value="2">Hebdomadaire</option>
                                <option value="3">Mensuelle</option>
                                <option value="4">Trimestrielle</option>
                                <option value="5">Semestrielle</option>
                                <option value="Annuelle">Annuelle</option>
                            </select><br>-->
                            <div class="bouton_designvirement">
                                <input type="submit" id="valider" value="Valider"/>
                                <input type="reset" id="annuler" value="Annuler"/>
                            </div>
                        </table>
                    </fieldset>
                </form>
            </section>
        </section>
    </div>

            <!-- FOOTER -->
            <?php include_once("../../inclusions/footer.php"); ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript">
                // Coloriser l'onglet quand on est sur la page, je rajoute "selected" à la classe pour ne pas avoir de bug avec le "onmouseover"
                $(document).ready(function(){
                    $$('.navAPPli5').addClass('selected');
                    $('.navAPPli5').css('background-color', '#5F90E8');
                    $('.navAPPli5').css('cursor', 'pointer');
                    $('.navAPPli5').css('box-shadow', '5px 5px 5px black');
                    $('.navAPPli5').css('box-shadow', '5px 0px 3px black');
                    $('.navAPPli5').css('text-shadow', '#000 2px 2px 2px');
                });

            </script>
            <script src="../../scripts/javascript.js" type="text/javascript"></script>
            <script>
                function infosup(){
            var infoscomplementaires=document.getElementById("infoscomplementaires").value;
            var erreur_contenu = document.getElementById("error_infoscomplementaires_contenu");

            if(infoscomplementaires == ""){
                return true;
            }
            if(infoscomplementaires.length > 200){
                erreur_contenu.textContent = "Caractères max : 200";
                $('#error_infoscomplementaires_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 200 caractères\" id=\"icoInfo\"></i>");
                erreur_contenu.style.color = "#D21929";
                return false;
            }
            if(infoscomplementaires.length == 200){
                erreur_contenu.textContent = "Caractères max : 200";
                $('#error_infoscomplementaires_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 200 caractères pour ce champ\" id=\"icoInfo\"></i>");
                erreur_contenu.style.color = "#000";
                return true;
            }
            erreur_contenu.textContent = "";
                return true;
            }
            </script>
            <script>
                function nom_op(){
                    var nomdeloperation=document.getElementById("nomdeloperation").value;
                    var erreur_contenu = document.getElementById("error_nomdeloperation_contenu");

                    if(nomdeloperation == ""){
                        return true;
                    }
                    if(nomdeloperation.length > 100){
                        erreur_contenu.textContent = "Caractères max : 100";
                        $('#error_nomdeloperation_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
                        erreur_contenu.style.color = "#D21929";
                        return false;
                    }
                    if(nomdeloperation.length == 100){
                        erreur_contenu.textContent = "Caractères max : 100";
                        $('#error_nomdeloperation_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
                        erreur_contenu.style.color = "#000";
                        return true;
                    }
                    erreur_contenu.textContent = "";
                    return true;
                }
            </script>
            <script>
                // Fonction pour que les soldes des 2 comptes changent en fonction du montant renseigné par l'utilisateur
                var decouvert_autorise = <?php echo $SQLResultCompteEmetteur->decouvert_max ?>

                    // Keyup :fonction pour qu'à chaque relachement de touche, le calcul s'exécute
                    $('#montant').keyup(function()
                    {
                        // parseFloat : fonction pour transformer un string en chiffre à virgule
                        var solde_final = parseFloat(<?php echo $SQLResultCompteEmetteur->solde_initial ?>) - parseFloat($('#montant').val());
                        $('#soldeTEmetteurheoriqueApresVirement').html(solde_final);

                        var solde_final = parseFloat(<?php echo $SQLResultCompteBeneficiaire->solde_initial ?>) + parseFloat($('#montant').val());
                        $('#soldeBeneficiaireTheoriqueApresVirement').html(solde_final);
                    });

                // Fonction dans le cas où le découvert autorisé est dépassé
                // PLUS TARD : Le réadapter avec un plus joli design pour l'alerte
                $('.virement').submit(function()
                {
                    var solde_final = parseFloat(<?php echo $SQLResultCompteEmetteur->solde_initial ?>) - parseFloat($('#montant').val());
                    if(solde_final<decouvert_autorise){
                        alert("Le découvert autorisé est dépassé");
                        return false;
                    }
                    else if(solde_final<0){
                        // Si l'utilisateur clique sur confirm, cela renvoie le formulaire
                        return confirm("Souhaitez vous confirmer votre virement malgré le découvert engendré ?");
                    }
                });

    </script>
    </body>
</html>