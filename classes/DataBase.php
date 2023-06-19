<?php

/* Pour Mac: const ADDRESS = "mysql:dbname=cbnc;host=127.0.0.1;port=8889"*/

/* Pour Windows: const ADDRESS = "mysql:dbname=cbnc;host:localhost"; */
abstract class Database
{
    const ADDRESS = "mysql:dbname=cbnc;host=127.0.0.1;port=8889";
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