<?php
include("header.html");
echo "\n";
?>
        <div class="vbar"></div>
        <a class="accueil" href="index.php">Accueil</a>
        <div id="titre">Centre de la loutre joyeuse</div>
        <div class="search">
            <?php
            include("form.php");
            ?>
        </div>
        <?php
        $prest = $_POST['prest'];
        $annee = $_POST['annees'];
        $saison = $_POST['saison'];
        $user =  'mickael.vilayvanh';
        $pass =  'tAgeadai34';
        try {
            $cnx = new PDO("pgsql:host='sqletud.u-pem.fr'; dbname=mickael.vilayvanh_db",
            $user, $pass
            );
            echo "<table align='center'>\n";
            echo "\t\t\t<tr>
            \t<th>Prestation</th>
            \t<th>Année</th>
            \t<th>Saison</th>
            \t<th>Tarif</th>
            </tr>\n";
            if ($prest == 'defaut' && $saison == 'defaut' && $annee == 'defaut'){
                $req = "SELECT * FROM contient";
            }else if ($saison != 'defaut'){
                if ($annee != 'defaut' && $prest == 'defaut'){
                } else if ($annee == 'defaut' && $prest != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.
                    "%' AND nom = '".$prest."'";
                } else if ($annee != 'defaut' && $prest != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.$annee.
                    "' AND nom = '".$prest."'";
                } else {
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison."%'";
                }

            } else if ($prest != 'defaut'){
                if ($annee != 'defaut' && $saison == 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '%".$annee.
                    "' AND nom = '".$prest."'";
                } else if ($annee == 'defaut' && $saison != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.
                    "%' AND nom = '".$prest."'";
                } else if ($annee != 'defaut' && $prest != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.$annee.
                    "' AND nom = '".$prest."'";
                } else {
                    $req = "SELECT * FROM contient WHERE nom = '".$prest."'";
                }
            } else if ($annee != 'defaut'){
                if ($prest != 'defaut' && $saison == 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '%".$annee.
                    "' AND nom = '".$prest."'";
                } else if ($annee == 'defaut' && $saison != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.$annee."'";
                } else if ($annee != 'defaut' && $prest != 'defaut'){
                    $req = "SELECT * FROM contient WHERE saison LIKE '".$saison.$annee.
                    "' AND nom = '".$prest."'";
                } else {
                    $req = "SELECT * FROM contient WHERE saison LIKE '%".$annee."'";
                }
            }
            $res = $cnx->prepare($req);
            $res->execute();
            if ($res->rowCount() > 0){
                $res = $cnx->query($req);
                $res->setFetchMode(PDO::FETCH_ASSOC);
                foreach($res as $ligne){
                    // Préserve uniquement les chiffre de 0 à 9 présents dans une chaine de caractères.
                    $tab_annee = preg_replace('`[^0-9]`', '', $ligne['saison']);
                    // Préserve uniquement les lettre de a à z dans la chaine
                    $tab_saison = preg_replace('`[^a-z]`', '', $ligne['saison']);
                    echo "\t\t\t<tr>\n";
                    echo "\t\t\t\t<td>".$ligne['nom']."</td>\n";
                    echo "\t\t\t\t<td>".$tab_annee."</td>\n";
                    echo "\t\t\t\t<td>".$tab_saison."</td>\n";
                    echo "\t\t\t\t<td>".$ligne['tarif']."€</td>\n";
                    echo "\t\t\t</tr>\n";
                }
            } else {
                // Redirige en cas de résultat vide.
                header("Location: no_result.php");
                die();
            }
            echo "\t\t</table>\n";
        }
        catch (PDOException $e) {
            echo "ERREUR : La connexion a échouée";
            echo "</br> $e";
        }
        ?>
<?php
include("footer.html");
?>