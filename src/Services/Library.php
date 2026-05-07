<?php



class Library extends Database{
    private $books = [];
    private $users = [];

    public function addLivre($titre, $auteur, $ISBN) {
        $db = $this->connect();
        $sql = "INSERT INTO books (titre, auteur, ISBN) VALUES ('$titre', '$auteur', '$ISBN')";
    // Logique pour ajouter le livre dans un tableau ou une BDD
        if ($db->query($sql) === TRUE) {
        return "Le livre '$titre' a bien été ajouté à la base de données.";
    } else {
        return "Erreur lors de l'ajout : " . $db->error;
    } 
    }

    public function addCompte($nom, $email,$type) {
        // Logique pour ajouter un membre
                $db = $this->connect();
        $sql = "INSERT INTO users (name, email, type) VALUES ('$name', '$email', '$type')";
        if ($db->query($sql) === TRUE) {
        return "Le compte de $nom a été créé avec succès.";
    } else {
        return "Erreur lors de la création du compte : " . $db->error;
    }
    }
    public function getLivre($titre){
                $db = $this->connect();
        $sql = "SELECT * FROM books WHERE titre = '$titre'";
        $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return "Livre trouvé : " . $row['title'] . " par " . $row['author'] . " (ISBN: " . $row['isbn'] . ")";
    } else {
        return "Aucun livre trouvé avec le titre : " . $titre;
    }
    }
    public function RetirerLivre($titre){
        $db = $this->connect();
    
    // On supprime la ligne qui correspond au titre
    $sql = "DELETE FROM books WHERE titre = '$titre'";
    
    if ($db->query($sql) === TRUE) {
        return "Le livre '$titre' a été retiré de la bibliothèque.";
    } else {
        return "Erreur lors de la suppression : " . $db->error;
    }
    }
}




?>