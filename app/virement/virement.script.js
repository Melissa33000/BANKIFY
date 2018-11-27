$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })
});

// Sélection et colorisation du compte émetteur et du compte bénéficiaire sélectionnés dans le carroussel
var selectedRowEmetteur = null;

$('#compte_emetteur .item').click(function()
{
    if(selectedRowEmetteur == null || selectedRowEmetteur[0] != this) {
        $(this).css('background-color', '#008080');
        $(this).find('input').prop('checked',true);
        if(selectedRowEmetteur != null){
            selectedRowEmetteur.css('background-color','');
            selectedRowEmetteur.find('input').prop('checked',false);
        }
        selectedRowEmetteur = $(this);
    }
    else
    {
        selectedRowEmetteur.css('background-color','');
        $(this).find('input').prop('checked',false);
        selectedRowEmetteur = null;
    }
});
var selectedRowBeneficiaire = null;

$('#compte_beneficiaire .item').click(function()
{
    if(selectedRowBeneficiaire == null || selectedRowBeneficiaire[0] != this) {
        $(this).css('background-color','#008080');
        $(this).find('input').prop('checked',true);
        if(selectedRowBeneficiaire != null){
            selectedRowBeneficiaire.css('background-color','');
            selectedRowBeneficiaire.find('input').prop('checked',false);
        }
        selectedRowBeneficiaire = $(this);
    }
    else
    {
        selectedRowBeneficiaire.css('background-color','');
        selectedRowBeneficiaire.find('input').prop('checked',false);
        selectedRowBeneficiaire = null;
    }
});

// Vérification après avoir appuyer sur valider qu'un compte bénéficiaire et un compte émetteur sont sélectionnées et que ce ne sont pas les mêmes
$('#valider').click(function()
{
    if (selectedRowEmetteur != null && selectedRowBeneficiaire != null)
    {
        if (selectedRowEmetteur.find('input').val() !== selectedRowBeneficiaire.find('input').val()){
            document.location.href='virement2.php?compteemetteur='+selectedRowEmetteur.find('input').val()+'&comptebeneficiaire='+selectedRowBeneficiaire.find('input').val();
        }else {
            alert("Les deux comptes doivent être différents");
        }
    }else {
        alert("Vous devez sélectionner deux comptes");
    }
});

 /*/// Réadapter ce message pour avoir une jolie alerte pour virement
function verif_virement(){
    var verif_virement=document.getElementById("verif_virement").value;
    var erreur_contenu = document.getElementById("error_verif_virement_contenu");

        if (selectedRowEmetteur === selectedRowBeneficiaire ) {
            erreur_contenu.textContent = "Les 2 comptes doivent être différents";
            $('#error_verif_virement_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Opération impossible : le compte émetteur doit être différent du compte bénéficiaire\" id=\"icoInfo\"></i>");
            erreur_contenu.style.color = "#D21929";
            return false;
        }else{
            erreur_contenu.textContent = "";
         return true;
        }

        if (selectedRowEmetteur != null && selectedRowBeneficiaire != null){
            erreur_contenu.textContent = "Vous devez sélectionner deux comptes";
            $('#error_verif_virement_contenu').append("<i class=\"far fa-question-circle\" data-info=\"Opération impossible : vous devez sélectionner un compte émetteur et un compte bénéficiaire\" id=\"icoInfo\"></i>");
            erreur_contenu.style.color = "#D21929";
            return false;
        }
        erreur_contenu.textContent = "";
        return true;
}
*/