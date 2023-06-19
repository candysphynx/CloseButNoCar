<?php

namespace bids;
include_once __DIR__."/../DataBase.php";
use Database;

class Bids {
    public $id;
    public $user_id;
    public $object_id;
    public $auction_date;
    public $auction_price;
    public $past_bids_id;

    public function __construct($id,$user_id,$object_id,$auction_date,$auction_price,$past_bids_id){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->object_id =$object_id;
        $this->auction_date= $auction_date;
        $this->auction_price=$auction_price;
        $this->past_bids_id=$past_bids_id;
    }

    public function setBids()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `object` (`user_id`, `object_id`, `auction_date`, `auction_price` , `past_bids_id`) VALUES (?,?,?,?,?)");

        $query->execute([$this->user_id, $this->object_id, $this->auction_date, $this->auction_price, $this->past_bids_id,]);
    }

}