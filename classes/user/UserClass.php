<?php

namespace user;

include_once __DIR__ . "\..\DataBase.php";

use Database;
use PDO;

class User
{
    public $id;
    public $username;
    public $user_age;
    public $user_email;
    public $user_pwd;
    public $user_img;
    public $result; // Résultat du stockage des informations du formulaire

    public function __construct($username, $user_age, $user_email, $user_pwd, $user_img)
    {
        $this->username = $username;
        $this->user_age = $user_age;
        $this->user_email = $user_email;
        $this->user_pwd = $user_pwd;
        $this->user_img = $user_img;
    }
    public function set()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `user` (`username`, `user_age`, `user_email`, `user_pwd`, `user_img`)");

        $query->execute(array(":username" => $this->username, ":user_age" => $this->user_age, ":user_email" => $this->user_email, ":user_pwd" => $this->user_pwd, ":user_img" => $this->user_img));
    }

    public function __get($username)
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("SELECT * FROM `user` WHERE `username =  ?`");

        $query->execute(array(":username" => $this->username, ":user_age" => $this->user_age, ":user_email" => $this->user_email, ":user_pwd" => $this->user_pwd, ":user_img" => $this->user_img));
    }

    public function __update()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("UPDATE `username` AND `user_email` AND `user_img` FROM `user` WHERE `username =  ?`");

        $query->execute(array(":username" => $this->username, ":user_email" => $this->user_email, ":user_img" => $this->user_img));
    }

    public static function displayUserInfos()
    {
        $dbh = Database::createDBConnection();
        $id = 1;
        $query = $dbh->prepare("SELECT * FROM `user` WHERE `id` = 1");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $userInfo) {

            echo "<div class=\"user\">";
            echo "<div class=\"profilePicture\">";
            echo "<img src=\"\">
            </div>
            <div class=\"username\">
            <h2 class=\"hUsername\">";
            echo $userInfo['username'];
            echo "</h2>
            </div>
            <div class=\"userInfo\">
            <p>Nombre d'enchères :";
            echo $userInfo['nbr_bids'];
            echo "</p>
            <p>Nombre d'annonces :";
            echo $userInfo['nbr_object'];
            echo "</p>
            <p>E-mail :";
            echo $userInfo['user_email'];
            echo "</p>
              <p>Password :";
            echo $userInfo['user_img'];
            echo "</p>
            </div>
          </div>";
        }
    }
} ?>