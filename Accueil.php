<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="accueil.css">
  </head>

  <body>

    <div id="entete">
      <img src="./img/logo_log" alt="logo logiciel"/>
    </div>

    <div id="menu">
      <h1> Analyse du génome de <i>Botrytis cinerea</i>
        <a href="https://fr.wikipedia.org/wiki/Botrytis_cinerea">
          <img src="./img/wiki.png" alt="wiki" height="30" width="30"/></a>
      </h1>

      <div id="form">
        <form action="info.php" method="post">
          Recherche par ID du locus <input type="text" name="id">
          <input type="submit" value="Rechercher">

          ou Recherche par BLAST <input type="submit" value="GO" formaction="blast.php">


          <select name="tf_select" onchange="update(this,document.getElementById('tf'));">
            <option value="">- Choisir une fonction -</option>
            <?php
            $a = array("Nucléase","Catalyseur","Protéine non définie");
            foreach($a as $e)
            {
              echo "<option value='".$e."'>".$e."</option>";
            }
            ?>
          </select>


        </form>
      </div>
    </div>

    <div id="auteur">
      <a href="Accueil.php"><img src="./img/logo.png" alt="logo auteur" height="120" width="120" /></a>
    </div>

  </body>

</html>
