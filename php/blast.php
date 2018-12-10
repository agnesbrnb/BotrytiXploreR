<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/info.css">
    <link rel="icon" href="../img/icon.png">
    <title>Blast | BotrytiXploreR</title>
  </head>

  <body>

    <?php
      include "./mep/bandeau_blast.php";
     ?>

    <div id="menu">

      <hr>

      <h1>Recherche de séquence par Blast</h1>
      <p>Cette recherche de séquence s'effectue sur la base des gènes de
        <i>Botrytis cinerea</i>. Entrez votre séquence ci-dessous :</p>

      <form action="blast_rep.php" method="post" style="margin-bottom:10px">
        <textarea id="seq" name="seq" rows="20" cols="100" style="resize:none"
        style="margin-left:10px" placeholder=" Votre séquence ..."></textarea>
        <br>

        <select name="type_blast">
          <option value="prot">Protéine</option>
          <option value="nucl">ADN</option>
        </select>

        <input type="submit" value="Blaster !">
      </form>

    </div>

  </body>
</html>
