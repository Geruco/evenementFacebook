<?php

require "Modele.php";

function accueil(){
    require "Vue/vueAccueil.php";
}

function profil($id){
    $profil = getProfil($id);
    $commentaries = getCommentaries($id);
    require "Vue/vueProfil.php";
}

function mesSoirees(){
    $parties = getParties();
    require "Vue/vueMesSoirees.php";
}
function ajouterSoirees(){
    require "Vue/vueAjouterSoirees.php";
}