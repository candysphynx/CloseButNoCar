<?php

// include_once __DIR__ . "/index.php";

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
    public function setPDO()
    {
        $dbh = new PDO("mysql:dbname=cbnc;host=127.0.0.1;port=8889", "root", "root");

        $query = $dbh->prepare("INSERT INTO `user` (`username`, `user_age`, `user_pwd`, `user_img`)");

        $query->execute(array(":username" => $this->username, ":user_age" => $this->user_age, ":user_email" => $this->user_email, ":user_pwd" => $this->user_pwd, ":user_img" => $this->user_img));
    }

    public function displayUserInfos()
    {
        echo "<div class=\"DisplayUserInfo\">";

        echo "<h2>Votre Pièce :</h2>";

        echo "<p> <u>Titre :</u> " . $this->piece . "</p>";

        echo "<p> <u>Place :</u> " . $this->place . "</p>";

        echo "<p> <u>Horaire de Début :</u> " . $this->horaire . "</p>";

        echo "<p> <u>Horaire de l'Entracte :</u> " . $this->entracte() . "</p>";

        echo "<p><u>ID :</u> " . $this->idTicket . "</p>";

        echo "</div>";
    }
} ?>