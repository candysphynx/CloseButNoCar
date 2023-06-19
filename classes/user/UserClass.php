<?php

namespace user;

include_once __DIR__ . "/../DataBase.php";

use Database;

use PDO;

class User //extends UserLogIn 
{

    public $id;

    public $username;

    public $user_age;

    public $user_email;
    public $user_pdw;
    public $user_img;

    public $result; // Résultat du stockage des informations du formulaire

    public function __construct($username, $user_age, $user_email, $user_pdw, $user_img)
    {

        $this->username = $username;
        $this->user_age = $user_age;
        $this->user_email = $user_email;
        $this->user_pdw = $user_pdw;
        $this->user_img = $user_img;

    }

    public function set()
    {

        $dbh = Database::createDBConnection();
        $pdw = sha1($this->user_pdw);

        $query = $dbh->prepare("INSERT INTO `user` (`username`, `user_age`, `user_email`, `user_pdw`, `user_img`) VALUES (?,?,?,?,?)");

        $query->execute([$this->username, $this->user_age, $this->user_email, $pdw, $this->user_img,]);
    }


    public function __update($id)
    {

        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("UPDATE `user` SET `username` = ?,`user_age` = ?, `user_email` = ?, `user_pdw` = ?, `user_img` = ? WHERE `user`.`id` = $id");

        $query->execute([$this->username, $this->user_age, $this->user_email, $this->user_pdw, $this->user_img,]);
    }

    public function LoggedUser()
    {

        $dbh = Database::createDBConnection();

        $pdw = sha1($this->user_pdw);

        $query = $dbh->prepare("SELECT `id` FROM `user` WHERE `user_email` = ? AND `user_pdw` = '$pdw' ");

        $query->execute([$this->user_email ]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $userlogin) {

            createUserSession($userlogin['id']);
        }
    }

    public static function displayUserInfos($id)
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT * FROM `user` WHERE `id` = ?");

        $query->execute([$id]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $userInfo) { ?>

            <div class=user>
                <div>
                    <img class="profilePicture"
                        src=" <?php echo 'data:image/jpg;base64,' . base64_encode($userInfo['user_img']) ?>" />
                </div>
                <div class=username>
                    <h2 class=hUsername><?php echo $userInfo['username']; ?></h2>
                </div>
                <div class="userInfo">
                    <p>E-mail :
                        <?php echo $userInfo['user_email']; ?>
                    </p>
                    <p>Age :
                        <?php echo $userInfo['user_age']; ?>
                    </p>
                    <p>Mot de passe : <input class="noBack" type="password" value="Encrypted..." disabled />
                    </p>
                    <p>Nombre d'enchères :
                        <?php echo $userInfo['nbr_bids']; ?>
                    </p>
                    <p>Nombre d'annonces :
                        <?php echo $userInfo['nbr_object']; ?>
                    </p>

                </div>
            </div>
            <?php
        }

    }

} ?>