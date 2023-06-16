<?php

namespace auction;
class AuctionSimple extends Auction
{
    public $obj_price;

    

    public function __construct($obj_model,$obj_brand,$obj_img,$obj_price)
    {parent::__construct($obj_model,$obj_brand,$obj_img);
        $this->obj_price = $obj_price;

    }
    public function get_auction() {
        
    }

} ?>