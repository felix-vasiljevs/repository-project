<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;

class RegisterController
{
    public function showForm(): Template
    {
        return new Template('/register.twig');
    }

    public function registerUser(): Redirect
    {
        if (!$_POST['name'] || !$_POST['surname'] || !$_POST['email'] || !$_POST['password'] || !$_POST['passwordConfirmation']) {
            return new Redirect('/register.twig');
        }

        if ($_POST['password'] != $_POST['passwordConfirmation']) {
            return new Redirect('/register.twig');
        }

        $registerService = new RegisterService();
        $registerService->execute(
            new RegisterServiceRequest(
                $_POST['name'],
                $_POST['surname'],
                $_POST['email'],
                $_POST['password'],
                $_POST['passwordConfirmation']
            )
        );
        return new Redirect('/');
    }
}