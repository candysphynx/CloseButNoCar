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
 

    public function __construct($user_id,$object_id,$auction_date,$auction_price){
        $this->user_id = $user_id;
        $this->object_id = $object_id;
        $this->auction_date = $auction_date;
        $this->auction_price = $auction_price;
        $this->past_bids_id = $past_bids_id;
    }

    public function setBids()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `bids` (`user_id`, `object_id`, `auction_date`, `auction_price`) VALUES (?,?,?,?)");

        $query->execute([$this->user_id, $this->object_id, $this->auction_date, $this->auction_price]);
    }
    
    public static function displayPrice ($id)
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("SELECT SUM(bids.auction_price)AS BidsTotal, object.obj_model, object.obj_price FROM `bids` LEFT JOIN `object` ON bids.object_id = object.id WHERE object_id=?;");

        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $totalBids) {
            if($totalBids['BidsTotal'] != "" ){ ?> 
                <p> Pour ce modèle <?php echo $totalBids['obj_model']; ?>, le montant  des Enchères est de  <?php echo $totalBids['BidsTotal']; ?> €, le prix Total de la voiture est de <?php echo ($totalBids['BidsTotal'] + $totalBids['obj_price'] ); ?> €  </p> 
                <?php }
            else { ?>
             <p> Pas encore d'enchère! Profitez-en vite! 🤘 </p> 
             <?php }}                
    }
    public static function displayLastAuctionInfo ($id)
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("SELECT b.user_id, u.username, b.auction_price, b.auction_date, MAX(b.id) AS latestBids FROM `bids` b, `user` u WHERE b.object_id = ? AND b.user_id = u.id;");

        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $LastBids) {
            if($LastBids['username'] != "" ){ ?> 
                <p> Le <?php echo $LastBids['auction_date']; ?>,   <?php echo $LastBids['username']; ?> à enchéri de <?php echo $LastBids['auction_price']; ?> €  </p> 
                <?php }
            else { }}                
    }
}