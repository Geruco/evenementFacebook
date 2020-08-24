<?php
ob_start();
?>
<br /> <br />
<div id="logForm">
    <form action="../Controleur/Connection.php" method="post">
        <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input type="text" placeholder="Nom d'utilisateur" name="username" required>
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" placeholder="Mot de passe" name="password" required>
        </div>
        <button type="submit" id='submit' class="btn btn-primary" value="LOGIN">Envoyer</button>
        <a href="vueRegister.php">S'inscrire</a>
    <?php
     if(isset($_GET['erreur'])){
         $err = $_GET['erreur'];
         if($err==1 || $err==2)
             echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
     } ?>
    </form>
</div>
<?php
$contenu = ob_get_clean();
require "Template.php";