<?php

require_once "Database/connection.php";

$db = new Database();
$conn = $db->connect();

echo "===== ESPACE MEMBRE =====\n";

$email = readline("Entrez votre email : ");

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

if (!$user || $user['type'] != 'member') {

    echo "Membre non trouvé\n";
    exit;
}

echo "Bienvenue " . $user['name'] . "\n";

while (true) {

    echo "\n========= MENU =========\n";
    echo "1 - Rechercher un livre\n";
    echo "2 - Emprunter un livre\n";
    echo "3 - Retourner un livre\n";
    echo "4 - Mes livres\n";
    echo "0 - Quitter\n";

    $choice = readline("Choix : ");

    if ($choice == 1) {

        $search = readline("Titre ou auteur : ");

        $sql = "SELECT * FROM books 
                WHERE titre LIKE '%$search%' 
                OR auteur LIKE '%$search%'";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Aucun livre trouvé\n";

        } else {

            echo "\nListe des livres :\n";

            while ($book = $result->fetch_assoc()) {

                echo "- " . $book['titre'] .
                    " | " . $book['auteur'] .
                    " | " . $book['etat'] . "\n";
            }
        }
    }

    elseif ($choice == 2) {

        $title = readline("Titre du livre : ");

        $sql = "SELECT * FROM books WHERE titre = '$title'";
        $result = $conn->query($sql);

        $book = $result->fetch_assoc();

        if (!$book) {

            echo "Livre introuvable\n";
            continue;
        }

        if ($book['etat'] != 'disponible') {

            echo "Livre non disponible\n";
            continue;
        }

        $conn->query("UPDATE books SET etat='emprunte' WHERE id=" . $book['id']);

        $conn->query("INSERT INTO emprunts (date_emprunt, book_id, user_id)
                      VALUES (NOW(), {$book['id']}, {$user['id']})");

        echo "Livre emprunté avec succès\n";
    }

    elseif ($choice == 3) {

        $title = readline("Titre du livre : ");

        $sql = "SELECT * FROM books WHERE titre = '$title'";
        $result = $conn->query($sql);

        $book = $result->fetch_assoc();

        if (!$book) {

            echo "Livre introuvable\n";
            continue;
        }

        $conn->query("UPDATE books SET etat='disponible' WHERE id=" . $book['id']);

        $conn->query("UPDATE emprunts 
                      SET date_retourn_livre = NOW()
                      WHERE user_id={$user['id']} 
                      AND book_id={$book['id']} 
                      AND date_retourn_livre IS NULL");

        echo "Livre retourné avec succès\n";
    }

    elseif ($choice == 4) {

        $sql = "SELECT books.titre, books.auteur, emprunts.date_emprunt
                FROM emprunts
                JOIN books ON emprunts.book_id = books.id
                WHERE emprunts.user_id = {$user['id']}
                AND emprunts.date_retourn_livre IS NULL";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            echo "Aucun livre emprunté\n";

        } else {

            echo "\nMes livres :\n";

            while ($book = $result->fetch_assoc()) {

                echo "- " . $book['titre'] .
                    " | " . $book['auteur'] .
                    " | " . $book['date_emprunt'] . "\n";
            }
        }
    }

    elseif ($choice == 0) {

        echo "Au revoir\n";
        break;
    }

    else {

        echo "Choix invalide\n";
    }
}