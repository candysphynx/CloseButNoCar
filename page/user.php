<?php

namespace user;

session_start();
include_once __DIR__ . "/../auth/sessions_management.php";
if (isConnected() == False) {
  header('Location: authentication.php');
  exit();
}

include_once __DIR__ . "/../classes/user/UserClass.php";
include_once __DIR__ . "/../classes/DataBase.php";


use User;
use user\User as UserUser;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if ($_POST["username"] == "" || $_POST["user_age"] == "" || $_POST["user_email"] == "" || $_POST["user_pdw"] == "") {
    ?>
    <div class="d-flex justify-content-center colorWhite">
      <p>Merci de remplir tout les champs....</p>
    </div>
    <?php
  } else {
    $encryptedpdw = sha1($_POST["user_pdw"]);

    $useruser = new UserUser(
      $_POST["username"],
      $_POST["user_age"],
      $_POST["user_email"],
      $encryptedpdw,
      file_get_contents($_FILES['user_img']['tmp_name']),
    );

    $useruser->__update($_SESSION['user_id']);

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
      $("#edit").click(function () {
        $("#modify_user").css("display", "flex");
      })
    });
  </script>
</head>

<body>

  <div class="container-fluid bkgBrown">
    <!-- Menu -->
    <div class="row sticky-top">
      <?php
      include __DIR__ . "/../layout/displaymenu.php";
      ?>
    </div>
    <!-- Body du profil -->
    <div class="row">
      <div class="col">
        <div class="bkgImg row">
          <!-- Col de Gauche -->
          <div class="col-4">
            <?php
            user\User::displayUserInfos($_SESSION['user_id']); ?>
          </div>
          <!-- Col de Droite -->
          <div class="col-8 d-flex flex-column">
            <button type="button" id="edit" class=" btnEdit btn btn-outline-primary">EDIT</button>
            <form action="" method="POST" enctype="multipart/form-data" id="modify_user">
              <div class="row">
                <div class="row ">
                  <p class="d-flex colorWhite raleway400 fs40 justify-content-center">Modification de Profil</p>
                </div>
                <div class=" colorWhite row g-3 align-items-center justify-content-center ">
                  <div class="col-auto">
                    <label for="user_image" class="col-form-label">Image :</label>
                  </div>
                  <div class="col-auto">
                    <input class="form-control" type="file"  accept=".jpg" id="user_img" name="user_img">
                  </div>
                </div>
                <div class=" colorWhite row g-3 align-items-center justify-content-center" style="padding-left: 46px;">
                  <div class="col-auto">
                    <label for="username" class="col-form-label">Pseudo : </label>
                  </div>
                  <div class="col-auto ">
                    <input type="text" id="username" value="<?php echo $_SESSION['username'];?>" class="form-control" name="username">
                  </div>

                </div>
                <div class=" colorWhite row g-3 align-items-center justify-content-center" style="padding-left: 63px;">
                  <div class="col-auto">
                    <label for="user_email" class="col-form-label">E-mail : </label>
                  </div>
                  <div class="col-auto ">
                    <input type="email" id="user_email" value="<?php echo $_SESSION['email'];?>" class="form-control" name="user_email">
                  </div>
                </div>
                <div class=" colorWhite row g-3 align-items-center justify-content-center" style="padding-left: 63px;">
                  <div class="col-auto">
                    <label for="user_age" class="col-form-label">Age : </label>
                  </div>
                  <div class="col-auto ">
                    <input type="text" id="user_age" value="<?php echo $_SESSION['age'];?>" class="form-control" name="user_age">
                  </div>
                </div>

                <div class=" colorWhite row g-3 align-items-center justify-content-center ">
                  <div class="col-auto">
                    <label for="user_pdw" class="col-form-label">Mot de passe :</label>
                  </div>
                  <div class="col-auto">
                    <input type="password" id="user_pdw" name="user_pdw" class="form-control">
                  </div>
                </div>
                <div class="col-auto d-flex align-items-center">
                  <button type="submit" class="btn btn-outline-light">Modifier</button>
                </div>
              </div>
            </form>
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