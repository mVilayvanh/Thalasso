<?php 
    session_start();
    if(!isset($_SESSION['pseudo'])){
        header("Location: accueil.php");
        die();
    }
    if (!$_SESSION['identifiant'] == 'admin'){
        header("Location: accueil.php");
        die();
    }
?>
<p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>