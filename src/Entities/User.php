<?php
abstract class User{
    protected string $name;
    protected string $email;
    protected string $type;
    public function __construct(string $name, string $email, string $type){
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
    }
    public function getName():string{
        return $this->name;
    }
    public function getEmail():string{
        return $this->email;
    }
      public function getType():string{
        return $this->type;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
}
?>