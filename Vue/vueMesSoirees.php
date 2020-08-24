<?php
ob_start(); ?>
<link rel="stylesheet" href="../CSS/soirees.css"/>
<?php
$header = ob_get_clean();

ob_start();
?>
<br /> <br /> <br/>
<a href="../index.php?direction=ajouterSoirees">Déposer une annonce</a>
<div id="mesSoirees">
<?php if($parties->rowCount() > 0){ 
    foreach($parties as $party){ ?>
    <div class="partyDiv">
        <div class="partyHeader">
            <div>
                <img src="../pdpUsers/<?php echo $party['picture']; ?>">
                <p><?php echo $party['nickname']; ?></p>
            </div>
            <div>
                <p>Places restantes : <?php $remaining = $party['nb_of_people']-$party['places_reserved']; if($remaining == 0) echo "<span style='color:red;'>COMPLET </span>"; else echo $remaining; ?></p>
                <input type="date" value="<?php echo $party['date']; ?>" disabled>
                <div class="icones">
                    <span>Extras :</span>
                    <img class="icone" id="cash" src="../CSS/img/<?php if($party['cash'] > 0) echo "cash_active.jpg"; ?>">
                    <img class="icone" id="ageMoyen" src="../CSS/img/<?php if($party['age_moyen'] >= 30) echo "icone_30.png"; else if($party['age_moyen'] >= 20) echo "icone_20.png"; else echo "icone_18.png"; ?>">
                    <?php if($party['alcool'] == 0){?><img class="icone" id="alcool" src="../CSS/img/icone_alcool.png"> <?php } ?>
                    <?php if($party['musique'] == 0){?><img class="icone" id="musique" src="../CSS/img/icone_musique.png"> <?php } ?>
                </div>
            </div>
        </div>
        <div class="partyBody">
            <p>Lieu : <?php echo $party['city']; ?></p>
            <p><?php echo $party['description']; ?></p>
        </div>
        <div class="partyFooter">
            <a href="#">Editer</a>
            <a href="#">Supprimer</a>
            <a href="#"> Voir les demandes</a>
        </div>
    </div>
<?php }
} else{ ?>
    <div>
        <p>Vous n'avez organisée aucune soirée jusqu'a maintenant.</p>
        <a href="../index.php?direction=ajouterSoirees">Déposer une annonce</a>
    </div>
<?php } ?>
</div>
<?php
$contenu = ob_get_clean();
require "Template.php";