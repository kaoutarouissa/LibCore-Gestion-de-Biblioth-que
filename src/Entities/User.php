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
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
      public function getType(){
        return $this->type;
    }
}
?>