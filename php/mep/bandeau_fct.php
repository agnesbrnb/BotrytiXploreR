<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/bandeau_blast.css">
  </head>

  <body>

    <?php
      include "./mep/menu.php";
     ?>

    <div id="bandeau">

      <form action="info_fct.php" method="post">
        Chercher des gènes avec pour fonction : <input type="text" name="fct"
          placeholder="Une fonction..." size="20">
        <input type="submit" value="Go !">
      </form>
    </div>

  </body>
</html>
