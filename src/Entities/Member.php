<?php
require_once "User.php";

class Member extends User {

    private array $borrowedBooks = [];
    private bool $isActive = true;

    public function __construct(string $name, string $email) {
        parent::__construct($name, $email, "member");
    }

    public function isActive(): bool {
        return $this->isActive;
    }

    public function borrowBook($book): void {
        $this->borrowedBooks[] = $book;
    }

    public function returnBook($book): void {

    for ($i = 0; $i < count($this->borrowedBooks); $i++) {

        if ($this->borrowedBooks[$i] === $book) {

            unset($this->borrowedBooks[$i]);
        }
    }
    $this->borrowedBooks = array_values($this->borrowedBooks);
}

    public function getBorrowedBooks(): array {
        return $this->borrowedBooks;
    }
}
?>