<?php

namespace App\Services;

use App\Database;

class ForgotPasswordService
{
    private Database $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function execute(ForgotPasswordRequest $request): Database
    {
        $this->connection->update(
            'users',
            [
                'password' => $request->getPassword(),
            ],
            [
                'email' => $request->getEmail()
            ]
        );
        return $this->connection;
    }
}