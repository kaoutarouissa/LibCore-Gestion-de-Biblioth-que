<?php



class Library extends Database{
    private $books = [];
    private $users = [];

    public function addLivre($titre, $auteur, $ISBN) {
        $db = $this->connect();
         $check = "SELECT * FROM books WHERE titre = '$titre'";

    $result = $db->query($check);

    if($result->num_rows > 0){

        return "Le livre existe déjà";

    }
        $sql = "INSERT INTO books (titre, auteur, ISBN) VALUES ('$titre', '$auteur', '$ISBN')";
    // Logique pour ajouter le livre dans un tableau ou une BDD
        if ($db->query($sql) === TRUE) {
        return "Le livre '$titre' a bien été ajouté à la base de données.";
    } else {
        return "Erreur lors de l'ajout : " . $db->error;
    } 
    }

    public function addCompte($nom, $email,$type) {
       
                $db = $this->connect();
        $sql = "INSERT INTO users (name, email, type) VALUES ('$nom', '$email', '$type')";
        if ($db->query($sql) === TRUE) {
        return "Le compte de $nom  ET $type a été créé avec succès.";
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
            echo "Titre : " . $row['titre'] . "\n";
            echo "Auteur : " . $row['auteur'] . "\n";;
            echo "ISBN : " . $row['ISBN'] . "\n\n";
        }

    } else {

        echo "Aucun livre trouvé";
    }
}

  public function RetirerLivre($titre){

    $db = $this->connect();

    
    $sql = "SELECT id FROM books WHERE titre='$titre'";

    $result = $db->query($sql);

    if($result->num_rows == 0){

        return "Livre introuvable";
    }

    $row = $result->fetch_assoc();

    $book_id = $row['id'];

   $sql="DELETE FROM emprunts WHERE book_id='$book_id'";


    $db->query($sql);

    
    $dlt = "DELETE FROM books WHERE id='$book_id'";

    if($db->query($dlt) === TRUE){

        return "Livre supprimé avec succès";

    } else {

        return "Erreur : " . $db->error;
    }
}
}




?>