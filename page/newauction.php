<?php

use auction\AuctionDetails;

session_start();
include_once __DIR__ . "/../auth/sessions_management.php";
include_once __DIR__ . "/../classes/auction/AuctionDetailsClass.php";
if (isConnected() == False) {
  header('Location: authentication.php');
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if ($_POST["marque"] == "" || $_POST["modele"] == "" || $_POST["annee"] == "" || $_POST["prix"] == "" || $_POST["description"] == "") {
    ?>
    <div class="flex align column">
      <p>Merci de remplir tout les champs....</p>
    </div>
    <?php
  } else {

    $auction = new AuctionDetails(
      $_POST["modele"],
      $_POST["marque"],
      file_get_contents($_FILES['image']['tmp_name']),
      $_POST["annee"],
      $_POST["prix"],
      $_POST["description"],
      $_POST["date"],
    );

    $auction->setPDO();

  }
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="/public/favico.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Close But No Car</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#btnClick").click(function () {
        $("#createauction").css("display", "flex");
        $("#btnClick").css("display", "none");
        $("#btnClick2").css("display", "flex");
        $("#ourauction").css("display", "none");
      })
      $("#btnClick2").click(function () {
        $("#createauction").css("display", "none");
        $("#btnClick").css("display", "flex");
        $("#btnClick2").css("display", "none");
        $("#ourauction").css("display", "flex");
      })
    });

  </script>

</head>

<div class="container-fluid bkgBrown">
  <!-- Menu -->
  <div class="row sticky-top">
    <?php
    include __DIR__ . "/../layout/displaymenu.php";
    ?>
  </div>


  <!-- Body de l'index -->
  <div class="row align-content-center">
    <div class="col">
      <div class="row placeholder-lg"></div>
      <div class="d-flex gap-2 justify-content-center">
        <button type="button" id="btnClick" class="btn btn-success">Creer une enchère</button>
        <button type="button" id="btnClick2" class="btn btn-success">Vos Annonces</button>
      </div>
      <div class="row placeholder-lg"></div>
      <div id="createauction" class="bkgImg row justify-content-center  ">
        <div class="row pt-5 bg-dark mb-3 h-80 border-linear" style="max-width: 58rem;">
          <div class="row ">
            <p class="d-flex colorWhite raleway400 fs40 justify-content-center">Creer une enchère</p>
          </div>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row ">
              <!-- colone de Gauche-->
              <div class="col-6">
                <div class="mb-3">
                  <label for="marque" class="form-label colorWhite">Marque</label>
                  <input type="text" class="form-control" id="marque" name="marque">
                </div>
                <div class="mb-3">
                  <label for="modele" class="form-label colorWhite">Modèle</label>
                  <input type="text" class="form-control" id="modele" name="modele">
                </div>
                <div class="mb-3">
                  <label for="annee" class="form-label colorWhite">Année</label>
                  <input type="text" class="form-control" id="annee" name="annee">
                </div>
              </div>
              <!-- colone de Droite-->
              <div class="col-6">
                <div class="mb-3">
                  <label for="prix" class="form-label colorWhite">Prix</label>
                  <input type="text" class="form-control" id="prix" name="prix">
                </div>
                <div class="mb-3">
                  <input type="hidden" class="form-control" id="date" name="date"
                    value="<?php echo date("Y-m-d H:i:s") ?>">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label colorWhite">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="1"></textarea>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input class="form-control" type="file" accept=".jpg" id="image" name="image">
                </div>
              </div>
            </div>
            <div class="row justify-content-center ">
              <div class="col-auto">
                <button type="submit" class="btnValidAuct btn-primary mb-3">Valider</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="ourauction" class="bkgImg row justify-content-center  ">
        <div class="row pt-5 bg-dark mb-3 git  border-linear " style="max-width: 60rem;">
          <div class="row ">
            <p class="d-flex colorWhite raleway400 fs40 justify-content-center">
              <?php echo $_SESSION['username']; ?>, voici vos Annonces :
            </p>
          </div>
          <div class="row d-flex justify-content-center">
            <?php
            AuctionDetails::getAuctionUser($_SESSION['user_id']);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <footer class="fixed-bottom bg-dark d-flex justify-content-center colorWhite">
    <p>Copyright CBNC</p>
  </footer>
  </body>

</html>