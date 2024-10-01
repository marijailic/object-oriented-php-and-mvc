<?php

class User{
    public $name;
    public $age;
    public static $minPassLength = 6;

    public static function validatePass($pass){
        return (strlen($pass) >= self::$minPassLength);
    }
}

$password = 'hello!';
if (User::validatePass($password)) {
    echo 'Password valid';
} else {
    echo 'Password NOT valid';
}