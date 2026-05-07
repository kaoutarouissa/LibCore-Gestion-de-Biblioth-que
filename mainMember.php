<?php

require_once "Database/conne.php";

echo "===== ESPACE MEMBRE =====\n";

$email = readline("Entrez votre email : ");

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

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

    // =========================
    // RECHERCHER
    // =========================
    if ($choice == 1) {

        $search = readline("Titre ou auteur : ");

        $stmt = $pdo->prepare("
            SELECT * FROM books
            WHERE titre LIKE ?
            OR auteur LIKE ?
        ");

        $stmt->execute([
            "%$search%",
            "%$search%"
        ]);

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($books)) {

            echo "Aucun livre trouvé\n";

        } else {

            echo "\nListe des livres :\n";

            foreach ($books as $book) {

                echo "- " .
                    $book['titre'] .
                    " | " .
                    $book['auteur'] .
                    " | " .
                    $book['etat'] .
                    "\n";
            }
        }
    }

    // =========================
    // EMPRUNTER
    // =========================
    elseif ($choice == 2) {

        $title = readline("Titre du livre : ");

        $stmt = $pdo->prepare("
            SELECT * FROM books
            WHERE titre = ?
        ");

        $stmt->execute([$title]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {

            echo "Livre introuvable\n";
            continue;
        }

        if ($book['etat'] != 'disponible') {

            echo "Livre non disponible\n";
            continue;
        }

        // changer état
        $stmt = $pdo->prepare("
            UPDATE books
            SET etat = 'emprunte'
            WHERE id = ?
        ");

        $stmt->execute([$book['id']]);

        // ajouter emprunt
        $stmt = $pdo->prepare("
            INSERT INTO emprunts (
                date_emprunt,
                book_id,
                user_id
            )
            VALUES (
                NOW(),
                ?,
                ?
            )
        ");

        $stmt->execute([
            $book['id'],
            $user['id']
        ]);

        echo "Livre emprunté avec succès\n";
    }

    // =========================
    // RETOURNER
    // =========================
    elseif ($choice == 3) {

        $title = readline("Titre du livre : ");

        $stmt = $pdo->prepare("
            SELECT * FROM books
            WHERE titre = ?
        ");

        $stmt->execute([$title]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {

            echo "Livre introuvable\n";
            continue;
        }

        // rendre disponible
        $stmt = $pdo->prepare("
            UPDATE books
            SET etat = 'disponible'
            WHERE id = ?
        ");

        $stmt->execute([$book['id']]);

        // date retour
        $stmt = $pdo->prepare("
            UPDATE emprunts
            SET date_retourn_livre = NOW()
            WHERE user_id = ?
            AND book_id = ?
            AND date_retourn_livre IS NULL
        ");

        $stmt->execute([
            $user['id'],
            $book['id']
        ]);

        echo "Livre retourné avec succès\n";
    }

    // =========================
    // MES LIVRES
    // =========================
    elseif ($choice == 4) {

        $stmt = $pdo->prepare("
            SELECT books.titre,
                   books.auteur,
                   emprunts.date_emprunt
            FROM emprunts

            JOIN books
            ON emprunts.book_id = books.id

            WHERE emprunts.user_id = ?
            AND emprunts.date_retourn_livre IS NULL
        ");

        $stmt->execute([$user['id']]);

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($books)) {

            echo "Aucun livre emprunté\n";

        } else {

            echo "\nMes livres :\n";

            foreach ($books as $book) {

                echo "- " .
                    $book['titre'] .
                    " | " .
                    $book['auteur'] .
                    " | Date : " .
                    $book['date_emprunt'] .
                    "\n";
            }
        }
    }

    // =========================
    // QUITTER
    // =========================
    elseif ($choice == 0) {

        echo "Au revoir\n";
        break;
    }

    else {

        echo "Choix invalide\n";
    }
}