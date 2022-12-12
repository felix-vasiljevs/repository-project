<?php

namespace App\ViewVariables;

use App\Database;

class AuthViewVariables implements ViewVariable
{
    public function getName(): string
    {
        return 'user';
    }

    public function getValue(): array
    {
        if (!isset($_SESSION['user'])) {
            return [];
        }

        $queryBuilder = Database::getConnection()->createQueryBuilder();

        $user = $queryBuilder
            ->select('*')
            ->from('users')
            ->where('id = :id')
            ->setParameter('id', $_SESSION['auth'])
            ->fetchAssociative();

        return [
            'name' => $user['name'],
            'surname' => $user['surname'],
            'email' => $user['email'],
            'password' => $user['password']
        ];
    }
}