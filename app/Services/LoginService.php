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
        $this->connection->insert(
            'users',
            [
                'email' => $request->getEmail(),
                'password' => $request->getPassword()
            ]
        );
        return $this->connection;
    }
}