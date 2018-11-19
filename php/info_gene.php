<?php

// Démarrage de la session pour conserver l'id du gène
session_start();
$_SESSION['var']=$_POST["id"];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="info.css">
  </head>

  <body>

<!-- entete de la page -->
    <div id="entete">
     <a href="Accueil.php">
       <img src="../img/logo_log.png" alt="logo logiciel" height="80" width="320"/></a>
    </div>

    <div id="menu">
<!-- Bar de menu avec liens et formulaire -->
      <div id="bandeau">

        <form action="info_gene.php" method="post">
          Chercher un autre gène : BC1G_<input type="text" name="id"
            value=<?php
              if($_SESSION['var']!=""){echo $_SESSION['var'];}else{echo "00001";}
            ?> maxlength="5" size="15">
          <input type="submit" value="Go !">

          <a href="info_gene.php">Le gène<img class="bulle gene" src="../img/bulle_gene.png" alt="Gène" /></a>
          <a href="info_prot.php">La protéine<img class="bulle prot" src="../img/bulle_prot.png" alt="Protéine" /></a>

        </form>

      </div>

      <hr>
<!-- interrogation de la BD pour récupérer les infos du gène -->
      <p>
      <?php
        $id = "BC1G_".$_SESSION['var'];
        if($id != ""){
          $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
  								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          $requete = $bdd -> prepare(
            "select length, start, stop, fonction
             from gene
             where locus = ?"
           );

           $requete -> execute(array($id));

          while ($donnees = $requete->fetch())
   				{
   					$length = $donnees['length'];
            $start = $donnees['start'];
            $stop = $donnees['stop'];
            $fonction = $donnees['fonction'];
   				}

        }else{
          echo "Erreur dans votre entrée";
        }
       ?>

<!-- remplissage des informations sur le gène -->
       Voici les informations principales sur le gène <b><?php echo $id; ?></b><br><br>
       Taille de la séquence : <b><?php echo $length; ?></b><br><br>
       Position de début du gène : <b><?php echo $start; ?></b><br><br>
       Position de fin du gène : <b><?php echo $stop; ?></b><br><br>
       Fonction du gène : <b><?php echo $fonction; ?></b><br><br>

     </p>
    </div>

    <div id="retour">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
