<?php
session_start();
if(isset($_POST['commentaire']) && isset($_POST['rating']) && isset($_POST['cible']))
{
    // connexion à la base de données
        $db_username = 'root';
        $db_password = '';
        $db_name     = 'soirees';
        $db_host     = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
               or die('could not connect to database');
    
   // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $commentaire = mysqli_real_escape_string($db,htmlspecialchars($_POST['commentaire'])); 
    $rating = mysqli_real_escape_string($db,htmlspecialchars($_POST['rating']));
    $cible = mysqli_real_escape_string($db,htmlspecialchars($_POST['cible']));
        
    if($commentaire !== "" && $rating !== "" && $rating <= 5 && $rating >= 0)
    {
        $requete = "INSERT INTO commentaires (writer_id, receiver_id, content, rating, date) VALUES ('".$_SESSION['id']."', '".$cible."', '".$commentaire."', '".$rating."', NOW())";
        $exec_requete = mysqli_query($db,$requete);
    }
    else
    {
       header('Location: '.$_SERVER['HTTP_REFERER'].'&erreur=1'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: '.$_SERVER['HTTP_REFERER'].'?erreur=2');
}
mysqli_close($db); // fermer la connexion
?>