<?php
function convert_daten($daten){
    //setlocale(LC_ALL, 'fr_FR');
    return date("d/m/Y", strtotime($daten));
}
