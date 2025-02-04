<?php

            $connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus(1) (2)', 'root', '' );
            if(!$connexion){
                    die("Erreur : La connexion a échoué.");
            }
    ?>
