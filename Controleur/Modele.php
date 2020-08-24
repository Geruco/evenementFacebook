<?php

/*function executeRequest($sql, $params=null){
    if(params==null){
        $resultat = getBdd()->query($sql);
    }
    else{
        $resultat = getBdd()->prepare($sql);
        $resultat->execute($params);
    }
    return $resultat;
} */
function executeRequest($sql){
    $resultat = getBdd()->query($sql);
    return $resultat;
}
function getBdd(){
    $bdd = new PDO('mysql:host=localhost;dbname=soirees;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}

function getProfil($id){
    $sql = 'SELECT id, nickname, picture, sexe, birthdate, mail, Apropos, role FROM user WHERE id = "'.$id.'" ;';
    $profil = executeRequest($sql);
    return $profil;
}

function getCommentaries($id){
    $sql = 'SELECT commentaires.writer_id, commentaires.content, commentaires.rating, commentaires.date, user.id as user_id, user.nickname, user.picture FROM `commentaires` INNER JOIN user ON commentaires.writer_id = user.id WHERE commentaires.receiver_id = "'.$id.'" ;';
    $commentaries = executeRequest($sql);
    return $commentaries;
}

function getParties(){
    $sql = 'SELECT parties.id, parties.announcer_id, parties.date, parties.nb_of_people, parties.places_reserved, parties.cash, parties.age_moyen, parties.alcool, parties.musique, parties.description, parties.starting_hour, parties.adresse, parties.city, parties.country, user.id as user_id, user.nickname, user.picture FROM `parties` INNER JOIN user ON parties.announcer_id = user.id WHERE parties.announcer_id = "'.$_SESSION['id'].'" ;';
    $parties = executeRequest($sql);
    return $parties;
}