<?php
session_start();
include("header.html");
include("form_log.html");
?>
        <div class="vbar"></div>
        <a class="accueil" href="index.php">Accueil</a>
        <div class="search">
            <?php
            include("form.php");
            echo "\n";
            ?>
        </div>
        <div class="centre">Identifiant ou mot de passe incorrect</div>
<?php
include("footer.html");
?>