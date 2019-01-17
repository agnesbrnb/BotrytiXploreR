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
      include "./scripts/sql_gene.php";
      include "./mep/bandeau.php";
    ?>

    <div id="menu">

      <hr>

<!-- Corps de la page -->
<!-- remplissage des informations sur le gène -->
             <h1>
                Les informations sur le gène : <br>
              </h1>
        <p>
         Taille de la séquence : <b><?php echo $length; ?></b><br><br>
         Séquence : <b><?php echo $sequence; ?></b><br><br>
         Position de début du gène : <b><?php echo $start; ?></b><br><br>
         Position de fin du gène : <b><?php echo $stop; ?></b><br><br>
         Fonction du gène : <b><?php echo $fonction; ?></b><br><br>
         Gène-s ayant la même fonction : <b><?php echo $gene_fct; ?></b><br><br>
       </p>

    </div>


  </body>

</html>
