<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;
use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;

class RegisterController
{
    private Database $connection;

    public function showForm(): Template
    {
        return new Template('/register.twig');
    }

    public function registerUser(): Redirect
    {
        $registerService = new RegisterService();
        $registerService->execute(
            new RegisterServiceRequest(
                $_POST['name'],
                $_POST['surname'],
                $_POST['email'],
                $_POST['password'],
            )
        );

        $sql = "SELECT * FROM users WHERE email =: email AND password =: password";
        $result = mysqli_query($this->connection, $sql);

        return new Redirect('/');
    }
}