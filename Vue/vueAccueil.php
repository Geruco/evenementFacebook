<?php
ob_start();
?>
<br /> <br />
<div id="contenu">
    <section id="section1">
        <h4>Vous organisez une soirée ?</h4>
        <p>Créez une annonce pour trouver des invités supplémentaires !</p>
    </section>
    <section id="section2">
        <h4>Vous ne savez pas quoi faire ce soir ?</h4>
        <p>Recherchez des soirées et rencontrez de nouvelles personnes !</p>
    </section>
    <section id="section3">
        <p>Dans les deux cas, créez un compte rapidement afin de profiter de ces options !</p>
        <a href="#">Créer un compte</a>
    </section>
</div>
<?php
$contenu = ob_get_clean();
require "Template.php";