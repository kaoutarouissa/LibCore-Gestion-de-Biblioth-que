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
        $sql = "INSERT INTO users (name, email, type) VALUES ('$nom', '$email', '$type')";
        if ($db->query($sql) === TRUE) {
        return "Le compte de $nom a été créé avec succès.";
    } else {
        return "Erreur lors de la création du compte : " . $db->error;
    }
    }
  public function getLivre(){

    $db = $this->connect();

    $sql = "SELECT * FROM books";

    $result = $db->query($sql);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
echo "liste des livres : \n\n";
            echo "Titre : " . $row['titre'] . "<br>";
            echo "Auteur : " . $row['auteur'] . "<br>";
            echo "ISBN : " . $row['ISBN'] . "<br><br>";
        }

    } else {

        echo "Aucun livre trouvé";
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