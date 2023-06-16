<?php

namespace auction;
include_once __DIR__."\..\DataBase.php";
include_once __DIR__."\Auction.php";
use Database;
use PDO;

class AuctionDetails extends Auction {
    public $obj_year;
    public $obj_price;
    public $obj_descr;
    public $obj_date;

    public function __construct($obj_model, $obj_brand, $obj_img, $obj_year, $obj_price, $obj_descr, $obj_date)
    {parent::__construct($obj_model,$obj_brand,$obj_img);
        $this->obj_year = $obj_year;
        $this->obj_price = $obj_price;
        $this->obj_descr = $obj_descr;
        $this->obj_date = $obj_date;
    }
    public function setPDO()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `obj_model` (`obj_brand`, `obj_img`, `obj_year`, `obj_price` , `obj_descr`, `obj_date`)");

        $query->execute(array(":obj_model" => $this->obj_model, ":obj_brand" => $this->obj_brand, ":obj_img" => $this->obj_img, ":obj_year" => $this->obj_year, ":obj_price" => $this->obj_price, ":obj_descr" => $this->obj_descr, ":obj_date" => $this->obj_date));
    }

    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    public static function getAuctionDetails()
    {
        $dbh = Database::createDBConnection();
        $id=1;
        $query = $dbh->prepare("SELECT * FROM `object` WHERE `id`= ?");
        $query-> execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            ?>
            <div class="row">
        <!-- Colonne de gauche -->
        <div class="col-2 border mb-5">
        </div>
        <!-- Colonne de droite -->
        <div class="col-10 border detailspage mb-5">
          <div class="row d-flex details">
            <div class="col"><?php
           
            echo $row['obj_img'];
             ?>
            </div>
            <div class="col border detailsinfos">
              <p>MARQUE : <?php echo $row['obj_brand'];?></p>
              <p>MODÈLE : <?php echo $row['obj_model'];?></p>
              <p>ANNEE : <?php echo $row['obj_year'];?></p>
              <p>PRIX : <?php echo $row['obj_price'];?> €</p>
              <p>ENCHÈRE EN COURS :</p>
            </div>
          </div>
          <div class="row d-flex border description">
            <p>DESCRIPTION :</p>
            <p><?php echo $row['obj_descr'];?></p>
          </div>
        </div>
      </div>
            <?php
    }
        }}