<?php

// include_once __DIR__ . "/index.php";

class Auction
{
    public $id;
    public $auction_date;
    public $auction_price;

    public function __construct($auction_date, $auction_price)
    {
        $this->auction_date = $auction_date;
        $this->auction_price = $auction_price;
    }
} ?>