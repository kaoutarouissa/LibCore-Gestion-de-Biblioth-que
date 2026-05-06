<?php
class Book{
    protected $titre;
    protected $auteur;
    protected $ISBN;
    public function __construct($titre,$auteur,$ISBN){
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