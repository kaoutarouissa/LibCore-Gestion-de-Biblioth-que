<?php
require_once 'User.php';
echo "jhugugu";
class Librarian extends User{
    public function __construct(string $name, string $email, string $type){
        // return "Le membre " . $this->name . " de type " . $type->getType();
        parent::__construct($name, $email,$type);
        
        }
        
        public function Ajouter(): string {
        return "Le bibliothécaire " . $this->getName() . " est de type : " . $this->getType();
    }
}
?>