<?php

namespace App;

class Validation
{
    public function failed(): bool
    {
        return count($_SESSION['errors']) > 0;
//        return !$_POST['name'] || !$_POST['surname'] || !$_POST['email'] || !$_POST['password'] || !$_POST['passwordConfirmation'];
    }

    public function validate(array $post): Validation
    {
        $_SESSION['errors'] = [];
        if (!$post['name']) {
            $_SESSION['errors'][] = 'Name is required';
        }
        if (!$post['surname']) {
            $_SESSION['errors'][] = 'Surname is required';
        }
        if (!$post['email']) {
            $_SESSION['errors'][] = 'Email is required';
        }
        if (!$post['password']) {
            $_SESSION['errors'][] = 'Password is required';
        }
        if (!$post['passwordConfirmation']) {
            $_SESSION['errors'][] = 'Password confirmation is required';
        }
        if ($post['password'] != $post['passwordConfirmation']) {
            $_SESSION['errors'][] = 'Passwords do not match';
        }
        return $this;
    }






/*
    public function failed(): bool
    {
        return count($_SESSION['errors']) > 0;
    }

    public function validate(array $post): Validation
    {
        $this->validatePassword($post['password']);
        $this->validateEmail($post['email']);

        if (strlen($post['name']) < 5) {
            $_SESSION['errors']['name'] = 'Password must be at least 5 symbols.';
        }

        return $this;
    }
    */
}