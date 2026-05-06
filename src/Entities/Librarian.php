<?php
require_once 'User.php';
require_once 'Book.php';
echo "jhugugu";
class Librarian extends User{
    public function __construct(string $name, string $email, string $type){
        // return "Le membre " . $this->name . " de type " . $type->getType();
        parent::__construct($name, $email,$type);
        
        }
        
        public function AjouterLivre(): string {
        return "livre ajouteé sous le nom de  " . $this->getTitre() . " est de isbn : " . $this->getISBN();
    }
    public function AjouterCompt():string{
        return "compte ajouter sous le nom " . $this->get();
    }
}
?>