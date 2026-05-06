<?php

echo "============= MENU ============\n";
echo "\n";

echo "1 - Bibliothécaire\n";
echo "2 - Member\n";

$choice = readline("Choisir votre rôle : ");
if($choice)
if ($choice == 1) {

    echo "\n--- DASHBOARD BIBLIOTHÉCAIRE ---\n";

    echo "1. Ajouter un livre\n";
    echo "2. Gérer les membres\n";
    echo "3. Voir les livres\n";

} elseif ($choice == 2) {

    echo "\n--- DASHBOARD MEMBER ---\n";
    echo "1. Rechercher un livre\n";
    echo "2. Emprunter un livre\n";
    echo "3. Retourner un livre\n";

} else {

    echo "Choix invalide \n";
}