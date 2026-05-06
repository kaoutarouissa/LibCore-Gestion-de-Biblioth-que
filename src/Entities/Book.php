<?php
// require_once 'User.php';
class Book {
    protected string $titre;
    protected string $auteur;
    protected int $ISBN;
    protected string $status;
    public function __construct(string $titre, string $auteur, int $ISBN, string $status){
        $this->titre=$titre;
        $this->auteur=$auteur;
        $this->ISBN=$ISBN;
        $this->status=$status;

    }
}
echo "This is the Book entity.";
?>