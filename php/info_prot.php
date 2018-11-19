<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

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
<!-- interrogation de la BD pour récupérer les infos sur la protéine -->
      <p>La séquence protéique : </p>
      <p id="sequence" wrap=wrap>

        <?php
          $id = "BC1G_".$_SESSION['var'];
          if($id != ""){
            $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
    								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $requete = $bdd -> prepare // query() si pas de variable
    				('
    					SELECT id_gene, sequence
    					FROM protein
    					WHERE id_gene = ?
    				');

            $requete -> execute(array($id));

            // stocke la sequence dans une autre variable
    				while ($donnees = $requete->fetch())
    				{
    					$sequence = $donnees['sequence'];
    				}
            if($_POST["fenetre"]!=""){
              $fenetre = $_POST["fenetre"];
            }else{
              $fenetre = 9;
            }


    			}

    			if (isset($sequence) AND isset($fenetre)) {
            // $seq = wordwrap($sequence, 75, "<br>", true);
    				echo $sequence;
    				exec ("/usr/local/bin/Rscript /Users/agnesb/Sites/projet-web/Profil_hydro/profil_hydro.R $sequence $fenetre");
    		?>

      </p><br>

       <form action="info_prot.php" method="post">
         Définir la fenetre : <input type="text" name="fenetre"
           value=<?php
           if($_POST["fenetre"]!=""){
             echo $_POST["fenetre"];
           }else{
             echo "9";
           } ?> maxlength="5" size="5">
         <input type="submit" value="Go">
         <div id="hydro">
      				<img src="../img/rplot.jpg" >
          </div>
        </form>

    		<?php
    			}

        ?>

    </div>

    <div id="retour">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
