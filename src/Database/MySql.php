<?php

namespace App\Database;

require __DIR__ . '/../../config/parameters.php';

class MySql{
    public static function connect(): \PDO
    {
        try
        {
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASSWORD');
            $dbName = getenv('DB_NAME');
            $dbHost = getenv('DB_HOST');
            $connexion = new \PDO ("mysql:host=$dbHost;dbname=$dbName;charset=UTF8", $user, $pass);
        }
        catch(\Exception $exception)
        {
            echo "Erreur lors de la connexion à la base de données. : " . $exception->getMessage();
            exit;
        }
        return $connexion;
    }
}