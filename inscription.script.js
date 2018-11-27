//PAGE INSCRIPTION - CONNEXION 1 - CONNEXION 2
function verif_nom(){
    var nom = document.getElementById("nom").value;
    var erreur_contenu = document.getElementById("error_nom_contenu");
    var champ_nom = document.getElementById("nom");
    // Le nom doit commencer par Lettre maj ou minuscule ou accent maj ou minuscule
    // Le milieu peut comporter - ou espace ou ' (certains nom en sont composés)
    // Il doit se terminer pareil que pour le commencement
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var nomOk = reg.test(nom);

    if (!nomOk){
        erreur_contenu.textContent = "Nom invalide";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (nom.length >= 50) {
            erreur_contenu.textContent = "Nom invalide & Caractères max : 50";
            $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Vu que c'est un champ obligatoire j'ai rajouté ce message s'il rempli et puis efface.
        if(nom == ""){
            erreur_contenu.textContent = "Nom obligatoire";
            champ_nom.style.borderColor = "#D21929";
        }
        return false;
    }
    if (nom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    // On return true ici car c'est juste informatif, le formulaire est valide s'il est à 50 car c'est la limite
    if (nom.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_nom.style.borderColor = "";
    return true;
}

function verif_prenom(){
    var prenom = document.getElementById("prenom").value;
    var erreur_contenu = document.getElementById("error_prenom_contenu");
    var champ_prenom = document.getElementById("prenom");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var prenomOk = reg.test(prenom);
    if(!prenomOk) {
        erreur_contenu.textContent = "Prénom invalide";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (prenom.length >= 50) {
            erreur_contenu.textContent = "Prénom invalide & Caractères max : 50";
            $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        if(prenom == ""){
            erreur_contenu.textContent = "Prénom obligatoire";
            champ_prenom.style.borderColor = "#D21929";
        }
        return false;
    }
    if (prenom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (prenom.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_prenom.style.borderColor = "";
    return true;
}

function verif_ville(){
    var ville = document.getElementById("ville").value;
    var erreur_contenu = document.getElementById("error_ville_contenu");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var villeOk = reg.test(ville);
    if (!villeOk){
        erreur_contenu.textContent = "Ville invalide";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (ville.length >= 50) {
            erreur_contenu.textContent = "Ville invalide & Caractères max : 50";
            $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Je rajoute cette condition car le champ n'étant pas obligatoire je ne veux pas qu'il m'affiche un message d'erreur
        if(ville == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if (ville.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (ville.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_pays(){
    var pays = document.getElementById("pays").value;
    var erreur_contenu = document.getElementById("error_pays_contenu");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var paysOk = reg.test(pays);

    if (!paysOk){
        erreur_contenu.textContent = "Pays invalide";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (pays.length >= 50) {
            erreur_contenu.textContent = "Pays invalide & Caractères max : 50";
            $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        if(pays == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if (pays.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (pays.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

// la fonction verif DDN est là pour qu'il y ait un message indiquant que la DDN est obligatoire si la personne l'indique et l'efface (vu que l'option est sur nom, prénom et mail : ça fait mieux)
function verif_ddn(){
    var ddn = document.getElementById("dateN").value;
    var champ_ddn = document.getElementById("dateN");
    var erreur_contenu = document.getElementById("error_ddn_contenu");
    if (!ddn){
        erreur_contenu.textContent = "Date de naissance obligatoire";
        erreur_contenu.style.color = "#D21929";
        champ_ddn.style.borderColor = "#D21929";
        return false;
    }
    erreur_contenu.textContent = "";
    champ_ddn.style.borderColor = "";
    return true;
}

function verif_mail(){
    var email = document.getElementById("email").value;
    var erreur_contenu = document.getElementById("error_email_contenu");
    var champ_mail = document.getElementById("email");
    // Va vérifier si l'email respecte bien la structure de base :
    // Ne doit commencer que par une lettre minuscule ou majuscule ou un chiffre
    // Ensuite au moins un caractère type lettre min, maj, chiffre, . _ -
    // Ensuite, avant le @, je ne veux pas autoriser les . - et _ ça me parait bizarre et je ne suis pas sûre que ce soit autorisé
    // Ensuite un seul @ obligatoire
    // Ensuite pareil qu'à l'étape 2 mais sans le _ et le .
    //Ensuite un seul . obligatoire
    //Pour terminer minimum 2 et maximum 3 caractères type lettre minuscule (fr, com, be etc)
    var reg = /^[A-Za-z0-9][\w.-]*[A-Za-z0-9]@{1}[a-z0-9-]+\.{1}[a-z]{2,3}$/g;
    var mailOk = reg.test(email);
    if (!mailOk){
        erreur_contenu.textContent = "E-mail invalide";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Types de structures acceptées : Ex.3m-pl_e@dom-aine.com , 8eXem_pl.e2@hotmail.fr\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (email.length >= 50) {
            erreur_contenu.textContent = "E-mail invalide & Caractères max : 50";
            $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Types de structures acceptées : Ex.3m-pl_e@dom-aine.com , 8eXem_pl.e2@hotmail.fr et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Vu que c'est un champ obligatoire j'ai rajouté ce message s'il rempli et puis efface.
        if(email == ""){
            erreur_contenu.textContent = "E-mail obligatoire";
            champ_mail.style.borderColor = "#D21929";
        }
        return false;
    }
    if (email.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (email.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_mail.style.borderColor = "";
    return true;
}

function verif_adresse(){
    var adresse=document.getElementById("adresse").value;
    var erreur_contenu = document.getElementById("error_adresse_contenu");
    // On veut vérifier que l'adresse respecte différents critère :
    // Elle ne peut commencer que par un chiffre ou une lettre majuscule ou minuscule ou tout accent minuscule ou majuscule
    // Ensuite elle ne peut contenir que des chiffres, des lettres minuscules ou majuscule, - , ( ) " & \ / ' ° et tous les accents possibles en minuscules et majuscules
    // Enfin elle ne peut se terminer que par un chiffre, une lettre minuscule ou majuscule ) ou tout accent minuscule ou majuscule
    var reg = /^[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-z0-9, "'\(\)\\\/\-&°áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*[A-Za-z0-9\)áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var adresseOk = reg.test(adresse);

    if(!adresseOk){
        erreur_contenu.textContent = "Adresse invalide";
        var info = "Ce champ ne peut commencer que par une lettre ou chiffre, terminer par une lettre, un chiffre ou le caractère spécial ) et il ne peut contenir que les caractères spéciaux - , ( ) &  / ° \t&quot; ' (espace)";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+"\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if(adresse.length >= 100){
            erreur_contenu.textContent = "Adresse invalide & Caractères max : 100";
            $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+" et vous êtes limités à 100 caractères\" id=\"icoInfo\"></i>");
        }
        if(adresse == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(adresse.length == 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_adresse2(){
    var adresse=document.getElementById("adresse2").value;
    var erreur_contenu = document.getElementById("error_adresse2_contenu");
    var reg = /^[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ,\(\)\"&\\\/'°]*[A-Za-z0-9\)\"\'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var adresseOk = reg.test(adresse);
    if(!adresseOk){
        erreur_contenu.textContent = "Adresse invalide";
        var info = "Ce champ ne peut commencer que par une lettre ou chiffre, terminer par une lettre, un chiffre ou le caractère spécial ) et il ne peut contenir que les caractères spéciaux - , ( ) &  / ° \t&quot; ' (espace)";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+"\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if(adresse.length >= 100){
            erreur_contenu.textContent = "Adresse invalide & Caractères max : 100";
            $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+" et vous êtes limités à 100 caractères\" id=\"icoInfo\"></i>");
        }
        if(adresse == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(adresse.length == 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_formulaire_profil() {
    // On supprime le message du mail obligatoire pour ne pas avoir un cumul inutile
    $('#error_datasrv').html('');
    var champ_civilite_mr = document.getElementById("civilite_mr");
    var champ_civilite_mme = document.getElementById("civilite_mme");
    if (!champ_civilite_mr.checked && !champ_civilite_mme.checked) {
        $('#error_datajs').html('Le champ civilité est obligatoire !');
        return false;
    }
    var champ_nom = document.getElementById("nom");
    if (champ_nom.value.trim() === "") {
        $('#error_datajs').html('Le champ nom est obligatoire !');
        champ_nom.style.borderColor = "#D21929";
        champ_nom.focus();
        return false;
    }else{
        champ_nom.style.borderColor = "";
    }

    var champ_prenom = document.getElementById("prenom");
    if (champ_prenom.value.trim() === "") {
        $('#error_datajs').html('Le champ prénom est obligatoire !');
        champ_prenom.style.borderColor = "#D21929";
        return false;
    }else{
        champ_prenom.style.borderColor = "";
    }
    var champ_dateN = document.getElementById("dateN");
    if (!champ_dateN.value) {
        $('#error_datajs').html('Le champ date de naissance est obligatoire !');
        champ_dateN.style.borderColor = "#D21929";
        return false;
    }else{
        champ_dateN.style.borderColor = "";
    }
    var champ_email = document.getElementById("email");
    if (champ_email.value.trim()=== "") {
        $('#error_datajs').html('Le champ e-mail est obligatoire !');
        champ_email.style.borderColor = "#D21929";
        champ_email.focus();
        return false;
    }else{
        champ_email.style.borderColor = "";
    }
    if (!verif_nom() || !verif_prenom() || !verif_ville() || !verif_pays() || !verif_mail() || !verif_adresse() || !verif_adresse2()) {
        $('#error_datajs').html('Veuillez vérifier les champs invalides !');
        return false;
    }
    return verif_formulaire_mdp();
    return true;
}

//PAGE MOT DE PASSE
function verif_formulaire_mdp() {
    // On supprime le message du mail obligatoire pour ne pas avoir un cumul inutile
    $('#error_datasrv').html('');
    var ok = true;
    $('input[type=password]').each(function(){
        if($(this).val().trim()===""){
            $('#error_datajs').html('Veuillez '+$(this).data('libelle'));
            //alert('Veuillez '+$(this).data('libelle'));
            $(this).focus();
            // Pour ne pas que ça return true pour la fonction et donc que ça valide le formulaire !
            ok = false;
            // Pour ne pas exécuter tous les tours de boucles après la première erreur rencontrée
            return false;
        }
    });
    //console.log('Champs non vides : '+ok);
    // Pour ne pas exécuter les autres if si le premier est déjà faux
    if(!ok) return false;
    if($('#mdp').val() === $('#new_mdp').val()){
        $('#error_datajs').html('Vous ne pouvez pas réutiliser le même mot de passe !');
        //alert("Vous ne pouvez pas réutiliser le même mot de passe !");
        $('input[type=password]').each(function(){
            $(this).val('');
        });
        ok = false;
    }
    //console.log('Nouveau mdp différent de l\'ancien : '+ok);
    if(!ok) return false;
    if($('#new_mdp').val() != $('#new_mdp2').val()){
        $('#error_datajs').html('Vos mots de passe ne se correspondent pas !');
        //alert("Vos mots de passe ne se correspondent pas !");
        $('input[type=password]').each(function(){
            $(this).val('');
        });
        ok = false;
    }
    //console.log('Les mdp se correspondent : '+ok);
    if(!ok) return false;
    if(!verif_complexity_mdp()){
        $('#error_datajs').html('Veuillez vérifier la complexité de votre mot de passe !');
        //alert("Veuillez vérifier la complexité de votre mot de passe");
        ok = false;
    }
    //console.log('La complexité est respectée : '+ok);
    if(!ok) return false;
    return ok;

}

// Mot de passe : minimum 6 caractères + 1 Maj + 1 chiffre + 1 caractère spécial.
function verif_complexity_mdp(){
    var mdp = document.getElementById("new_mdp").value;
    var erreur_contenu = document.getElementById("error_newmdp_contenu");

    var reg1 = /[A-Z]+/g;
    var reg2 = /[a-z]+/g;
    var reg3 = /[0-9]+/g;
    var reg4 = /[\!_\+\-\?@\$%&*]+/g;
    // Les caractères que le mot de passe doit comporter UNIQUEMENT
    var reg5 = /[^A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\!_\+\-\?@\$%&*]+/g;
    var majOk = reg1.test(mdp);
    var minOk = reg2.test(mdp);
    var chiffreOk = reg3.test(mdp);
    var specialOk = reg4.test(mdp);
    var contenuPasOk = reg5.test(mdp);

    if(mdp.length < 6){
        erreur_contenu.textContent = "Longueur min : 6";
        erreur_contenu.style.color = "#D21929";
        if (mdp.trim()==""){
            erreur_contenu.textContent = "";
        }
        return false;
    }
    if(mdp.length > 16){
        erreur_contenu.textContent = "Longueur max : 16";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!majOk){
        erreur_contenu.textContent = "Doit contenir au moins une majuscule";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!minOk){
        erreur_contenu.textContent = "Doit contenir au moins une minuscule";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!chiffreOk){
        erreur_contenu.textContent = "Doit contenir au moins un chiffre";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!specialOk){
        erreur_contenu.textContent = "Doit contenir au moins un caractère spécial de cette liste : + - ? ! * @ $ % & _";
        erreur_contenu.style.color = "#D21929";
        return false;
    }

    if(contenuPasOk){
        erreur_contenu.textContent = "Votre mot de passe contient des caractères non autorisés. Sont autorisés : + - ? ! * @ $ % & _";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(mdp.length == 16){
        erreur_contenu.textContent = "Longueur max : 16";
        $('#error_newmdp_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 16 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    erreur_contenu.style.color = "";
    return true;
}

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

/*
function verif_nom(){
    var nom = document.getElementById("nom").value;
    var erreur_contenu = document.getElementById("error_nom_contenu");
    var champ_nom = document.getElementById("nom");
    // Le nom doit commencer par Lettre maj ou minuscule ou accent maj ou minuscule
    // Le milieu peut comporter - ou espace ou ' (certains nom en sont composés)
    // Il doit se terminer pareil que pour le commencement
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var nomOk = reg.test(nom);

    if (!nomOk){
        erreur_contenu.textContent = "Nom invalide";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (nom.length >= 50) {
            erreur_contenu.textContent = "Nom invalide & Caractères max : 50";
            $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Vu que c'est un champ obligatoire, ajout de ce message s'il rempli et puis efface.
        if(nom == ""){
            erreur_contenu.textContent = "Nom obligatoire";
            champ_nom.style.borderColor = "#D21929";
        }
        return false;
    }
    if (nom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    // On return true ici car c'est juste informatif, le formulaire est valide s'il est à 50 car c'est la limite
    if (nom.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_nom.style.borderColor = "";
    return true;
}

function verif_prenom(){
    var prenom = document.getElementById("prenom").value;
    var erreur_contenu = document.getElementById("error_prenom_contenu");
    var champ_prenom = document.getElementById("prenom");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var prenomOk = reg.test(prenom);
    if(!prenomOk) {
        erreur_contenu.textContent = "Prénom invalide";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (prenom.length >= 50) {
            erreur_contenu.textContent = "Prénom invalide & Caractères max : 50";
            $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        if(prenom == ""){
            erreur_contenu.textContent = "Prénom obligatoire";
            champ_prenom.style.borderColor = "#D21929";
        }
        return false;
    }
    if (prenom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (prenom.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_prenom.style.borderColor = "";
    return true;
}

function verif_ddn(){
    var ddn = document.getElementById("dateN").value;
    var champ_ddn = document.getElementById("dateN");
    var erreur_contenu = document.getElementById("error_ddn_contenu");
    if (!ddn){
        erreur_contenu.textContent = "Date de naissance obligatoire";
        erreur_contenu.style.color = "#D21929";
        champ_ddn.style.borderColor = "#D21929";
        return false;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_ddn.style.borderColor = "";
    return true;
}

function verif_adresse(){
    var adresse=document.getElementById("adresse").value;
    var erreur_contenu = document.getElementById("error_adresse_contenu");
    // On veut vérifier que l'adresse respecte différents critère :
    // Elle ne peut commencer que par un chiffre ou une lettre majuscule ou minuscule ou tout accent minuscule ou majuscule
    // Ensuite elle ne peut contenir que des chiffres, des lettres minuscules ou majuscule, - , ( ) " & \ / ' ° et tous les accents possibles en minuscules et majuscules
    // Enfin elle ne peut se terminer que par un chiffre, une lettre minuscule ou majuscule ) ou tout accent minuscule ou majuscule
    var reg = /^[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-z0-9, "'\(\)\\\/\-&°áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*[A-Za-z0-9\)áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var adresseOk = reg.test(adresse);

    if(!adresseOk){
        erreur_contenu.textContent = "Adresse invalide";
        var info = "Ce champ ne peut commencer que par une lettre ou chiffre, terminer par une lettre, un chiffre ou le caractère spécial ) et il ne peut contenir que les caractères spéciaux - , ( ) &  / ° \t&quot; ' (espace)";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+"\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if(adresse.length >= 100){
            erreur_contenu.textContent = "Adresse invalide & Caractères max : 100";
            $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+" et vous êtes limités à 100 caractères\" id=\"icoInfo\"></i>");
        }
        if(adresse == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(adresse.length == 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_adresse2(){
    var adresse=document.getElementById("adresse2").value;
    var erreur_contenu = document.getElementById("error_adresse2_contenu");
    var reg = /^[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ,\(\)\"&\\\/'°]*[A-Za-z0-9\)\"\'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var adresseOk = reg.test(adresse);
    if(!adresseOk){
        erreur_contenu.textContent = "Adresse invalide";
        var info = "Ce champ ne peut commencer que par une lettre ou chiffre, terminer par une lettre, un chiffre ou le caractère spécial ) et il ne peut contenir que les caractères spéciaux - , ( ) &  / ° \t&quot; ' (espace)";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+"\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if(adresse.length >= 100){
            erreur_contenu.textContent = "Adresse invalide & Caractères max : 100";
            $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+" et vous êtes limités à 100 caractères\" id=\"icoInfo\"></i>");
        }
        if(adresse == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(adresse.length == 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_ville(){
    var ville = document.getElementById("ville").value;
    var erreur_contenu = document.getElementById("error_ville_contenu");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var villeOk = reg.test(ville);
    if (!villeOk){
        erreur_contenu.textContent = "Ville invalide";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (ville.length >= 50) {
            erreur_contenu.textContent = "Ville invalide & Caractères max : 50";
            $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Je rajoute cette condition car le champ n'étant pas obligatoire je ne veux pas qu'il m'affiche un message d'erreur
        if(ville == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if (ville.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (ville.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_ville_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_pays(){
    var pays = document.getElementById("pays").value;
    var erreur_contenu = document.getElementById("error_pays_contenu");
    var reg = /^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]?[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\- ']*[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]$/g;
    var paysOk = reg.test(pays);

    if (!paysOk){
        erreur_contenu.textContent = "Pays invalide";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre et il ne peut contenir que les caractères spéciaux - ' (espace)\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (pays.length >= 50) {
            erreur_contenu.textContent = "Pays invalide & Caractères max : 50";
            $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut commencer et terminer que par une lettre, il ne peut contenir que les caractères spéciaux - ' (espace) et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        if(pays == ""){
            erreur_contenu.textContent = "";
            return true;
        }
        return false;
    }
    if (pays.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (pays.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_pays_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    return true;
}

function verif_mail(){
    var email = document.getElementById("email").value;
    var erreur_contenu = document.getElementById("error_email_contenu");
    var champ_mail = document.getElementById("email");
    /!* Cela va vérifier si l'email respecte bien la structure de base :
    - Ne doit commencer que par une lettre minuscule ou majuscule ou un chiffre
    - au moins un caractère type lettre min, maj, chiffre, . _ -
    - avant le @, je ne veux pas autoriser les . - et _ ça me parait bizarre et je ne suis pas sûre que ce soit autorisé
    - un seul @ obligatoire
    - pareil qu'à l'étape 2 mais sans le _ et le .
    - un seul . obligatoire
    // -minimum 2 et maximum 3 caractères type lettre minuscule (fr, com, be etc)*!/
    var reg = /^[A-Za-z0-9][\w.-]*[A-Za-z0-9]@{1}[a-z0-9-]+\.{1}[a-z]{2,3}$/g;
    var mailOk = reg.test(email);
    if (!mailOk){
        erreur_contenu.textContent = "E-mail invalide";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Types de structures acceptées : Ex.3m-pl_e@dom-aine.com , 8eXem_pl.e2@hotmail.fr\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if (email.length >= 50) {
            erreur_contenu.textContent = "E-mail invalide & Caractères max : 50";
            $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Types de structures acceptées : Ex.3m-pl_e@dom-aine.com , 8eXem_pl.e2@hotmail.fr et vous êtes limités à 50 caractères\" id=\"icoInfo\"></i>");
        }
        // Vu que c'est un champ obligatoire j'ai rajouté ce message s'il rempli et puis efface.
        if(email == ""){
            erreur_contenu.textContent = "E-mail obligatoire";
            champ_mail.style.borderColor = "#D21929";
        }
        return false;
    }
    if (email.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if (email.length == 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_mail.style.borderColor = "";
    return true;
}

function verif_complexity_mdp(){
    var mdp = document.getElementById("mdp").value;
    var erreur_contenu = document.getElementById("error_mdp_contenu");

    var reg1 = /[A-Z]+/g;
    var reg2 = /[a-z]+/g;
    var reg3 = /[0-9]+/g;
    var reg4 = /[\!_\+\-\?@\$%&*]+/g;
    // Les caractères que le mot de passe doit comporter UNIQUEMENT
    var reg5 = /[^A-Za-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\!_\+\-\?@\$%&*]+/g;
    var majOk = reg1.test(mdp);
    var minOk = reg2.test(mdp);
    var chiffreOk = reg3.test(mdp);
    var specialOk = reg4.test(mdp);
    var contenuPasOk = reg5.test(mdp);

    if(mdp.length < 6){
        erreur_contenu.textContent = "Longueur min : 6";
        erreur_contenu.style.color = "#000";
        if (mdp.trim()==""){
            erreur_contenu.textContent = "";
        }
        return false;
    }
    if(mdp.length >= 16){
        erreur_contenu.textContent = "Longueur max : 16";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!majOk){
        erreur_contenu.textContent = "Doit contenir au moins une majuscule";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!minOk){
        erreur_contenu.textContent = "Doit contenir au moins une minuscule";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!chiffreOk){
        erreur_contenu.textContent = "Doit contenir au moins un chiffre";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    if(!specialOk){
        erreur_contenu.textContent = "Doit contenir au moins un caractère spécial de cette liste : +-?!*@$%&_";
        erreur_contenu.style.color = "#D21929";
        return false;
    }

    if(contenuPasOk){
        erreur_contenu.textContent = "Votre mot de passe contient des caractères non autorisés. Sont autorisés : +-?!*@$%&_";
        erreur_contenu.style.color = "#D21929";
        return false;
    }
    erreur_contenu.textContent = "";
    erreur_contenu.style.color = "";
    return true;
}

// PAGE MOT DE PASSE
/!* afficher/cacher mdp
 ToggleClass var intervertir les deux champs. Par exemple si class="fa-eye" il va changer par class="fa-eye-slash" et inversement.
L'icone est "reliée" à son champ mdp car dans son attribut toggle elle renseigne son id. *!/
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


// FONCTION Pour vérifier que les infos obligatoires du formulaire ont été renseignées
function verif_formulaire() {
    var champ_civilite_mr=document.getElementById("civilite_mr");
    var champ_civilite_mme=document.getElementById("civilite_mme");
    if(!champ_civilite_mr.checked && !champ_civilite_mme.checked){
        alert("Le champ civilite est obligatoire !");
        return false;
    }

    var champ_nom=document.getElementById("nom");
    if(champ_nom.value.trim()===''){
        alert("Le nom est obligatoire");
        champ_nom.style.borderColor = "#D21929";
        champ_nom.focus();
        return false;
    }else{
        champ_nom.style.borderColor = "";
    }

    var champ_prenom = document.getElementById("prenom");
    if (champ_prenom.value.trim() === "") {
        alert("Le champ prénom est obligatoire !");
        champ_prenom.style.borderColor = "#D21929";
        return false;
    }else{
        champ_prenom.style.borderColor = "";
    }

    var champ_dateN = document.getElementById("dateN");
    if (!champ_dateN.value) {
        alert("Le champ date de naissance est obligatoire !");
        champ_dateN.style.borderColor = "#D21929";
        return false;
    }else{
        champ_dateN.style.borderColor = "";
    }

    var champ_email = document.getElementById("email");
    if (champ_email.value.trim()=== "") {
        alert("Le champ e-mail est obligatoire !");
        champ_email.style.borderColor = "#D21929";
        champ_email.focus();
        return false;
    }else{
        champ_email.style.borderColor = "";
    }

    var champ_mdp=document.getElementById("mdp");
    if(champ_mdp.value.trim() ===''){
        alert("Le mot de passe est obligatoire");
        champ_mdp.focus();
        return false;
    }
    var champ_confirmmdp=document.getElementById("new_mdp2");
    if(champ_confirmmdp.trim() ===''){
        alert("Confirmez votre mot de passe");
        champ_prenom.focus();
        return false;
    }




    // FONCTION pour ne pas dépasser le nombre de caractères définis en BDD
    var champ_nom=document.getElementById("nom");
    if(champ_nom.value.length >= 5){
        alert("Vous avez dépassé le nombre de caractères pour votre nom");
        return false;
    }

    var champ_prenom=document.getElementById("prenom");
    if(champ_prenom.value.length >= 50){
        alert("Vous avez dépassé le nombre de caractères pour votre prénom");
        return false;
    }

    var champ_adresse=document.getElementById("adresse");
    if(champ_adresse.value.length >= 100){
        alert("Vous avez dépassé le nombre de caractères pour votre adresse");
        return false;
    }

    var champ_adresse2=document.getElementById("adresse2");
    if(champ_adresse2.value.length >= 100){
        alert("Vous avez dépassé le nombre de caractères pour votre adresse");
        return false;
    }

    var champ_cp=document.getElementById("cp");
    if(champ_cp.value.length >= 5){
        alert("Vous avez dépassé le nombre de caractères pour votre code postal");
        return false;
    }

    var champ_ville=document.getElementById("ville");
    if(champ_ville.value.length >= 50){
        alert("Vous avez dépassé le nombre de caractères pour votre ville");
        return false;
    }

    var champ_pays=document.getElementById("pays");
    if(champ_pays.value.length >= 50){
        alert("Vous avez dépassé le nombre de caractères pour votre pays");
        return false;
    }

    var champ_email=document.getElementById("email");
    if(champ_email.value.length >= 50){
        alert("Vous avez dépassé le nombre de caractères pour votre adresse e-mail");
        return false;
    }

    var champ_motdepasse=document.getElementById("mdp");
    if(champ_motdepasse.value.length >= 16){
        alert("Vous avez dépassé le nombre de caractères pour votre mot de passe");
        return false;
    }
    return true;

}


/!*
Codage pour l'ancienne présentation de la saisie Date de naissance :

let cbjours = document.getElementById("cbjours");

for (let i = 1; i < 32; i++) {
    uneoption = new Option();
    uneoption.value = i;
    uneoption.text = i;
    cbjours.add(uneoption);
}

let mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
let cbmois = document.getElementById("cbmois");
for (let i = 0; i < 12; i++) {
    uneoption = new Option();
    uneoption.value = i;
    uneoption.text = mois[i];
    cbmois.add(uneoption);
}

let cbannee = document.getElementById("cbannee");
for (let j = 2018; j > 1910; j--) {
    uneoption = new Option();
    uneoption.value = j;
    uneoption.text = j;
    cbannee.add(uneoption);
}
*!/
*/
