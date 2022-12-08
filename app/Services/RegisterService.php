<?php

namespace App\Services;

use App\Database;
use Doctrine\DBAL\Connection;

class RegisterService
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function execute(RegisterServiceRequest $request): Connection
    {
        $this->connection->insert(
            'users',
            [
                'name' => $request->getName(),
                'surname' => $request->getSurname(),
                'email' => $request->getEmail(),
                'password' => $request->getPassword(),
                'passwordConfirmation' => $request->getPasswordConfirmation()
            ]
        );
        return $this->connection;
    }
}