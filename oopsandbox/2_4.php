<?php

class User{
    public $name;
    public $age;

    public function __construct($name, $age){
        echo 'Class ' . __CLASS__ . ' has been created!';
        echo '<br>';
        $this->name = $name;
        $this->age = $age;
    }

    public function sayHello(){
        return $this->name . ' says Hello!';
    }

    public function __destruct(){

    }
}

$user1 = new User('Brad', 36);
echo $user1->name . ' is ' . $user1->age . ' years old.';
echo '<br>';
echo $user1->sayHello();

echo '<br>';

$user1 = new User('Sara', 25);
echo $user1->name . ' is ' . $user1->age . ' years old.';
echo '<br>';
echo $user1->sayHello();