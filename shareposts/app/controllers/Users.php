<?php

class Users extends Controller{
    public function __construct(){

        $this->userModel = $this->model('User');

    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter your email address';
            } else {
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'This email is already taken';
                }
            }

            if(empty($data['name'])){
                $data['name_err'] = 'Please enter your name';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Your password must be at least 6 characters long';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Password did not match';
                }
            }

            if(
                empty($data['email_err']) &&
                empty($data['name_err']) &&
                empty($data['password_err']) &&
                empty($data['confirm_password_err'])
            ){
//                die('SUCCESS');
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)){
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/register', $data);
            }

        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter your email address';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }

            if(
                empty($data['email_err']) &&
                empty($data['password_err'])
            ){
                die('SUCCESS');
            } else {
                $this->view('users/login', $data);
            }


        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/login', $data);
        }
    }
}