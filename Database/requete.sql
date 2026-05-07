CREATE DATABASE Library;
USE Library;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    type VARCHAR(50) NOT NULL
);


CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    ISBN VARCHAR(50) UNIQUE NOT NULL,
    etat VARCHAR(50) DEFAULT 'disponible'
);


CREATE TABLE membres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    id_user INT,

    FOREIGN KEY (id_user) REFERENCES users(id)
);


CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_emprunt DATE NOT NULL,
    date_retourn_livre DATE,
    book_id INT,
    user_id INT,

    FOREIGN KEY (book_id) REFERENCES books(id),

    FOREIGN KEY (user_id) REFERENCES users(id)
);

DESCRIBE emprunts;