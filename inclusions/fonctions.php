<?php
function convertirDate($daten){
    setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
    $dateFR = strftime('%d-%m-%Y', strtotime($daten));
    return strftime('%A %d %B %Y',strtotime($dateFR));
}
function calculerPourcentage($divided, $divider){
    //On arrondi c'est plus joli.
    return round(($divided / $divider)*100);
}
function additionner($varTab){
    $total = 0;
    for($i=0;$i<sizeof($varTab);$i++){
        $total += $varTab[$i];
    }
    //Format : deux nombres après la virgule (sinon il ne m'affiche pas 3.50 mais 3.5)
    return number_format($total,2);
}