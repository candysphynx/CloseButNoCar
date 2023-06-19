<?php

namespace user;
session_start();
include_once __DIR__."\..\auth\sessions_management.php";
if( isConnected() == False) { header('Location: authentication.php'); exit();  }

include_once __DIR__ . "/../classes/user/UserClass.php";
include_once __DIR__."\..\auth\sessions_management.php";
include_once __DIR__ . "/../classes/DataBase.php";

use User;

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
       $(document).ready(function() {
        $("#edit").click(function() {
                $("#modify_user").css("display", "flex");}) 
        });
                
    </script>
</head>

<body>

  <div class="container-fluid bkgBrown">
    <!-- Menu -->
    <div class="row sticky-top">
    <?php
    include __DIR__."\..\layout\displaymenu.php";
    ?>
    </div>

    <!-- Body du profil -->
    <div class="row">
      <div class="col">
        <div class="bkgImg row">
          <div class="btnEdit">
            <button type="button" id="edit" class="btn btn-outline-primary">EDIT</button>
          </div>
            <div class="row">
              <!-- Col de Gauche -->
              <div class="col-6">
            <?php
            user\User::displayUserInfos(); ?>
              </div>
              <!-- Col de Droite -->
              <div class="col-6">
                <form id="modify_user">
                  <input type="text"/>
                  <input type="text"/>
                </form>
              </div>
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