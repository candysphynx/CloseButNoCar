<nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
    </a>
    <a class="navbar-brand">
      <img src="../public/favico.png" width="30" height="30" alt="">
    </a>
      <a class="navbar-brand" href="home.php">Close But No Car</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav px-3">
          <li class="nav-item active activeGradient">
            <a class="nav-link" href="home.php">Enchères <span class="sr-only">(ici)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="pastbids.php">Enchères Terminées</a>
          </li>
          <li class="nav-item">
            <a <?php  if(isConnected()) { echo("class=\"nav-link\""); } else { echo("class=\"nav-link disabled\""); } ?> href="user.php">Mon Profil</a>
          </li>
          <li class="nav-item">
            <a <?php if(isConnected()) { echo("class=\"nav-link\""); } else { echo("class=\"nav-link disabled\""); } ?> href="contributeauction.php">Mes Contributions</a>
          </li>
          <li class="nav-item">
            <a <?php if(isConnected()) { echo("class=\"nav-link\""); } else { echo("class=\"nav-link disabled\""); } ?> href="newauction.php">Mes Annonces</a>
          </li>
          <li class="nav-item">
            <a <?php if(isConnected()) { echo( "class=\"nav-link colorRed\" href=\"authentication.php\">Déconnexion"); } else { echo("class=\"nav-link \" href=\"authentication.php\">Connexion / Inscription"); } ?> </a>
          </li>
          
        </ul>
      </div>
  </nav>