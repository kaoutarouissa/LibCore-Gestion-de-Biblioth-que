<?php

while (true) {
    echo "\n\n";
    echo "Menu Principale\n\n\n";

    echo "1 - Bibliothécaire\n";
    echo "2 - Member\n";
    echo "0 - Quitter\n";

    $choix = readline("Choisir votre rôle : ");

    if ($choix == 1) {

        while (true) {

            echo "\nMenu Foncionalites\n\n\n";
            echo "1. Ajouter un livre\n";
            echo "2. Creer un compt membre\n";
            echo "3. Voir la liste des livres\n";
            echo "4. Retirer un livre\n";
            echo "0. Retour\n";

            $subChoice = readline("Choisir une option : ");

            if ($subChoice == 0) {
                break; 
            }

            if ($subChoice == 1) {
                echo "Ajout livre...\n";
            } elseif ($subChoice == 2) {
                echo "Gestion membres...\n";
            } elseif ($subChoice == 3) {
                echo "Liste des livres...\n";
            }elseif ($subChoice == 4) {
                echo "retirer des livres...\n";
            }
             else {
                echo "Choix invalide\n";
            }
        }

    } elseif ($choix == 2) {

        require_once "mainMember.php";

    } elseif ($choix == 0) {

        echo "Aurevoir\n";
        break; 

    } else {

        echo "Choix invalid\n";
    }
}
?>