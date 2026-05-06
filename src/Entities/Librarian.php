<?php
require_once 'User.php';
require_once 'Book.php';
require-once .Services/Library.php;
echo "jhugugu";
class Librarian extends User{
    protected $library;
    public function __construct(string $name, string $email, string $type){
        // return "Le membre " . $this->name . " de type " . $type->getType();
        parent::__construct($name, $email,$type);
        $this->library=$library;
        
        }
        
        public function AjouterLivre($titre,$auteur,$ISBN): string {
            return "livre ajouté sous le nom : ".$this->library->addLivre($titre,$auteur,$ISBN) ;
    }
    public function AjouterCompt($nom,$email):string{
    return "compt ajouté sous le nom : ".$this->addCompt() ;
    }
    public function afficherLivre($titre):string{
        return "livre affiché sous le nom : ".$this->getLivre() ;

    }
    public function RetirerLivre($titre):string{
return "livre retiré sous le nom : ".$this->removeLivre() ;
    }
}
?>