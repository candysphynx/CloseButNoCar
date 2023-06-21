<?php

namespace auction;

include_once __DIR__ . "/../DataBase.php";
include_once __DIR__ . "/Auction.php";
use Database;
use PDO;
use bids\Bids as BidsBids;

class AuctionDetails extends Auction
{
    public $obj_year;
    public $obj_price;
    public $obj_descr;
    public $obj_date;
    public $last_user_auction;
    public $auction_price;

    public function __construct($obj_model, $obj_brand, $obj_img, $obj_year, $obj_price, $obj_descr, $obj_date)
    {
        parent::__construct($obj_model, $obj_brand, $obj_img);
        $this->obj_year = $obj_year;
        $this->obj_price = $obj_price;
        $this->obj_descr = $obj_descr;
        $this->obj_date = $obj_date;
    }
    public function setPDO()
    {
        $dbh = Database::createDBConnection();

        $query = $dbh->prepare("INSERT INTO `object` (`user_id`,`obj_model`, `obj_brand`, `obj_img`, `obj_year`, `obj_price` , `obj_descr`, `obj_date`) VALUES (?,?,?,?,?,?,?,?)");

        $query->execute([$_SESSION['user_id'], $this->obj_model, $this->obj_brand, $this->obj_img, $this->obj_year, $this->obj_price, $this->obj_descr, $this->obj_date,]);
    }

    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    public static function getAuctionDetails($id)
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT * FROM `object` WHERE `id`= ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $now = new \DateTime("now");
            $expiredAsTimestamp = strtotime($row['obj_date'] . ' + 7 days');
            $expired = date('Y-m-d', $expiredAsTimestamp);
            $nownow = $now->format('Ymd');
            $expired2 = date('Ymd', $expiredAsTimestamp);
            $ExpLast = intval($expired2) - intval($nownow);

            if ($now->format('Y-m-d') <= $expired) {
                ?>
                <div class="row">

                    <!-- Colonne de droite -->
                    <div class="col-12 detailspage mb-5">
                        <div class="row border-btm-linear d-flex details">
                            <div class="col ">
                                <img class="imgAuction"
                                    src=" <?php echo 'data:image/jpg;base64,' . base64_encode($row['obj_img']); ?>" />
                            </div>
                            <div class="col  detailsinfos">
                                <p><strong class="activeGradient"> MARQUE :</strong>
                                    <?php echo $row['obj_brand']; ?>
                                </p>
                                <p><strong class="activeGradient"> MODÈLE :</strong>
                                    <?php echo $row['obj_model']; ?>
                                </p>
                                <p><strong class="activeGradient"> ANNEE :</strong>
                                    <?php echo $row['obj_year']; ?>
                                </p>
                                <p><strong class="activeGradient"> PRIX :</strong>
                                    <?php echo $row['obj_price']; ?> €
                                </p>
                            </div>
                        </div>
                        <div class="row d-flex  description">
                            <p><strong class="activeGradient"> DESCRIPTION : </strong></p>
                            <p>
                                <?php echo $row['obj_descr']; ?>
                            </p>
                            <div class="card bg-dark">
                                <?php
                                $auction = $row['obj_price'] + $row['auction_price'];
                                if (isConnected()) {
                                    ?>
                                    <div class="row">
                                        <div class="card-body">
                                            <p class="activeGradient d-flex justify-content-center">Nous vous proposons d'enchérir sur ce sublime Véhicule! </p>
                                            <form action="../page/contributeauction.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                                                <input type="hidden" name="object_id" value="<?php echo $id; ?>" />
                                                <input type="hidden" name="auction_date" value="<?php echo date("Y-m-d"); ?>" />
                                                <input type="number" name="auction_price" minlength="2">
                                                <button type="submit" class="btn btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Valider</button>
                                            </form>
                                        </div>
                                        <div class="col colorWhite">
                                            <?php

                                            ?>
                                            <p> Aujourd'hui,
                                                <?php echo $row['last_user_auction']; ?> a enchéri. Dernière enchère :
                                                <?php echo $row['auction_price']; ?> €
                                            </p>
                                            <p>Le montant Total de l'enchère est de
                                                <?php echo $auction; ?> €.
                                            </p>
                                            <p>Temps restant avant la fermeture de l'enchère : </p>
                                            <div class="progress" role="progressbar" aria-label="Animated striped"
                                                aria-valuenow="<?php echo $ExpLast; ?>" aria-valuemin="0" aria-valuemax="7">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                    style="width: <?php echo (((int) $ExpLast) * 100 / 7); ?>%"><?php echo $ExpLast; ?> / 7
                                                    jours</div>
                                            </div>


                                            <div>
                                            </div>
                                            <?php
                                }
                                ;
                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
            }
        }
    }
    public static function getAuctionSimple()
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT `id`,`obj_model`,`obj_date`,`obj_brand`,`obj_img`,`obj_year`,`obj_price` FROM `object` ");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $now = new \DateTime("now");
            $expiredAsTimestamp = strtotime($row['obj_date'] . ' + 7 days');
            $expired = date('Y-m-d', $expiredAsTimestamp);
            $nownow = $now->format('Ymd');
            $expired2 = date('Ymd', $expiredAsTimestamp);
            $ExpLast = intval($expired2) - intval($nownow);
            if ($now->format('Y-m-d') <= $expired) { ?>
                        <div class="card m-3 colorWhite bg-dark border-linear shadow-lg" style="width: 16rem;">
                            <img src="<?php echo 'data:image/png;base64,' . base64_encode($row['obj_img']); ?>"
                                class=" imgcard card-img-top " alt="...">
                            <div class="card-body d-flex flex-column align-items-center">
                                <h5 class="card-title">
                                    <?php echo $row['obj_brand']; ?>
                                    <?php echo $row['obj_model']; ?>
                                </h5>
                                <p class="card-text">Année:
                                    <?php echo $row['obj_year']; ?>
                                </p>
                                <p class="card-text">Expire dans
                                    <?php echo $ExpLast; ?> jours
                                </p>
                                <p class="card-text">Prix de
                                    <?php echo $row['obj_price']; ?> €
                                </p>
                                <a href="auctiondetails.php?auctionid=<?php echo $row['id']; ?>"
                                    class="btn btn-outline-primary">Détails</a>
                            </div>
                        </div>
                    <?php }
        }
    }
    public static function getAuctionExpired()
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT `id`,`obj_model`,`obj_date`,`obj_brand`,`obj_img`,`obj_year`,`obj_price` FROM `object` ");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $now = new \DateTime("now");
            $expiredAsTimestamp = strtotime($row['obj_date'] . ' + 7 days');
            $expired = date('Y-m-d', $expiredAsTimestamp);
            if ($now->format('Y-m-d') >= $expired) { ?>
                        <div class="card m-3 colorWhite bg-dark h-60 border-linear shadow-lg" style="width: 16rem;">
                            <img src="<?php echo 'data:image/png;base64,' . base64_encode($row['obj_img']); ?>"
                                class=" imgcard card-img-top " alt="...">
                            <div class="card-body d-flex flex-column align-items-center">
                                <h5 class="card-title">
                                    <?php echo $row['obj_brand']; ?>
                                    <?php echo $row['obj_model']; ?>
                                </h5>
                                <p class="card-text">Année:
                                    <?php echo $row['obj_year']; ?>
                                </p>
                                <a class="btn btn-outline-primary" disabled>TROP TARD!</a>
                                <p class="card-text">Expiré le:
                                    <?php echo $expired; ?>
                                </p>
                            </div>
                        </div>
                    <?php }
        }
    }
    public static function getAuctionUser($id)
    {
        $dbh = Database::createDBConnection();
        $query = $dbh->prepare("SELECT * FROM `object` WHERE `user_id`= ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            ?>
                    <div class="card m-3 colorWhite bg-dark border-linear details " style="width: 10rem; height:300px ">
                        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($row['obj_img']); ?>"
                            class="card-img-top imgcard2" alt="...">
                        <div class="card-body d-flex flex-column align-items-center ">
                            <p class="card-text">
                                <?php echo $row['obj_brand']; ?>
                            </p>
                            <p class="card-text">
                                <?php echo $row['obj_model']; ?>
                            </p>
                            <a href="auctiondetails.php?auctionid=<?php echo $row['id']; ?>"
                                class="btn btn-outline-primary">Détails</a>
                                <a href="" class="btn btn-outline-danger">Supprimer</a>
                        </div>
                    </div>
                    <?php
        }
    }

}