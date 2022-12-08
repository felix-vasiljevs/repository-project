<?php

namespace App\Services;

class RegisterServiceRequest
{
    private string $name;
    private string $surname;
    private string $email;
    private string $password;
    private string $passwordConfirmation;

    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $password,
        string $passwordConfirmation
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }
}