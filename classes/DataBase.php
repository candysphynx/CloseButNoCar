<?php


abstract class Database
{
    const ADDRESS = "mysql:dbname=cbnc;host:localhost";
    const USER = "root";
    const PASSWORD = "root";

    /**
     * Création d'un connexion à la base de données
     */
    public static function createDBConnection()
    {
        return new PDO(self::ADDRESS, self::USER, self::PASSWORD);
    }
}