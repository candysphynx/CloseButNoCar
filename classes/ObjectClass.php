<?php

// include_once __DIR__ . "/index.php";

class Object
{
    public $id;
    public $obj_model;
    public $obj_brand;
    public $obj_img;
    public $obj_year;
    public $obj_price;
    public $obj_descr;
    public $obj_date;

    public function __construct($obj_model, $obj_brand, $obj_img, $obj_year, $obj_price, $obj_descr, $obj_date)
    {
        $this->obj_model = $obj_model;
        $this->obj_brand = $obj_brand;
        $this->obj_img = $obj_img;
        $this->obj_year = $obj_year;
        $this->obj_price = $obj_price;
        $this->obj_descr = $obj_descr;
        $this->obj_date = $obj_date;
    }
    public function setPDO()
    {
        $dbh = new PDO("mysql:dbname=cbnc;host=127.0.0.1;port=8889", "root", "root");

        $query = $dbh->prepare("INSERT INTO `obj_model` (`obj_brand`, `obj_img`, `obj_year`, `obj_price` , `obj_descr`, `obj_date`)");

        $query->execute(array(":obj_model" => $this->obj_model, ":obj_brand" => $this->obj_brand, ":obj_img" => $this->obj_img, ":obj_year" => $this->obj_year, ":obj_price" => $this->obj_price, ":obj_descr" => $this->obj_descr, ":obj_date" => $this->obj_date));
    }
} ?>