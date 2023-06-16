<?php


abstract class Database
{
/*MAC : "mysql:dbname=cbnc;host=127.0.0.1;port=8889", "root", "root"*/
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
