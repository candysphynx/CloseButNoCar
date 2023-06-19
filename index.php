
<?php
include_once __DIR__."/auth/sessions_management.php";
destroySession ();
/* Redirection dans le dossier Page et dans la page home. 
Obligatoire car site pas en ligne, et donc racine de dossier différente entre nos 2 ordis *Jimmy  */
  header('Location: page/home.php');
  exit();
?>