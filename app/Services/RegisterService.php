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

    public function checkIfEmailExists(string $email): bool
    {
        $emailExists = $this->connection->fetchAllKeyValue(
            'SELECT * FROM users WHERE email = :email',
            [
                'email' => $email
            ]
        );
        if (in_array($email, $emailExists)) {
            return true;
        }
        return false;
    }

    public function execute(RegisterServiceRequest $request): Connection
    {
        $this->connection->executeQuery(
            'INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)',
            [
                'name' => $request->getName(),
                'surname' => $request->getSurname(),
                'email' => $request->getEmail(),
                'password' => $request->getPassword()
            ]
        );
        return $this->connection;
    }
}