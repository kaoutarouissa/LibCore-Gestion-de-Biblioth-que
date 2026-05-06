<?php
require_once 'User.php';
class Librarian extends User{
    public function __construct(string $name, string $email, string $type){
        // return "Le membre " . $this->name . " de type " . $type->getType();
        parent::__construct($name, $email,$type);
        $this->type = $type;
        public function Ajouter(): string {
        return "Le bibliothécaire " . $this->name . " est de type : " . $this->type;
    }
    }
}
?>