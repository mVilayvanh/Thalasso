<p class="titre">Rechercher</p>
            <br>
            <form method="post" action="resultat.php">
                <?php
                // On utilise les données de la base pour créer le formulaire
                // Une connexion est donc nécessaire

                $user =  'mickael.vilayvanh';
                $pass =  'tAgeadai34';
                try {
                    $cnx = new PDO("pgsql:host='sqletud.u-pem.fr'; dbname=mickael.vilayvanh_db",
                    $user, $pass
                    );
                }
                catch (PDOException $e) {
                    echo "ERREUR : La connexion a échouée";
                    echo "</br> $e";
                }

                // Selection déroulante des différentes prestations
                // On récupère la table listant les noms des prestations.

                $req_prest = "SELECT * FROM prestation";
                $res = $cnx->query($req_prest);
                $res->setFetchMode(PDO::FETCH_ASSOC);
                echo "<select name='prest'>\n";
                echo "\t\t\t\t<option value='defaut' selected='selected'>Prestation</option>\n";

                foreach($res as $ligne){
                    // Affichage de la ligne
                    echo "\t\t\t\t<option value=".$ligne["nom"].">".$ligne["nom"]."</option>\n";
                }
                $res->closeCursor();

                // Variable qui ajoutera l'attribut selected de la liste déroulante
                echo "\t\t\t\t</select>\n</br>\n";
                
                echo "\t\t\t\t<br>\n\t\t\t<select name='annees'>\n";
                echo "\t\t\t\t<option value='defaut'>Année</option>\n";
                for($i=2019; $i<=2025; $i++)
                {
                    // Affichage de la ligne
                    echo "\t\t\t\t<option value='".$i."'>".$i."</option>\n";
                }
                echo "\t\t\t\t</select>\n</br>\n";
                ?>
                <br>
                <select name='saison'>
                <option value='defaut' selected='selected'>Saison</option>
                <option value='printemps'>Printemps</option>
                <option value='ete'>Ete</option>
                <option value='automne'>Automne</option>
                <option value='hiver'>Hiver</option>
                </select>
                <br><br>
                <input type="reset" name="reset" value="Réinitialiser"/>
                <input type="submit" name="submit" value="Valider"/>
            </form>
