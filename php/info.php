<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="info.css">
  </head>

  <body>

    <div id="entete">
     <a href="Accueil.php">
       <img src="../img/logo_log.png" alt="logo logiciel" height="80" width="320"/></a>
    </div>

    <div id="menu">

      <div id="bandeau">
        <a href="">Le gène<img class="bulle gene" src="../img/bulle_gene.png" alt="Gène" /></a>
        <a href="">La protéine<img class="bulle prot" src="../img/bulle_prot.png" alt="Protéine" /></a>
        <a href=""
      </div>

      <hr>
      <p>
      <?php
      $id = "BC1G_".$_POST["id"];
      if($id != ""){
        echo "L'id que vous avez choisi est $id";
      }else{
        echo "Erreur dans votre entrée";
      }
       ?>
     </p>
    </div>

    <div id="retour">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
