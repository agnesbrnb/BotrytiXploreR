<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="accueil.css">
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
        <form action="info_gene1.php" method="post">
          Recherche par ID du locus : BC1G_<input type="text" name="id"
            value="00001" maxlength="5">
          <input type="submit" value="Rechercher">

          ou Recherche par BLAST <input type="submit" value="GO" formaction="blast.php">

        </form>
      </div>
    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>
  </body>

</html>
