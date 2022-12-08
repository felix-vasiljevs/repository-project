<?php

namespace App\Controllers;

use App\Services\LoginService;
use App\Services\LoginServiceRequest;
use App\Template;
use App\Redirect;

class LoginController
{
    public function showForm(): Template
    {
        return new Template('/login.twig');
    }

    public function login(): Redirect
    {
        $loginService = new LoginService();
        $user = $loginService->execute(
            new LoginServiceRequest(
                $_POST['email'],
                $_POST['password']
            )
        );

        if (!$_POST['email'] || !$_POST['password']) {
            return new Redirect('/login.twig');
        }

        if(!$_POST['password'] == $user['password']) {
            return new Redirect('/login.twig');
        }

//        if ($user) {
//            $_SESSION['user'] = $user;
//            return new Redirect('/crypto');
//        }

        if (!isset($_SESSION['user'])) {
            return new Redirect('login.twig');
        }

        return new Redirect('/');
    }
}
/*
 *         $loginService = new LoginService();
        $loginService->execute(
            new LoginServiceRequest(
                $_POST['email'],
                $_POST['password']
            )
        );

        if (!$_POST['email'] || !$_POST['password']) {
            return new Redirect('login.twig');
        }

        return new Redirect('/');
    }
 *
 *
 */