<?php
ob_start(); ?>
<link rel="stylesheet" href="../CSS/profil.css"/>
<?php
$header = ob_get_clean();

ob_start();
foreach($profil as $leProfil){ ?>
<br/><br/>
<div id="profil">
    <div id="photoDiv">
        <?php
        if($leProfil['picture'] == "blank")
            echo "<img src='../CSS/img/defaultPicture.png' />";
        else{
            echo "<img src='../pdpUsers/".$leProfil['picture']."'/>";
        }    
          if(isset($_SESSION['connected'])){
                if($_SESSION['connected']==true && $_SESSION['id'] == $leProfil['id']){ ?>
        <form action="../Controleur/ModifProfil.php?picture" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /> <input type="file" name="picture" required />
            <button type="submit" class="btn btn-primary">Modifier la photo</button>
        </form>
        <?php   }
     } ?>
    </div>
    
    <form action="../Controleur/ModifProfil.php" id="infos" method="post";>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" placeholder="Nom d'utilisateur" name="username" value="<?php echo $leProfil['nickname']; ?>" disabled required>
        </div>
        <div class="form-group">
            <label>Date de naissance</label>
            <input type="date" placeholder="Date de naissance" name="birthdate"  value="<?php echo $leProfil['birthdate']; ?>" disabled required>
        </div>
        <div class="form-group">
            <label>Mail</label>
            <input type="email" placeholder="Mail" name="mail"  value="<?php echo $leProfil['mail']; ?>" disabled required>
        </div>
        <div class="form-group">
            <label>A propos de vous :</label>
            <textarea placeholder="Parlez-nous de vous !" name="Apropos" disabled maxlength="150"><?php echo $leProfil['Apropos']; ?></textarea>
        </div>
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
      if(isset($_SESSION['connected'])){
            if($_SESSION['connected']==true && $_SESSION['id'] == $leProfil['id']){ ?>
                <button type="button" id="modifBtn" onclick="activeModif();">Modifier le profil</button>
    <?php   }
     } ?>
    <div id="separator">-----------------------------------------------------</div>
    <div id="Commentaries">
        <p>Note moyenne : <span class="noteMoyenne"></span></p>
        <?php if(isset($_SESSION['connected'])){
                if($_SESSION['connected']==true && $_SESSION['id'] != $leProfil['id']){ ?>
        <button type="button" onclick="activeAjoutCommentaire();">Ajouter un commentaire</button>
        <div id="ajouterCommentaire" class="hidden">
            <form action="../Controleur/addCommentary.php" method="post">
                <textarea placeholder="Ecrire un commentaire !" name="commentaire" maxlength="200" required></textarea>
                <input type="number" max="5" min="0"  placeholder="Note" name="rating" required>
                <input type="text" class="hidden" name="cible" value ="<?php echo $leProfil['id']; ?>" required>
                <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                <button type="button" onclick="unactiveAjoutCommentaire();">Annuler</button>
            </form>
        </div>
            <?php   }
         } ?>
        <div id="separator">-----------------------------------------------------</div>
        <?php
        $total = 0;
        $nbCommentary = 0;
        $moyenne = 0;
        foreach($commentaries as $commentary){ 
            $total += $commentary['rating'];
            $nbCommentary += 1;
            if($nbCommentary > 0)
                $moyenne = $total / $nbCommentary;
            else
                $moyenne = -1;
            ?>
        <div class="commentary">
            <div class="commentaryHeader">
                <p><?php echo $commentary['nickname']; ?></p>
                <p><?php echo $commentary['rating']; ?> / 5</p>
            </div>
            <div class="commentaryContent">
                <p><?php echo $commentary['content']; ?></p>
            </div>
            <div class="commentaryFooter">
                <a href="../index.php?profil=<?php echo $commentary['user_id']; ?>" >Voir le profil</a>
            </div>
        </div>
      <?php } ?>
    </div>
    
    
    <div id="separator">-----------------------------------------------------</div>
    <div class="hidden">
        <p id="noteNickname"><?php echo $leProfil['nickname']; ?></p>
        <p id="noteBirthdate"><?php echo $leProfil['birthdate']; ?></p>
        <p id="noteMail"><?php echo $leProfil['mail']; ?></p>
        <p id="noteDescrip"><?php echo $leProfil['Apropos']; ?></p>
    </div>
</div>

<script>
    window.addEventListener("load", function(){
        document.querySelector(".noteMoyenne").innerHTML = "<?php echo $moyenne; ?> / 5";
    })
    function activeModif(){
        document.querySelectorAll("#infos input, textarea").forEach(function(elem){
            elem.removeAttribute("disabled");
        })
        let btn = document.createElement("button");
        btn.setAttribute("type", "submit");
        btn.setAttribute("class", "btn btn-primary");
        btn.setAttribute("value", "LOGIN");
        btn.innerHTML="Modifier";
        document.querySelectorAll("form")[1].appendChild(btn);
        
        let annul = document.createElement("button");
        annul.setAttribute("type", "button");
        annul.setAttribute("class", "btn btn-primary");
        annul.innerHTML="Annuler";
        document.querySelectorAll("form")[1].appendChild(annul);
        annul.setAttribute("onclick", "disactiveModif();");
        
        document.querySelector("#modifBtn").setAttribute("style", "display:none;");
    }
    
    function disactiveModif(){
        document.querySelectorAll("#infos input, textarea").forEach(function(elem){
            elem.setAttribute("disabled", "true");
        })
        document.querySelector("#modifBtn").setAttribute("style", "");
        document.querySelectorAll("#infos button").forEach(function(elem){
            elem.remove();
        })
        document.getElementsByName("username")[0].value = document.getElementById("noteNickname").innerHTML;
        document.getElementsByName("birthdate")[0].value = document.getElementById("noteBirthdate").innerHTML;
        document.getElementsByName("mail")[0].value = document.getElementById("noteMail").innerHTML;
        document.getElementsByName("Apropos")[0].value = document.getElementById("noteDescrip").innerHTML;
    }
    function activeAjoutCommentaire(){
        document.getElementById("ajouterCommentaire").classList.toggle("hidden");
    }
    function unactiveAjoutCommentaire(){
        document.getElementById("ajouterCommentaire").classList.toggle("hidden");
    }
</script>
<?php
}
$contenu = ob_get_clean();
require "Template.php";