<?php
require_once 'User.php';
require_once 'Book.php';

class Librarian extends User{
    protected $library;
    public function __construct(string $name, string $email, string $type, $library){
        parent::__construct($name, $email,$type);
        $this->library=$library;
        
        }
        
        public function AjouterLivre($titre,$auteur,$ISBN): string {
            $LivreAjouté=$this->library->addLivre($titre,$auteur,$ISBN);
            return "livre ajouté sous le nom : ".$LivreAjouté;
    }
    public function AjouterCompt($nom,$email):string{
    return "compt ajouté  : ".$this->library->addCompt($nom,$email) ;
        public function afficherLivre($titre):string{
        return "livre affiché sous le nom : ".$this->getLivre($titre) ;

    }
    public function RetirerLivre($titre):string{
return "livre retiré  : ".$this->library->removeLivre($titre) ;
    }
}
?>