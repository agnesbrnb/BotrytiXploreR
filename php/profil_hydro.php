<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="info.css">
  </head>

  <body>

<!-- entete de la page -->
    <div id="entete">
     <a href="Accueil.php">
       <img src="../img/logo_log.png" alt="logo logiciel" height="80" width="320"/></a>
    </div>

    <div id="menu">
<!-- Bar de menu avec liens et formulaire -->
      <div id="bandeau">

        <form action="info_gene.php" method="post">
          Chercher un autre gène : BC1G_<input type="text" name="id"
            value=<?php
              if($_SESSION['var']!=""){echo $_SESSION['var'];}else{echo "00001";}
            ?> maxlength="5">
          <input type="submit" value="Go !">

          <a href="info_gene.php">Le gène<img class="bulle gene" src="../img/bulle_gene.png" alt="Gène" /></a>
          <a href="info_prot.php">La protéine<img class="bulle prot" src="../img/bulle_prot.png" alt="Protéine" /></a>
          <a href="profil_hydro.php">Hydrophobicité<img class="bulle hydro" src="../img/phydro.png" alt="Hydrophob" /></a>

        </form>

      </div>

      <hr>
<!-- interrogation de la BD pour récupérer les infos sur la protéine -->
      <p>


     </p>
    </div>

    <div id="retour">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
