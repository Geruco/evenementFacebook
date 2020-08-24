<?php
session_start();

if(isset($_GET['picture'])){
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'soirees';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    //SUPPRESSION DE L'IMAGE PRECEDENTE
    $requete = "SELECT picture FROM user where id = '".$_SESSION['id']."';";
    $exec_requete = mysqli_query($db,$requete);
    $rep = mysqli_fetch_array($exec_requete);
    $picture = $rep['picture'];
    if($picture != "blank"){
        $delPicture = unlink("../pdpUsers".$picture);
    }
    $image = "0";
    if($_FILES['picture']['error'] == "0"){
        $target_dir = "pdpUsers/";
        $target_file = "../".$target_dir.$_SESSION['id'].".jpg";
        move_uploaded_file($_FILES['picture']["tmp_name"], $target_file);
        $image = $_SESSION['id'].".jpg";
        echo $image;
    }
    $requete = "UPDATE user SET picture = '".$image."' WHERE user.id = '".$_SESSION['id']."';";
    $exec_requete = mysqli_query($db, $requete);
    header('Location: ../index.php?profil='.$_SESSION['id']);
}
else{
    if(isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['birthdate']) && isset($_POST['Apropos']))
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
        $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
        $birthdate = mysqli_real_escape_string($db,htmlspecialchars($_POST['birthdate']));
        $mail = mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
        $Apropos = mysqli_real_escape_string($db,htmlspecialchars($_POST['Apropos']));
        
        $requete = "SELECT nickname FROM user where id = '".$_SESSION['id']."';";
        $exec_requete = mysqli_query($db,$requete);
        $rep = mysqli_fetch_array($exec_requete);
        $nick = $rep['nickname'];
        
        if($username != $nick){
            //Verification si le pseudo est deja pris
            $requete = "SELECT count(*) FROM user where nickname = '".$username."';";
            $exec_requete = mysqli_query($db,$requete);
            $repCount      = mysqli_fetch_array($exec_requete);
            $count = $repCount['count(*)'];
            if($count == 0){
                if($username !== "")
                {
                    $requete = "UPDATE user SET nickname = '".$username."', birthdate =  '".$birthdate."', mail = '".$mail."', Apropos = '".$Apropos."' WHERE user.id = '".$_SESSION['id']."';";
                    $exec_requete = mysqli_query($db,$requete);
                    $_SESSION['username'] = $username;
                    header('Location: ../index.php?profil='.$_SESSION['id']);
                }
                else
                {
                   header('Location: ../index.php?profil='.$_SESSION['id'].'&erreur=1'); // utilisateur vide
                }
            }
            else
            {
               header('Location: ../index.php?profil='.$_SESSION['id'].'&erreur=2'); // utilisateur deja utilisé
            }
        }
        else{
            $requete = "UPDATE user SET birthdate =  '".$birthdate."', mail = '".$mail."', Apropos = '".$Apropos."' WHERE user.id = '".$_SESSION['id']."';";
            $exec_requete = mysqli_query($db,$requete);
            header("Location: ../index.php?profil=".$_SESSION['id']);
        }
    }
    else
    {
       header('Location: ../index.php?profil='.$_SESSION['id'].'&erreur=4');
    }
    mysqli_close($db); // fermer la connexion
}
?>