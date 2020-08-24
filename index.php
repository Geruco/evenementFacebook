<?php 
if(session_id()=="") session_start();

require "Controleur/Controleur.php";

try{
    if(isset($_GET["direction"])){
        if($_GET["direction"] == "profil"){
            profil();
        }
        else if($_GET["direction"] == "MesSoirees"){
            mesSoirees();
        }
        else if($_GET["direction"] == "ajouterSoirees"){
            ajouterSoirees();
        }
        else if($_GET["direction"] == "mesDemandes"){
            mesDemandes();
        }
        else if($_GET["direction"] == "discussions"){
            discussions();
        }
    }
    else if(isset($_GET["profil"])){
        profil($_GET['profil']);
    }
    else{
        accueil();
    }
}
catch(Exception $e){
    $msgErr = $e->getMessage();
}