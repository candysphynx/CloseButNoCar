<?php

namespace auction;

class Auction {
    public $id;
    public $obj_model;
    public $obj_brand;
    public $obj_img;

    public function __construct($obj_model,$obj_brand,$obj_img){
        
        $this->obj_model = $obj_model;
        $this->obj_brand = $obj_brand;
        $this->obj_img = $obj_img;
    }


}