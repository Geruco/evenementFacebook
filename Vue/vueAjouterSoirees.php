<?php
ob_start();
?>
<br/><br/><br/>
<form action="../Controleur/addParty.php" method="post">
    <div class="form-group">
        <label>Date</label>
        <input type="date" placeholder="" name="date" required>
    </div>
    <div class="form-group">
        <label>Nombre d'invité recherché :</label>
        <input type="number" placeholder="ex : 5" name="nb_people" required>
    </div>
    <div class="form-group">
        <label>Participation financière en $ : (Laisser 0 si non demandé)</label>
        <input type="number" value="0" name="cash" required>
    </div>
    <div class="form-group">
        <label>Age moyen :</label>
        <input type="number" placeholder="ex : 23" name="age_moyen" required>
    </div>
    <div class="form-group">
        <label>Description de la soirée :</label>
        <textarea placeholder="Donnez envie de particper !" name="description" required> </textarea>
    </div>
    <div class="form-group">
        <label>Heure de début :</label>
        <input type="time" placeholder="XX:YY" name="starting_hour" required>
    </div>
    <div class="form-group">
        <p>Adresse de la soirée : (Ne sera affichée uniquement chez les invités acceptés)</p>
        <label>Numéro et rue :</label>
        <input type="text" placeholder="ex: 32 rue de l'aléatoire" name="adresse" required>
        <label>Ville :</label>
        <input type="text" placeholder="ex: Paris" name="city" required>
        <label>Code postal :</label>
        <input type="number" placeholder="ex: 75000" maxlength="5" name="postal_code" required>
        <label>Pays :</label>
        <input type="text" placeholder="ex: France" name="country" required>
    </div>
    <div class="form-group">
        <label>Extras :</label>
        <span>Alcool </span><input type="checkbox" value="1" name="alcool">
        <span>Musique </span><input type="checkbox" value="1" name="musique">
        <span>Costumes </span> <input type="checkbox" value="1" name="costumes">
    </div>
    <button type="submit" id='submit' class="btn btn-primary" value="LOGIN">Envoyer</button>
<?php
 if(isset($_GET['erreur'])){
     $err = $_GET['erreur'];
     if($err==1 || $err==2)
         echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
     if($err==0 || $err==3)
         echo "<p style='color:red'>Erreur</p>";
 } ?>
</form>
<?php
$contenu = ob_get_clean();
require "Template.php";