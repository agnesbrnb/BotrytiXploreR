<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="info.css">
    <link rel="icon" href="../img/icon.png">
    <title>Blast | BotrytiXploreR</title>
  </head>

  <body>

    <?php
      include "./bandeau_blast.php";
     ?>

    <div id="menu">

      <hr>

      <h1>Recherche de séquence par Blast</h1>
      <p>Cette recherche de séquence s'effectue sur la base des gènes de
        <i>Botrytis cinerea</i>. Entrez votre séquence ci-dessous :</p>

      <textarea id="seq" name="seq" rows="20" cols="100"
      style="margin-left:10px">Votre séquence ...
      </textarea>

      <input type="submit" value="Lancer le Blast">

    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>
  </body>
</html>
