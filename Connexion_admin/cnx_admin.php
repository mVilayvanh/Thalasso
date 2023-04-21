<?php
    $user = 'micken';
    $pass = '1006';
    try {
        $cnx = new PDO("pgsql:host='localhost'; dbname=micken",
        $user, $pass
        );
        $id = $_POST['identifiant'];
        $pw = $_POST['password'];
        if($pw == 'ADMIN' && $id == 'ADMIN'){
            $_SESSION['admin'] = 1;
            header("Location: test.php");
            die();
        }
        header("Location: no_result_log.php");
        die();  
    }
    
    catch (PDOException $e) {
        echo "ERREUR : La connexion a échouée";
        echo "</br> $e";
    }
    include("footer.html");
?>