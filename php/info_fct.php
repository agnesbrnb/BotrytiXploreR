<?php

// Démarrage de la session pour conserver l'id du gène
session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/info.css">
    <link rel="icon" href="../img/icon.png">
    <title>Gene | BotrytiXploreR</title>
  </head>

  <body>

    <?php
      include "./mep/bandeau_fct.php";
      include "./scripts/sql_fct.php";
    ?>

    <div id="menu">

      <hr>

<!-- Corps de la page -->
<!-- remplissage des informations sur le gène -->
       <h1>
          Les gènes correspondant à la fonction donnée : <br>
        </h1>

        <p>
          <?php
          echo $fct;
            $rows = count($list_locus);
            for($row=0; $row<$rows; $row++ ){
              echo $list_locus[$row]."\n";
            }
           ?>
       </p>

    </div>

  </body>

</html>
