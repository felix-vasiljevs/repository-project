<?php

namespace App\Controllers;

use App\Services\ForgotPasswordRequest;
use App\Services\ForgotPasswordService;
use App\Template;

class ForgotPasswordController
{
    public function showForm(): Template
    {
        return new Template('forgot-password');
    }

    public function changePassword(): Template
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $forgotPasswordService = new ForgotPasswordService();
        $forgotPasswordService->execute(
            new ForgotPasswordRequest($email, $password)
        );

        return new Template('login');
    }
}