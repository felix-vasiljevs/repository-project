<?php

namespace App\ViewVariables;

class ErrorsViewVariable implements ViewVariable
{
    private array $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function getName(): string
    {
        return 'errors';
    }

    public function getValue(): array
    {
        return $_SESSION['errors'] ?? [];
    }
}
