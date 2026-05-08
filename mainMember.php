<?php

require_once "Database/connection.php";

$db = new Database();
$conn = $db->connect();

echo "===== ESPACE MEMBRE =====\n\n";


$email = readline("Entrer votre email : ");

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

if (!$user) {

    echo "Utilisateur introuvable\n";
    exit;
}

echo "\nBienvenue " . $user['name'] . "\n";


while (true) {

    echo "\n===== MENU =====\n";

    echo "1 - Voir les livres\n";
    echo "2 - Emprunter un livre\n";
    echo "3 - Retourner un livre\n";
    echo "0 - Quitter\n";

    $choice = readline("Choix : ");

    if ($choice == 1) {

        $sql = "SELECT * FROM books";
        $result = $conn->query($sql);

        echo "\n===== LISTE DES LIVRES =====\n";

        while ($book = $result->fetch_assoc()) {

            echo $book['id'] . " - ";
            echo $book['titre'] . " | ";
            echo $book['auteur'] . " | ";
            echo $book['etat'] . "\n";
        }
    }


    elseif ($choice == 2) {

        $titre = readline("titre du livre : ");

        $sql = "SELECT * FROM books WHERE titre='$titre'";
        $result = $conn->query($sql);

        $book = $result->fetch_assoc();

        if (!$book) {

            echo "Livre non trouvé\n";
        }

        elseif ($book['etat'] != "disponible") {

            echo "Livre non disponible\n";
        }

        else {


            $sql = "UPDATE books
                    SET etat='emprunte'
                    WHERE titre='$titre'";

            $conn->query($sql);


           $sql = "INSERT INTO emprunts(user_id, book_id, date_emprunt)
        VALUES(
            {$user['id']},
            {$book['id']},
            NOW()
        )";

            $conn->query($sql);

            echo "Livre emprunté avec succès\n";
        }
    }


    elseif ($choice == 3) {

      $titre = readline("Titre du livre : ");

$sql = "SELECT * FROM books WHERE titre='$titre'";
$result = $conn->query($sql);

$book = $result->fetch_assoc();

if (!$book) {

    echo "Livre introuvable\n";
}

else {

    $sql = "UPDATE books
            SET etat='disponible'
            WHERE titre='$titre'";

    $conn->query($sql);

    $sql = "UPDATE emprunts
            SET date_retourn_livre = NOW()
            WHERE book_id={$book['id']}
            AND user_id={$user['id']}
            AND date_retourn_livre IS NULL";

    $conn->query($sql);

    echo "Livre retourné avec succès\n";
}}


    elseif ($choice == 0) {

        echo "Au revoir\n";
        break;
    }

    else {

        echo "Choix invalide\n";
    }
}
?>