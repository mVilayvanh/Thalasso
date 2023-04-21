<?php session_start(); ?>
<form method="POST"> 
Identifiant <input type="text" name="identifiant" size="12"><br>
Mot de passe <input type="text" name="password" size="12"> 
<input type="submit" name = "connexion"> 
<?php
        if (isset( $_POST['connexion'])){
            $pseudo = $_POST['identifiant'];
            $mdp = $_POST['password']; // 
            $result_cnx = "SELECT * FROM admin WHERE identifiant = '$identifiant' and mdp = '$mdp'"; 
            $results= $cnx -> query($result_cnx);
            $results->setFetchMode(PDO::FETCH_ASSOC);
            if ($results){
                foreach ($results as $r){
                    if ($r){
                        $_SESSION['identifiant'] = $identifiant;
                        header("Location: admin.php");
                        die();
                    }
                }
            }
        }
?>