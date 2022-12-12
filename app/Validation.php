<?php

namespace App;

class Validation
{
    public function failed(): bool
    {
        return count($_SESSION['errors']) > 0;
    }

    public function validate(array $post): Validation
    {
        $_SESSION['errors'] = [];
        if (!$post['name']) {
            $_SESSION['errors'][] = 'Name is required.';
        }
        if (!$post['surname']) {
            $_SESSION['errors'][] = 'Surname is required.';
        }
        return $this;
    }

    public function validateEmail(array $post): Validation
    {
        $_SESSION['errors'] = [];
        if (!$post['email']) {
            $_SESSION['errors'][] = 'Email is required.';
        }
        return $this;
    }

    public function validatePassword(array $post): Validation
    {
        $_SESSION['errors'] = [];
        if (strlen($post['password']) > 5) {
            $_SESSION['errors'][] = 'Password must be at least 5 symbols.';
        }
        if (!$post['password']) {
            $_SESSION['errors'][] = 'Password is required.';
        }
        return $this;
    }

    public function validatePasswordConfirmation(array $post): Validation
    {
        $_SESSION['errors'] = [];
        if (!$post['passwordConfirmation']) {
            $_SESSION['errors'][] = 'Password confirmation is required.';
        }
        if ($post['password'] != $post['passwordConfirmation']) {
            $_SESSION['errors'][] = 'Passwords do not match!';
        }
        return $this;
    }
}