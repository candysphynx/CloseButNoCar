<?php
session_start();
include_once __DIR__ . "/../auth/sessions_management.php";
include_once __DIR__ . "/../classes/user/UserClass.php";

use user\User as User;

if (isConnected()) {
  destroySession();
  header('Location: home.php');
  exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if ($_POST["user_age"] == "" || $_POST["user_email"] == "" || $_POST["user_pdw"] == "") {
    ?>
    <div class="flex align column colorWhite">
      <p>Merci de remplir tout les champs....</p>
    </div>
    <?php
  } else {
      $newUser = new User(
        $_POST["username"],
        $_POST["user_age"],
        $_POST["user_email"],
        $_POST["user_pdw"],
        file_get_contents($_FILES['image']['tmp_name'])
      );
      $newUser->set();
      header('Location: authentication.php');
      exit();

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

</head>

<body>
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
        <!-- Content Cards -->
        <div class="bkgImg row justify-content-center  ">
          <!-- Inscription form -->

          <div class="row sm-2 bg-dark mb-3 border-linear h-80" style="max-width: 58rem;">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3 row ">
                <p class="d-flex colorWhite raleway400 fs40 justify-content-center">Inscription</p>
              </div>
              <div class="mb-3 row ">
                <label for="staticEmail"
                  class="col-sm-2 col-form-label colorWhite raleway400 align-item-left">Email</label>
                <div class="col-sm-8">
                  <input type="email" name="user_email" class="form-control align-item-left" id="inputEmailRegister">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword"
                  class=" col-sm-2 col-form-label colorWhite raleway400 align-item-left">Password</label>
                <div class="col-sm-8">
                  <input type="password" name="user_pdw" class="form-control align-item-left"
                    id="inputPasswordRegister">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputUsername"
                  class="col-sm-2 col-form-label colorWhite raleway400 align-item-left">Username</label>
                <div class="col-sm-8">
                  <input type="text" name="username" class="form-control align-item-left" id="inputUsername">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputAge" class="col-sm-2 col-form-label colorWhite raleway400 align-item-left">Âge</label>
                <div class="col-sm-8">
                  <input type="form-control" name="user_age" class="form-control align-item-left" id="inputAge">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="image" class="col-sm-2 col-form-label colorWhite raleway400 align-item-left">Photo de
                  Profil</label>
                <div class="col-sm-4">
                  <input class="form-control align-item-left" type="file" accept=".jpg" id="image" name="image">
                </div>
              </div>
              
              <div class="row justify-content-center ">
                <div class="col-auto">
                  <button type="submit" class="btnValidReg btn-primary mb-3">Valider</button>
                </div>
              </div>
              
            </form>
            <div class="col-sm-8">
              <a class="colorWhite" href="authentication.php">Déja un compte? Cliquez ici!</a>
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