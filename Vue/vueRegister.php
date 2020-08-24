<?php
ob_start();
?>
<br/><br/><br/>
<form action="../Controleur/Register.php" method="post";>
    <div class="form-group">
        <label>Nom</label>
        <input type="text" placeholder="Nom d'utilisateur" name="username" required>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" placeholder="Mot de passe" name="password" required>
    </div>
    <div class="form-group">
        <label>Confirmer le mot de passe</label>
        <input type="password" placeholder="Mot de passe" name="confirmPassword" required>
    </div>
    <div class="form-group">
        <label>Date de naissance</label>
        <input type="date" placeholder="Date de naissance" name="birthdate" required>
    </div>
    <div class="form-group">
        <label>Mail</label>
        <input type="email" placeholder="Mail" name="mail" required>
    </div>
    <div class="form-group">
        <label>Sexe :</label>
        <span>Homme </span><input type="radio" name="sexe" value="0" >
        <span>Femme </span><input type="radio" name="sexe" value="1" >
        <span>Autre </span><input type="radio" name="sexe" value="3" >
    </div>
    <button type="submit" id='submit' class="btn btn-primary" value="LOGIN">Envoyer</button>
    <p>Déja un compte ?</p>
    <a href="../Vue/vueLogin.php">Connectez-vous maintenant</a>
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