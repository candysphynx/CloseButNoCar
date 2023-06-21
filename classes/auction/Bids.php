<?php

namespace bids;

include_once __DIR__ . "/../DataBase.php";
include_once __DIR__ . "/../classes/user/UserClass.php";

use Database;
use PDO;

class Bids
{
    public $id;
    public $user_id;
    public $object_id;
    public $auction_date;
    public $auction_price;
    public $past_bids_id;

    public function __construct($id, $user_id, $object_id, $auction_date, $auction_price, $past_bids_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->object_id = $object_id;
        $this->auction_date = $auction_date;
        $this->auction_price = $auction_price;
        $this->past_bids_id = $past_bids_id;
    }

    public function setBids()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `object` (`user_id`, `object_id`, `auction_date`, `auction_price`) VALUES (?,?,?,?)");

        $query->execute([$this->user_id, $this->object_id, $this->auction_date, $this->auction_price, $this->past_bids_id,]);
    }

























    public static function displayContribution($id)
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT * FROM `bids`
        LEFT JOIN `user` ON bids.user_id = user.id WHERE `user_id` = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $userContrib) { ?>

            <div class=user>
                <div>
                    <img class="profilePicture"
                        src=" <?php echo 'data:image/jpg;base64,' . base64_encode($userContrib['user_img']) ?>" />
                </div>
                <div class=username>
                    <h2 class=hUsername><?php echo $userContrib['username']; ?></h2>
                </div>
                <div class="userInfo">
                    <p>Montant de la dernière enchère :
                        <?php echo $userContrib['auction_price']; ?>
                    </p>

                    <p>Dernière enchère sur :
                        <?php echo $userContrib['obj_model']; ?>
                    </p>
                    <p>Date de la dernière enchère:
                        <?php echo $userContrib['auction_date']; ?>
                    </p>
                </div>
            </div>
            <?php
        }
    }


}