<?php
//&& isset($_POST['sexe'])
session_start();
if(isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['confirmPassword']) && isset($_POST['mail']) && isset($_POST['birthdate']) && isset($_POST['sexe']))
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
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $sexe = mysqli_real_escape_string($db,htmlspecialchars($_POST['sexe']));
    $birthdate = mysqli_real_escape_string($db,htmlspecialchars($_POST['birthdate']));
    $confirmPassword = mysqli_real_escape_string($db,htmlspecialchars($_POST['confirmPassword']));
    $mail = mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
    
    //Verification si le pseudo est deja pris
    $requete = "SELECT count(*) FROM user where nickname = '".$username."';";
    $exec_requete = mysqli_query($db,$requete);
    $repCount      = mysqli_fetch_array($exec_requete);
    $count = $repCount['count(*)'];
    if($count == 0){
        
        if($password == $confirmPassword) {
            $password = password_hash(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])), PASSWORD_DEFAULT);

            if($username !== "" && $password !== "")
            {
                $requete = "INSERT INTO user (nickname, password, mail, birthdate, sexe, inscription_date, role) VALUES ('".$username."', '".$password."', '".$mail."', '".$birthdate."', '".$sexe."', NOW(), '0')";
                $exec_requete = mysqli_query($db,$requete);

        //        Verification de l'enregistrement
                $requete = "SELECT count(*) FROM user where nickname = '".$username."';";
                $exec_requete = mysqli_query($db,$requete);
                $repCount      = mysqli_fetch_array($exec_requete);
                $count = $repCount['count(*)'];
                if ($count == 1){
                    header('Location: ../index.php');
                    //header('Location: ../Controleur/login.php');
                }
                else{
                    header('Location: ../Vue/vueRegister.php?erreur=0'); //Une erreur est arrivée avec la requête
                }
            }
            else
            {
               header('Location: ../Vue/vueRegister.php?erreur=1'); // utilisateur ou mot de passe vide
            }
        }
        else {
            header('Location: ../Vue/vueRegister.php?erreur=2'); //Mot de passes ne correspondent pas
        }
    }
    else {
        header('Location: ../Vue/vueRegister.php?erreur=3'); //Pseudo deja pris
    }
}
else
{
   header('Location: ../Vue/vueRegister.php?erreur=4');
}
mysqli_close($db); // fermer la connexion
?>