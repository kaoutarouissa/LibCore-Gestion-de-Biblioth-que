<?php
require_once 'User.php';
class book {
    private string $titre;
    private string $auteur;
    private int $ISBN;
    private string $status
    public function __construct($titre,$auteur,$ISBN,$status){
        $this->titre=$titre;
        $this->auteur=$auteur;
        $this->ISBN=$ISBN;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function getAuteur(){
        return $this->auteur;
    }
    public function getISBN(){
        return $this->ISBN;
    }
}
?>