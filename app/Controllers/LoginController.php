<?php

namespace App\Controllers;

use App\Services\LoginService;
use App\Services\LoginServiceRequest;
use App\Template;
use App\Redirect;
use App\Validation;

class LoginController
{
    public function showForm(): Template
    {
        return new Template('/login.twig');
    }

    public function login(): Redirect
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $validation = new Validation();
        $id = $validation->validateEmail($email);
        if (!$id) {
            $_SESSION['error'] = 'Email is not valid';
            return new Redirect('/login');
        }

        $_SESSION['user']['email'] = $email;
        if (!$validation->validatePassword($password)) {
            $_SESSION['error'] = 'Password is not valid';
            return new Redirect('/login');
        }




        return new Redirect('/');
    }

}