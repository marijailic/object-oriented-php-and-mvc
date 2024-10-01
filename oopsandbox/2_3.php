<?php

class User{
    public $name;

    public function sayHello(){
        return $this->name . ' Says Hello ';
    }
}

$user1 = new User();
$user1->name = 'John';
echo $user1->name;
echo '<br>';
echo $user1->sayHello();

echo '<br>';

$user2 = new User();
$user2->name = 'Jane';
echo $user2->name;
echo '<br>';
echo $user2->sayHello();
