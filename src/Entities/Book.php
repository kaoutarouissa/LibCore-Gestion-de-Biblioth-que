<?php
class Book{
    protected string $titre;
    protected string $auteur;
    protected string $ISBN;
    public function __construct(string $titre,string $auteur,string $ISBN){
        $this->titre=$titre;
        $this->auteur=$auteur;
        $this->ISBN=$ISBN;
    }
       public function getTitre():string{
        return $this->titre;
    }
       public function getAuteur():string{
        return $this->auteur;
    }
       public function getISBN() : string{
        return $this->ISBN;
    }
}
?>