<?php

namespace auction;

class Auction
{
    protected $id;
    protected $obj_model;
    protected $obj_brand;
    protected $obj_img;

    public function __construct($obj_model, $obj_brand, $obj_img)
    {

        $this->obj_model = $obj_model;
        $this->obj_brand = $obj_brand;
        $this->obj_img = $obj_img;
    }
    public function setId()
    {
        $this->id;
    }
    public function getId()
    {
        return
            $this->id;
    }

    public function setObj_model()
    {
        $this->obj_model;
    }
    public function getObj_model()
    {
        return
            $this->obj_model;
    }

    public function setObj_brand()
    {
        $this->obj_brand;
    }
    public function getObj_brand()
    {
        return
            $this->obj_brand;
    }

    public function setObj_img()
    {
        $this->obj_img;
    }
    public function getObj_img()
    {
        return
            $this->obj_img;
    }

}