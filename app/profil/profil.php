<noscript>
    <meta http-equiv="refresh" content="0; url=../404.php" />
</noscript>
<?php
session_start();
include_once("../../inclusions/connectDB.php");
include_once("../../inclusions/fonctions.php");
if(!empty($_SESSION) AND isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    if(!empty($_GET['u'])){
        $update = $_GET['u'];
        if($update === 't'){
            // Affichage d'un message de confirmation
            $msgSuccess = "<div id=\"success_datasrv\">Votre profil a correctement été mis à jour !</div>";
        }
    }
    if(!empty($_GET['id'])){
        $userToDelete = $_GET['id'];
        $query = 'CALL proc_deleteUtilisateur(:userToDelete)';
        try{
            $statement = $db->prepare($query);
            $statement->bindValue(":userToDelete", $userToDelete);
            if($statement->execute()){
                session_destroy();
                header('location: ../../index.php');
                exit;
            }else{
                print("Erreur d'exécution de la requête de suppression !<br />");
                var_dump($statement->errorInfo());
            }
        }catch(Exception $e){
            print("Erreur de préparation de la requête de suppression !<br />");
            print($e->getMessage());
        }
    }
}else{
    header('location:../../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Options de profil</title>
        <?php include("../../inclusions/head.php"); ?>
    </head>
    <body id="bodyOnglet">
        <!-- HEADER -->
        <?php include_once("../../inclusions/headerAPP.php"); ?>
        <div id="navPage">
            <!-- NAV-->
            <?php include_once("../../inclusions/navAPP.php"); ?>
            <!-- PAGE / CONTENU ONGLET -->
            <section id="pageOnglet" class="backProfil">
                <!--<header id="headerAPPonglet">
                    <h1>Mon profil</h1>
                </header>-->
                <!-- SUCCESS MODIF  -->
                <?php if(isset($msgSuccess)){ echo $msgSuccess;} ?>
                <div id="pageProfil">
                    <div class="infosProfil">
                            <?php
                            include_once("../../inclusions/fonctions.php");
                            $query = 'SELECT civilite.libelle as civilite, utilisateur.nom, utilisateur.prenom, utilisateur.date_naissance, utilisateur.email, adresse.ligne_adresse, adresse.ligne_adresse2, cpville.cp, cpville.ville, pays.nom AS pays ';
                            $query .= 'FROM utilisateur ';
                            $query .= 'INNER JOIN civilite ON utilisateur.id_civilite = civilite.id ';
                            $query .= 'INNER JOIN adresse ON utilisateur.id_adresse = adresse.id ';
                            $query .= 'INNER JOIN cpville ON adresse.id_cpville = cpville.id ';
                            $query .= 'INNER JOIN pays ON pays.id = cpville.id_pays ';
                            $query .= 'WHERE utilisateur.id =:id';
                            $statement = $db->prepare($query);
                            $statement->bindValue(":id", $id);
                            $statement->execute();
                            $script = "";
                            if ($row = $statement->fetchObject()) {
                                $civ = $row->civilite;
                                $nom = $row->nom;
                                $prenom = $row->prenom;
                                $daten = $row->date_naissance;
                                $email = $row->email;
                                $adresse = $row->ligne_adresse;
                                $adresse2 = $row->ligne_adresse2;
                                $cp = $row->cp;
                                $ville = $row->ville;
                                $pays = $row->pays;
                            }
                            $statement->closeCursor();
                            ?>
                            <p><span class="infoBDD"><?php echo $civ; ?></span> <span class="infoBDD"><?php echo $nom; ?></span> <span class="infoBDD"><?php echo $prenom; ?></span> née le <span class="infoBDD"><?php echo convertirDate($daten); ?></span></p>
                            <p>Joignable à l'adresse "<span class="infoBDD"><?php echo $email; ?></span>"</p>
                            <p>Résidant <span class="infoBDD"><?php echo $adresse; ?></span>, <span class="infoBDD"><?php echo $adresse2; ?></span><br>
                                <span class="infoBDD"><?php echo $cp; ?></span> <span class="infoBDD"><?php echo $ville; ?></span> en <span class="infoBDD"><?php echo $pays; ?></span>.</p>

                    </div>
                    <div class="options_profil">
                        <div class="option_profil"><a href="modifier_profil.php"><input type="button" value="Modifier mon profil"/></a></div>
                        <div class="option_profil"><a href="modifier_mdp.php"><input type="button" value="Changer mon mot de passe"/></a></div>
                        <a href="../deconnexion.php"><div class="option_profil"><input type="button" value="Me déconnecter"/></div></a>
                        <a href="profil.php?id=<?php echo $id; ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer votre compte et toutes ses informations ?\nCette opération est irréversible !');"><div class="option_profil" ><input type="button" value="Supprimer mon compte"/></div></a>
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
    $('#option1').css("border-bottom","3px solid black");
    $('#option1').css("background","radial-gradient(circle at bottom left, #ffd11a, #F5701B, #FD3F4F, #C02382, #7855c3, #6666ff, #2E94F8, #39ac39)");
    $('#option1').css("-webkit-background-clip","text");
    $('#option1').css("-webkit-text-fill-color","transparent");
</script>
<script src="../../scripts/javascript.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Fonction pour masquer le message de confirmation de modification du formulaire après un certain délais.
        setTimeout(function(){
            $("#success_datasrv").css('visibility', 'hidden');
            }, 3000);
    });
</script>