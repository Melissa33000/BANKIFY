// FONCTIONS
function getXHR(){
    var xhr;
    if(window.XMLHttpRequest)
        xhr = new XMLHttpRequest();
    else
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    return xhr;
}
//PAGE MODIFIER PROFIL

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
        if(nom === ""){
            erreur_contenu.textContent = "Nom obligatoire";
            champ_nom.style.borderColor = "#D21929";
        }
        $('#nomOK').html("");
        $('#nomOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if (nom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        $('#nomOK').html("");
        $('#nomOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    // On return true ici car c'est juste informatif, le formulaire est valide s'il est à 50 car c'est la limite
    if (nom.length === 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_nom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_nom.style.borderColor = "";
    $('#nomOK').html("");
    $('#nomOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
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
        if(prenom === ""){
            erreur_contenu.textContent = "Prénom obligatoire";
            champ_prenom.style.borderColor = "#D21929";
        }
        $('#prenomOK').html("");
        $('#prenomOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if (prenom.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        $('#prenomOK').html("");
        $('#prenomOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if (prenom.length === 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_prenom_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_prenom.style.borderColor = "";
    $('#prenomOK').html("");
    $('#prenomOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
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
        $('#ddnOK').html("");
        $('#ddnOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    erreur_contenu.textContent = "";
    champ_ddn.style.borderColor = "";
    $('#ddnOK').html("");
    $('#ddnOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
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
        if(email === ""){
            erreur_contenu.textContent = "E-mail obligatoire";
            champ_mail.style.borderColor = "#D21929";
        }
        $('#emailOK').html("");
        $('#emailOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if (email.length > 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 50 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        $('#emailOK').html("");
        $('#emailOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if (email.length === 50) {
        erreur_contenu.textContent = "Caractères max : 50";
        $('#error_email_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 50 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    //Si tout est OK, pas de message d'erreur
    erreur_contenu.textContent = "";
    champ_mail.style.borderColor = "";
    $('#emailOK').html("");
    $('#emailOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
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
        if(adresse === ""){
            erreur_contenu.textContent = "";
            $('#adresseOK').html("");
            return true;
        }
        $('#adresseOK').html("");
        $('#adresseOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        $('#adresseOK').html("");
        $('#adresseOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if(adresse.length === 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    $('#adresseOK').html("");
    $('#adresseOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
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
        if(adresse === ""){
            erreur_contenu.textContent = "";
            $('#adresse2OK').html("");
            return true;
        }
        $('#adresse2OK').html("");
        $('#adresse2OK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if(adresse.length > 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Ce champ ne peut pas faire plus de 100 caractères\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        $('#adresse2OK').html("");
        $('#adresse2OK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    if(adresse.length === 100){
        erreur_contenu.textContent = "Caractères max : 100";
        $('#error_adresse2_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 100 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        return true;
    }
    erreur_contenu.textContent = "";
    $('#adresse2OK').html("");
    $('#adresse2OK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
    return true;
}
function verif_cpville(){
    let cp = document.getElementById("cp").value;
    var erreur_contenu = document.getElementById("error_cp_contenu");
    var champ_cpville = document.getElementById("cp");
    var reg = /^[0-9]{5}[ ]{1}[-]{1}[ ]{1}[A-Z0-9 -]+[A-Z-0-9]$/g;
    var cpOk = reg.test(cp);

    if(!cpOk){
        erreur_contenu.textContent = "Code postal invalide";
        var info = "Veuillez choisir parmi les propositions ou assurez-vous que le champ est vide.";
        $('#error_cp_contenu').append("<i class=\"far fa-question-circle\" data-info=\""+info+"\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#D21929";
        if(cp === ""){
            erreur_contenu.textContent = "Code postal obligatoire";
            champ_cpville.style.borderColor = "#D21929";
        }
        $('#cpvilleOK').html("");
        $('#cpvilleOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO'></i>");
        return false;
    }
    erreur_contenu.textContent = "";
    $('#cpvilleOK').html("");
    $('#cpvilleOK').append("<i class=\"fas fa-check fa-lg\" id='champOK'></i>");
    return true;
}
function verif_formulaire_profil() {
    //PAGE PROFIL
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
    var champ_cpville = document.getElementById("cp");
    if (champ_cpville.value.trim()=== "") {
        $('#error_datajs').html('Le champ code postal est obligatoire !');
        champ_cpville.style.borderColor = "#D21929";
        champ_cpville.focus();
        return false;
    }else{
        champ_cpville.style.borderColor = "";
    }
    if (!verif_nom() || !verif_prenom() || !verif_cpville() || !verif_mail() || !verif_adresse() || !verif_adresse2()) {
        $('#error_datajs').html('Veuillez vérifier les champs invalides !');
        return false;
    }
    return true;
}

//PAGE MOT DE PASSE

function verif_formulaire_mdp() {
    // On supprime le message du mdp incorrect pour ne pas avoir un cumul inutile
    $('#error_datasrv').html('');
    var ok = true;
    if(!verif_complexity_mdp()){
        $('#error_datajs').html('Veuillez vérifier la complexité de votre mot de passe !');
        ok = false;
    }
    if(!ok) return false;
    $('#mdp, #new_mdp, #new_mdp2').each(function(){
        if($(this).val().trim()===""){
            $('#error_datajs').html('Veuillez '+$(this).data('libelle'));
            $(this).focus();
            // Pour ne pas que ça return true pour la fonction et donc que ça valide le formulaire !
            ok = false;
            // Pour ne pas exécuter tous les tours de boucles après la première erreur rencontrée
            return false;
        }
    });
    // Pour ne pas exécuter les autres if si le premier est déjà faux
    if(!ok) return false;
    if($('#mdp').val() === $('#new_mdp').val()){
        $('#error_datajs').html('Vous ne pouvez pas réutiliser le même mot de passe !');
        $('input[type=password], input[type=text]').each(function(){
            $(this).val('');
        });
        ok = false;
    }
    if(!ok) return false;
    if($('#new_mdp').val() != $('#new_mdp2').val()){
        $('#error_datajs').html('Vos mots de passe ne se correspondent pas !');
        //alert("Vos mots de passe ne se correspondent pas !");
        $('input[type=password], input[type=text]').each(function(){
            $(this).val('');
        });
        ok = false;
    }
    if(!ok) return false;
    return ok;
}
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
        //erreur_contenu.style.color = "#D21929";
        if (mdp.trim()==""){
            $('#mdpOK').html("");
            erreur_contenu.textContent = "";
            return true;
        }
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(mdp.length > 16){
        erreur_contenu.textContent = "Longueur max : 16";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(!majOk){
        erreur_contenu.textContent = "Doit contenir au moins une majuscule";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(!minOk){
        erreur_contenu.textContent = "Doit contenir au moins une minuscule";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(!chiffreOk){
        erreur_contenu.textContent = "Doit contenir au moins un chiffre";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(!specialOk){
        erreur_contenu.textContent = "Doit contenir au moins un caractère spécial de cette liste : + - ? ! * @ $ % & _";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }

    if(contenuPasOk){
        erreur_contenu.textContent = "Votre mot de passe contient des caractères non autorisés. Sont autorisés : + - ? ! * @ $ % & _";
        //erreur_contenu.style.color = "#D21929";
        $('#mdpOK').html("");
        $('#mdpOK').append("<i class=\"fas fa-exclamation-circle fa-lg\" id='champKO2'></i>");
        return false;
    }
    if(mdp.length === 16){
        erreur_contenu.textContent = "Longueur max : 16";
        $('#error_newmdp_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Message à titre informatif : Vous ne pouvez pas renseigner plus de 16 caractères pour ce champ\" id=\"icoInfo\"></i>");
        erreur_contenu.style.color = "#000";
        $('#mdpOK').html("");
        return true;
    }
    erreur_contenu.textContent = "";
    erreur_contenu.style.color = "";
    $('#mdpOK').html("");
    $('#mdpOK').append("<i class=\"fas fa-check fa-lg\" id='champOK2'></i>");
    return true;
}

// BIDOUILLE POUR TRANSFERER AU CLIC DES VARIABLE SUPERGLOBALE EN POST ET PLUS EN GET
function postt(url, p){
    let form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', url);
    for(let key in p){
        if(p.hasOwnProperty(key)){
            let hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', key);
            hiddenInput.setAttribute('value', p[key]);
            form.appendChild(hiddenInput);
        }
    }
    document.body.appendChild(form);
    form.submit();
}

// TOUT LE RESTE !!

$(document).ready(function(){

    // PAGE BUDGET

    // ENTREES / SORTIES
    // Affichage des couleurs des catégories
    $('.itemBudgetCat').each(function () {
        var idCat = $(this).data('id');
        if(idCat === 1){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(194,148,194,1)');
        }
        if(idCat === 2){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(254, 51, 102, 1)');
        }
        if(idCat === 3){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(255,178,0,1)');
        }
        if(idCat === 4){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(0, 203, 203, 1)');
        }
        if(idCat === 5){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(183, 134, 103, 1)');
        }
        if(idCat === 6){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(113, 127, 195, 1)');
        }
        if(idCat === 7){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(159, 195, 211, 1)');
        }
        if(idCat === 8){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(255, 135, 194, 1)');
        }
        if(idCat === 9){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(252, 93, 106, 1)');
        }
        if(idCat === 10){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(249, 182, 139, 1)');
        }
        if(idCat === 11){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(137, 209, 255, 1)');
        }
        if(idCat === 12){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(155, 89, 182, 1)');
        }
        if(idCat === 13){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(24, 201, 93, 1)');
        }
        if(idCat === 14){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(103, 127, 224, 1)');
        }
        if(idCat === 15){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(251, 226, 136, 1)');
        }
        if(idCat === 16){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(128, 255, 0, 1)');
        }
        if(idCat > 10000){
            $('.itemBudgetCat[data-id='+idCat+']').css('background-color', 'rgba(84, 222, 61, 1)');
        }
    });

    //Griser les catégories à 0€
    $('.itemBudgetCat span').each(function () {
        var montant = $(this).text();

        if(montant === "0.00"){
            var papa = $(this).parent().parent();
            papa.css("filter", "opacity(40%)");
        }
    });

    //Tri des catégories par dépenses / revenus les plus gros
    var $sorted_items;
    function getSorted(selector, attrName) {
        return $(
            $(selector).toArray().sort(function(a, b){
                var aVal = parseFloat(a.getAttribute(attrName)),
                    bVal = parseFloat(b.getAttribute(attrName));
                // On doit préciser ça car pour les entrées ça doit afficher les plus grands nombre positifs d'abord
                if((($(selector).data('id')) < 10000) || ($(selector).data('idcat')) < 10000){
                    return aVal - bVal;
                }else{
                    return bVal - aVal;
                }
            })
        );
    }
    $sorted_items = getSorted('#budgetCat .itemBudgetCat', 'data-montant').clone();
    $('#budgetCat').html( $sorted_items );

    // Rendre les catégories cliquables
    // -> Lien vers sous-catégories pour les sorties et
    // -> Lien vers opérations pour les revenus (car elles n'ont pas de sous-catégories) */
    // TODO Trouver un moyen de récupérer l'id du client sur cette page mais aussi sur toutes celles du site
    $('.itemBudgetCat').click(function () {
        let iddCat = $(this).data("id");
        if(iddCat < 10000){
            postt('souscategories.php', {idCat: iddCat});
            //window.location.replace("souscategories.php?idCat="+iddCat+"");
        }else{
            // En fait ici on est dans un cas "spécial" ou l'id de la catégorie est aussi l'id de la sous catégorie mais on doit le renseigner car la
            // page operations s'attend à recevoir et un id cat et un id sous cat (à cause des sorties qui ont une sous-catégorie)
            postt('operations.php', {idCat: iddCat, idSousCat: iddCat});
            //window.location.replace("operations.php?idCat="+iddCat+"&idSousCat="+iddCat+"");
        }
    });
    /* changer le curseur en pointeur en hover */
    $('.itemBudgetCat').mouseover(function () {
        $(this).css("cursor", "pointer");
    });

    // Bouton glissière pour masquer/afficher les catégories à 0€
    $("#btn-categorie").click(function() {
        let target = $(".my-text");
        if($(this).prop('checked')) {
            target.html('Afficher les catégories nulles');
            $('.itemBudgetCat span').each(function(){
                var montant = $(this).text();
                if(montant === "0.00") {
                    $(this).parent().parent().hide();
                }
            });
        } else {
            target.html('Masquer les catégories nulles');
            $('.itemBudgetCat span').each(function(){
                var montant = $(this).text();
                if(montant === "0.00") {
                    $(this).parent().parent().show();
                }
            });
        }
    });
    // Bouton glissière pour masquer/afficher le graphique
    $('#btn-graph').click(function () {

        let target = $(".text-graph");
        if($(this).prop('checked')) {
            target.html('Masquer le graphique');
            //$('#graph').show();
            $('#graph').css("display", "");
        } else {
            target.html('Afficher le graphique');
            //$('#graph').hide();
            $('#graph').css("display", "none");
        }

    });

    // SOUS-CATEGORIES
    //Tri des sous-catégories par dépenses
    $sorted_sousCat = getSorted('.rowSousCat', 'data-montant').clone();
    $('#ligneTri').html( $sorted_sousCat );

    //Griser les sous-catégories à 0€
    $('.dataRowSousCat span').each(function () {
        var montant = $(this).text();

        if(montant === "0.00"){
            var papa = $(this).parent().parent();
            papa.css("filter", "opacity(40%)");
        }
    });

    /* Couleur en hover sur les sous-catégories selon la couleur de la catégorie */
    $('.rowSousCat').mouseover(function(){
        $(this).css("cursor", "pointer");
        let idCat = $(this).data("idcat");
        if(idCat === 1){
            $(this).css("background-color", "#C294C2");
        }
        if(idCat === 2){
            $(this).css("background-color", "#FE3366");
        }
        if(idCat === 3){
            $(this).css("background-color", "#FFB200");
        }
        if(idCat === 4){
            $(this).css("background-color", "#00CBCB");
        }
        if(idCat === 5){
            $(this).css("background-color", "#B78667");
        }
        if(idCat === 6){
            $(this).css("background-color", "#717FC3");
        }
        if(idCat === 7){
            $(this).css("background-color", "#9FC3D3");
        }
        if(idCat === 8){
            $(this).css("background-color", "#FF87C2");
        }
        if(idCat === 9){
            $(this).css("background-color", "#FC5D6A");
        }
        if(idCat === 10){
            $(this).css("background-color", "#F9B68B");
        }
        if(idCat === 11){
            $(this).css("background-color", "#89D1FF");
        }
        if(idCat === 12){
            $(this).css("background-color", "#9B59B6");
        }
        if(idCat === 13){
            $(this).css("background-color", "#18C95D");
        }
        if(idCat === 14){
            $(this).css("background-color", "#677FE0");
        }
        if(idCat === 15){
            $(this).css("background-color", "#FBE288");
        }
        if(idCat === 16){
            $(this).css("background-color", "#80FF00");
        }
    });
    /* Réinitialisation de la couleur quand on n'est pas en hover */
    $('.rowSousCat').mouseout(function(){
        $(this).css("background-color", "initial");
    });

    // Rendre les sous-catégories cliquables
    // -> lien vers les opérations
    $('.rowSousCat').click(function () {
        let iddSousCat = $(this).data("idsouscat");
        let iddCat = $(this).data("idcat");
        postt('operations.php', {idCat: iddCat, idSousCat: iddSousCat});
        //window.location.replace("operations.php?idCat="+idCat+"&idSousCat="+idSousCat+"");
    });

    // OPERATIONS
    // Opérations cliquables + AJAX
    // On fait apparaitre le AJAX + On essaie de cliquer sur une ligne et lui donner une couleur
    // + l'enlever si on reclique et faire disparaitre l'AJAX + coloration de la bordure de detailOperation
    let previousOp = 0;
    $('.itemOperations').click(function () {
        let idOp = $(this).data("idop");
        // On enlève la couleur de la ligne précédente pour ne pas colorer toutes les lignes qu'on sélectionne !!
        $('.itemOperations[data-idop='+previousOp+']').attr("class","itemOperations");

        // Coloration de la bordure supérieure du détail de l'opération de la même couleur que sa catégorie (oui on a le soucis du détail)
        var idCat = $(this).parent().data('idcat');
        if(idCat === 1){
            $('#detailOperations').css("border-top", "5px solid #C294C2");
        }
        if(idCat === 2){
            $('#detailOperations').css("border-top", "5px solid #FE3366");
        }
        if(idCat === 3){
            $('#detailOperations').css("border-top", "5px solid #FFB200");
        }
        if(idCat === 4){
            $('#detailOperations').css("border-top", "5px solid #00CBCB");
        }
        if(idCat === 5){
            $('#detailOperations').css("border-top", "5px solid #B78667");
        }
        if(idCat === 6){
            $('#detailOperations').css("border-top", "5px solid #717FC3");
        }
        if(idCat === 7){
            $('#detailOperations').css("border-top", "5px solid #9FC3D3");
        }
        if(idCat === 8){
            $('#detailOperations').css("border-top", "5px solid #FF87C2");
        }
        if(idCat === 9){
            $('#detailOperations').css("border-top", "5px solid #FC5D6A");
        }
        if(idCat === 10){
            $('#detailOperations').css("border-top", "5px solid #F9B68B");
        }
        if(idCat === 11){
            $('#detailOperations').css("border-top", "5px solid #89D1FF");
        }
        if(idCat === 12){
            $('#detailOperations').css("border-top", "5px solid #9B59B6");
        }
        if(idCat === 13){
            $('#detailOperations').css("border-top", "5px solid #18C95D");
        }
        if(idCat === 14){
            $('#detailOperations').css("border-top", "5px solid #677FE0");
        }
        if(idCat === 15){
            $('#detailOperations').css("border-top", "5px solid #FBE288");
        }
        if(idCat === 16){
            $('#detailOperations').css("border-top", "5px solid #80FF00");
        }
        if(idCat > 10000){
            $('#detailOperations').css("border-top", "5px solid #54DE3D");
        }

        $(this).addClass("selected");

        let xhr = getXHR();

        if(idOp === previousOp){
            $(this).attr("class","itemOperations");
            $('#detailOperations').html('');
            $('#detailOperations').css("border-top", "none");
            idOp = 0;
        }

        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4){
                let operation = JSON.parse(xhr.responseText);

                let idSousCat = operation.idSousCat;
                let montant = operation.montant;
                let devise = operation.symbole;
                let idmoyenpaiement = operation.idMoyenPaiement;
                let moyenPaiement = operation.moyenpaiement;
                let nom = operation.nom;
                let tiers = operation.tiers;
                let date = operation.date;
                let compte = operation.compte;
                let infosup = operation.infosup;
                let categorie = operation.categorie;
                let frequence = operation.frequence;

                $('#detailOperations').html('<div class="detailOp"><div class="icoSousCat"><img src="../../images/ico/categories/'+idSousCat+'.png"></div><div class="montantOp">'+montant+''+devise+' </div> <div class="nomOp">'+nom+'</div><div class="tiersOp">'+tiers.toUpperCase()+'</div><div class="dateCompteOp"><div><span>Date</span><span>'+date+'</span></div><div><span>Compte</span><span>'+compte+'</span></div> </div><div class="infosupOp">'+infosup+'</div><div class="catFreqMoyOp"><div><p>Catégorie</p><p>'+categorie+'<p></div><div><p>Fréquence</p><p>'+frequence+'<p></div> <div><p>Moyen de paiement</p><p>'+moyenPaiement+'</p><img src="../../images/ico/moyenpaiement/'+idmoyenpaiement+'.png"></div></div><div class="editDeleteOp"><a href="#"><img src="../../images/ico/edit.png" alt="Editer l\'opération"></a><a href="#"><img src="../../images/ico/delete.png" alt="Supprimer l\'opération"></a></div></div>');
            }
        }
        let idOperation = "id="+idOp+"";
        xhr.open('POST', 'api.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        xhr.send(idOperation);

        previousOp = idOp;
    });

    //Retour sur les sous-catégories de sortie + mouseover pointer
    $('#retour').mouseover(function(){
        $(this).css("cursor", "pointer");
    });
    $('#retour').click(function() {
        let iddCat = $('#listingOperations').data('idcat');
        postt("souscategories.php", {idCat: iddCat});
    });


    // NAV APP

    // Mouseover pour afficher les couleurs du site en dégradé + décalage de l'onglet
    $('#navAPP ul li').each(function(){
        var navAPPLiClass = $(this).attr("class");
        //var navAPPLi = $('.'+navAPPLiClass+'');
        if(navAPPLiClass === "navAPPli1"){
           $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#FD3F4F');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                //$(this).css('border-top-right-radius', '20px');
                //$(this).css('border-bottom-right-radius', '20px');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    //$(this).css('border-top-right-radius', '0px');
                    //$(this).css('border-bottom-right-radius', '0px');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli2"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#F22C62');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli3"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#BA44AC');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli4"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#8A6CCB');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli5"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#5F90E8');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli6"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#2E94F8');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }
        if(navAPPLiClass === "navAPPli7"){
            $(this).mouseover(function(){
                $(this).css('cursor', 'pointer');
                $(this).css('background-color', '#21C6B3');
                $(this).css('padding', '0px');
                $(this).css('margin', '0px');
                $(this).css('text-shadow', '#000 2px 2px 2px');
                $(this).css('box-shadow', '5px 0px 3px black');
                // Faire ressortir le menu (on l'agrandit avec with et on le fait se placer par dessus la page (sinon on a les écritures de la page par dessus et c'est moche)
                $(this).css('width', '150%');
                $(this).css('z-index', '1');
                $(this).mouseout(function(){
                    $(this).css('background-color', 'initial');
                    $(this).css('padding', 'initial');
                    $(this).css('margin', 'initial');
                    $(this).css('text-shadow', 'initial');
                    $(this).css('box-shadow', 'initial');
                    $(this).css('width', 'initial');
                    $(this).css('z-index', 'initial');
                });
            });
        }

    });
    // REDIRECTION SANS LIEN !!!! (rend tout le li cliquable)
    $('#navAPP ul li').click(function(){
        let currentNavAPPLi = $(this).attr("class");
        // Il y a un || class ="... selected"pour ne pas que la couleur de l'onglet s'en aille à cause du hover.
        if((currentNavAPPLi === "navAPPli1") || (currentNavAPPLi === "navAPPli1 selected")){
            window.location.replace("#");
        }
        if((currentNavAPPLi === "navAPPli2") || (currentNavAPPLi === "navAPPli2 selected")){
            window.location.replace("#");
        }
        if((currentNavAPPLi === "navAPPli3") || (currentNavAPPLi === "navAPPli3 selected")){
            window.location.replace("http://localhost/bankify/app/budget/sorties.php");
        }
        if((currentNavAPPLi === "navAPPli4") || (currentNavAPPLi === "navAPPli4 selected")){
            window.location.replace("#");
        }
        if((currentNavAPPLi === "navAPPli5") || (currentNavAPPLi === "navAPPli5 selected")){
            window.location.replace("#");
        }
        if((currentNavAPPLi === "navAPPli6") || (currentNavAPPLi === "navAPPli6 selected")){
            window.location.replace("http://localhost/bankify/app/export/export.php");
        }
        if((currentNavAPPLi === "navAPPli7") || (currentNavAPPLi === "navAPPli7 selected")){
            window.location.replace("#");
        }

    });

    // PAGE MOT DE PASSE

    // afficher/cacher mdp
    // ToggleClass var intervertir les deux champs. Par exemple si class="fa-eye" il va changer par class="fa-eye-slash" et inversement.
    // L'icone est "reliée" à son champ mdp car dans son attribut toggle elle renseigne son id.
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
});