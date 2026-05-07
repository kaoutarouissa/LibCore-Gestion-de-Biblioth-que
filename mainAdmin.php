<?php
require_once 'Database/connection.php';
require_once 'src/Services/Library.php';
require_once 'src/Entities/User.php';      // Toujours inclure le parent avant l'enfant
require_once 'src/Entities/Librarian.php';
$library = new Library();
$admin = new Librarian("Admin", "admin@bibli.com", "Librarian", $library);
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
                $titre = readline("Titre du livre : ");
    $auteur = readline("Auteur : ");
    $isbn = readline("ISBN : ");
    echo $admin->AjouterLivre($titre, $auteur, $isbn) . "\n";
            } elseif ($subChoice == 2) {
                echo "crere compt  membres...\n";
                $nom = readline("Nom du membre : ");
    $email = readline("Email : ");
    $type = readline("type : ");
   echo $library->addCompte($nom, $email, $type);


            } elseif ($subChoice == 3) {
                echo "Liste des livres...\n";
                
                echo $admin->getLivre() . "\n";

            }elseif ($subChoice == 4) {
                echo "retirer des livres...\n";
                $titre = readline("Titre du livre à supprimer : ");
    
    echo $admin->RetirerLivre($titre) . "\n";
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