<?php

            $connexion = new PDO( 'mysql:host=localhost;dbname=gestionnaire-de-menus', 'root', '' );
            if(!$connexion){
                    die("Erreur : La connexion a échoué.");
            }
    ?>
