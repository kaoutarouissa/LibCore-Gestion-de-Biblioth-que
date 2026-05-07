<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Book.php';
require_once __DIR__ . '/../Services/Library.php';

class Librarian extends User{
    protected $library;

    public function __construct(string $name, string $email, string $type, $library){
        parent::__construct($name, $email,$type);
        $this->library = $library;
    }

    public function AjouterLivre($titre,$auteur,$ISBN): string {
        $LivreAjouté = $this->library->addLivre($titre,$auteur,$ISBN);
        return "livre ajouté sous le nom : ".$LivreAjouté;
    }

    public function AjouterCompt($nom,$email): string {
        return "compt ajouté  : ".$this->library->addCompte($nom, $email, 'member');
    }

    public function getLivre(){
        return $this->library->getLivre();
    }

    public function afficherLivre($titre): string{
        return "livre affiché sous le nom : ".$this->getLivre();
    }

    public function RetirerLivre($titre): string{
        return "livre retiré  : ".$this->library->RetirerLivre($titre);
    }
}
?>