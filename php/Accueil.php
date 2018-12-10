<?php

// Démarrage de la session pour conserver l'id du gène
session_start();
$_SESSION['user']=get_current_user();
$_SESSION['var']="00001";

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/accueil.css">
    <link rel="icon" href="../img/icon.png">
    <title>Accueil | BotrytiXploreR</title>
  </head>

  <body>

    <div id="entete">
      <img src="../img/logo_resize.png" alt="logo logiciel"/>
    </div>

    <div id="menu">
      <h1> Analyse du génome de <i>Botrytis cinerea</i>
        <a href="https://fr.wikipedia.org/wiki/Botrytis_cinerea" target="_blank">
          <img src="../img/wiki.png" alt="wiki" height="30" width="30"/></a>
      </h1>

      <div id="form">

        <p>Que souhaitez vous faire ?</p>
        <a href="info_gene1.php?id=00001"><img src="../img/gene.png" alt="info_gene"
          height="100" width="100" title="Chercher un gène" /></a>
        <a href="blast.php"><img src="../img/blast.png" alt="faire_blast"
          height="105" width="105" title="Faire un blast"/></a>
        <a href="info_fct.php"><img src="../img/fonction.png" alt="info_fct"
          height="100" width="100" title="Chercher une fonction"/></a>
      </div>
    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>
  </body>

</html>
