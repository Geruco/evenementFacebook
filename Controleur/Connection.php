<?php
session_start();
if(isset($_POST['username'])&& isset($_POST['password'])){
    
    //connexion a la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name = "soirees";
    $db_host = "localhost";
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');
    
    //On applique les fonctions pour eliminer les menaces d'injections
    $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
    
    $requete = "SELECT password FROM user WHERE nickname = '".$username."'";
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    $passVerif = $reponse['password'];
    
    if($username != "" && password_verify($password, $passVerif)){
        //Recuperation du statut de l'utilisateur
        $requete = "SELECT role, id, nickname FROM user WHERE nickname = '".$username."'";
        $exec_requete = mysqli_query($db, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $role = $reponse['role'];
        $id = $reponse['id'];
        $nickname = $reponse['nickname'];
        
        $_SESSION['username'] = $nickname;
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
        
        header("location:".$_SERVER['HTTP_REFERER']);
    }
    else{
        header("location: ../Vue/vueLogin.php?erreur=2"); //Utilisateur ou mdp vide
    }
}
else {
    header("location: ../Vue/vueLogin.php");
}
mysqli_close($db); //Fermer la connexion
?>