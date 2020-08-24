<?php
session_start();
if(isset($_POST['date']) && isset($_POST['nb_people']) && isset($_POST['cash']) && isset($_POST['age_moyen']) && isset($_POST['description']) && isset($_POST['starting_hour']) && isset($_POST['adresse']) && isset($_POST['city']) && isset($_POST['postal_code']) && isset($_POST['country']) )
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
    $date = mysqli_real_escape_string($db,htmlspecialchars($_POST['date'])); 
    $nbPeople = mysqli_real_escape_string($db,htmlspecialchars($_POST['nb_people']));
    $cash = mysqli_real_escape_string($db,htmlspecialchars($_POST['cash']));
    $ageMoyen = mysqli_real_escape_string($db,htmlspecialchars($_POST['age_moyen']));
    $description = mysqli_real_escape_string($db,htmlspecialchars($_POST['description']));
    $startingHour = mysqli_real_escape_string($db,htmlspecialchars($_POST['starting_hour']));
    $adresse = mysqli_real_escape_string($db,htmlspecialchars($_POST['adresse']));
    $city = mysqli_real_escape_string($db,htmlspecialchars($_POST['city']));
    $postalCode = mysqli_real_escape_string($db,htmlspecialchars($_POST['postal_code']));
    $country = mysqli_real_escape_string($db,htmlspecialchars($_POST['country']));
    if(isset($_POST['alcool']) && $_POST['alcool'] == "1")
        $alcool = 0;
    else $alcool = 1;
    if(isset($_POST['musique']) && $_POST['musiques'] == "1")
        $musique = 0;
    else $musique = 1;
    if(isset($_POST['costumes']) && $_POST['costumes'] == "1")
        $costumes = 0;
    else $costumes = 1;

    $requete = "INSERT INTO parties (announcer_id, date, nb_of_people, cash, age_moyen, description, starting_hour, adresse, city, postal_code, country, alcool, musique, costumes) VALUES ('".$_SESSION['id']."', '".$date."', '".$nbPeople."', '".$cash."', '".$ageMoyen."', '".$description."', '".$startingHour."', '".$adresse."', '".$city."', '".$postalCode."', '".$country."', '".$alcool."', '".musique."', '".$costumes."')";
    //$requete = "INSERT INTO parties (announcer_id, date, nb_of_people, cash, age_moyen, description, starting_hour, adresse, city, postal_code, country, alcool, musique, costumes) VALUES ('1', '2020-08-18', '6', '20', '20', 'Aucune description.', '20:00', '42 rue', 'Annecy', '74000', 'France', '0', '0', '1')";
    $exec_requete = mysqli_query($db,$requete);
   header('Location: '.$_SERVER['HTTP_REFERER']); // utilisateur ou mot de passe vide
}
else
{
   header('Location: '.$_SERVER['HTTP_REFERER'].'?erreur=2');
}
mysqli_close($db); // fermer la connexion
?>