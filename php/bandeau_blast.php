<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bandeau_blast.css">
  </head>

  <body>
    <?php
      include "./menu.php";
     ?>
    <div id="bandeau">

      <form action="info_gene1.php" method="post">
        Chercher un gène : BC1G_<input type="text" name="id"
          value=<?php
            if($_SESSION['var']!=""){echo $_SESSION['var'];}else{echo "00001";}
          ?> maxlength="5" size="15">
        <input type="submit" value="Go !">
      </form>
    </div>
  </body>
</html>
