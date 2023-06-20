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

  if ($_POST["user_email"] == "" || $_POST["user_pdw"] == "") {
    ?>
    <div class="flex align column colorWhite">
      <p>Merci de remplir tout les champs....</p>
    </div>
    <?php
  } else {
    $connectUser = new User(
      null,
      null,
      $_POST["user_email"],
      $_POST["user_pdw"],
      null
    );
    $connectUser->LoggedUser();
    if(isConnected()) {
    header('Location: home.php');
    exit();}
    else { ?>
    <div class="row ">
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none; ">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
      </svg>

      <div class="alert alert-warning d-flex align-items-center" role="alert" >
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:" style="width: 25px; height: 25px;"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        <strong>Holy guacamole!</strong> Mauvais Login !
        </div>
      </div>
    </div>

      <?php
    }
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
          <!-- Sign-in form -->
          <div class="row pt-2 bg-dark mb-3 border-linear h-60 " style="max-width: 58rem;">
            <form action="" method="POST" enctype="multipart/form-data">

              <div class="mb-3 row ">
                <p class="d-flex colorWhite raleway400 fs40 justify-content-center">Connexion</p>
              </div>
              <div class="mb-3 row ">
                <label for="staticEmail"
                  class="col-sm-2 col-form-label colorWhite raleway400 align-item-left">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control align-item-left" name="user_email" id="inputEmailLogin">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="inputPassword"
                  class=" col-sm-2 col-form-label colorWhite raleway400 align-item-left">Password</label>
                <div class="col-sm-8">
                  <input type="password" name="user_pdw" class="form-control align-item-left" id="inputPasswordLogin">
                </div>
              </div>
              <div class="row justify-content-center ">
                <div class="col-auto">
                  <button type="submit" class="btnValidLog btn-primary mb-3">Valider</button>
                </div>
              </div>
            </form>
            <div class="col-sm-8">
              <a class="colorWhite" href="register.php">Pas encore Inscrit? Cliquez ici!</a>
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