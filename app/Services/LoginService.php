<?php

namespace App\Services;

use App\Database;
use Doctrine\DBAL\Connection;

class LoginService
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function execute(LoginServiceRequest $request): Connection
    {
        $result = $this->connection->executeQuery(
            'SELECT * FROM users WHERE email = :email AND password = :password',
            [
                'email' => $request->getEmail(),
                'password' => $request->getPassword()
            ]
        );
        return $this->connection;
    }
}