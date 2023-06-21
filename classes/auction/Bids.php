<?php

namespace bids;

include_once __DIR__ . "/../DataBase.php";
use Database;
use PDO;

class Bids
{
    public $id;
    public $user_id;
    public $object_id;
    public $auction_date;
    public $auction_price;


    public function __construct($user_id, $object_id, $auction_date, $auction_price)
    {
        $this->user_id = $user_id;
        $this->object_id = $object_id;
        $this->auction_date = $auction_date;
        $this->auction_price = $auction_price;
    }

    public function setBids()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `bids` (`user_id`, `object_id`, `auction_date`, `auction_price`) VALUES (?,?,?,?)");

        $query->execute([$this->user_id, $this->object_id, $this->auction_date, $this->auction_price]);
    }

    public static function displayPrice($id)
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("SELECT SUM(bids.auction_price)AS BidsTotal, object.obj_model, object.obj_price FROM `bids` LEFT JOIN `object` ON bids.object_id = object.id WHERE object_id=?;");

        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $totalBids) {
            if ($totalBids['BidsTotal'] != "") { ?>
                <p> Pour ce modèle
                    <?php echo $totalBids['obj_model']; ?>, le montant des Enchères est de
                    <?php echo $totalBids['BidsTotal']; ?> €, le prix Total de la voiture est de
                    <?php echo ($totalBids['BidsTotal'] + $totalBids['obj_price']); ?> €
                </p>
            <?php } else { ?>
                <p> Pas encore d'enchère! Profitez-en vite! 🤘 </p>
            <?php }
        }
    }
    public static function displayLastAuctionInfo($id)
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("SELECT b.user_id, u.username, b.auction_price, b.auction_date, MAX(b.id) AS latestBids FROM `bids` b, `user` u WHERE b.object_id = ? AND b.user_id = u.id;");

        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $LastBids) {
            if ($LastBids['username'] != "") { ?>
                <p> Le
                    <?php echo $LastBids['auction_date']; ?>,
                    <?php echo $LastBids['username']; ?> à enchéri de
                    <?php echo $LastBids['auction_price']; ?> €
                </p>
            <?php } else {
            }
        }
    }
    public static function displayContribution($id)
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT b.user_id, u.username, u.user_img, b.auction_price, b.auction_date, o.id, o.obj_brand, o.obj_model FROM `bids` b, `user` u, `object` o WHERE b.user_id = ? AND b.user_id = u.id AND o.id = b.object_id;;");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $userContrib) { ?>


            <li class="colorWhite border-btm-linear">
                <span>Le : <strong class="colorYellow">
            <?php echo $userContrib['auction_date']; ?>
            </strong> </span>
        <span>vous avez enchéri sur : <strong class="colorYellow">
            <?php echo $userContrib['obj_brand']; ?>
            <?php echo $userContrib['obj_model']; ?>
            </strong>, </span>
        <span> votre enchère est de : <strong class="colorYellow">
            <?php echo $userContrib['auction_price']; ?>
            </strong> €</span>
        <span> <a href="./../page/auctiondetails.php?auctionid=<?php echo $userContrib['id']; ?>"
            class="myButton">Voir</a></span>
</li>
<?php
        }
    }
}