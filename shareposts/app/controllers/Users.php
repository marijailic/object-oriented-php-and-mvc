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
                    flash('register_success', 'You are registered and can log in');
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

            if($this->userModel->findUserByEmail($data['email'])){

            } else {
                $data['email_err'] = 'No user found';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            }

            if(
                empty($data['email_err']) &&
                empty($data['password_err'])
            ){
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
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

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

}