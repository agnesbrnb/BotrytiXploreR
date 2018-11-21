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
  </head>
  <!-- Nom de la page -->
  <script langage="java-script">
    document.title = 'Gene | BotrytiXploreR';
  </script>

  <body>

    <div id="entete">
     <a href="Accueil.php" title="Vers l'accueil">
       <img src="../img/logo_log.png" alt="logo logiciel" height="80" width="320"/></a>
    </div>

    <div id="menu">
      <div id="bandeau">
        <form action="info_gene1.php" method="post">
          Chercher un gène : BC1G_<input type="text" name="id"
            value=<?php
              if($_SESSION['var']!=""){echo $_SESSION['var'];}else{echo "00001";}
            ?> maxlength="5" size="15">
          <input type="submit" value="Go !">
        </form>
      </div>

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
