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
    <title>Protéine | BotrytiXploreR</title>
  </head>

  <body>

<!-- Style CSS pour le profil d'hydrophobicité et la séquence -->
    <style>
      #sequence {
        margin-right: 50px;
        font-family: "Courier New", Courier, serif;
        overflow-wrap: break-word;
        word-break:break-all;}
        
      #hydro {
        text-align: center;
        height: auto; width: auto;
        margin-bottom: 10px;}
    </style>
<!-- code php base de données -->
    <?php
      $id = "BC1G_".$_SESSION['var'];
      if($id != ""){
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        // Recupérer la séquence et le profil d'hydrophobicité
        $requete = $bdd -> prepare // query() si pas de variable
        ('
          SELECT sequence, length
          FROM protein
          WHERE id_gene = ?
        ');

        $requete -> execute(array($id));

        // stocke la sequence dans une autre variable
        while ($donnees = $requete->fetch())
        {
          $sequence = $donnees['sequence'];
          $length = $donnees['length'];
        }
        if($_POST["fenetre"]!=""){
          $fenetre = $_POST["fenetre"];
        }else{
          $fenetre = 9;
        }


        if (isset($sequence) AND isset($fenetre)) {
          // $seq = wordwrap($sequence, 75, "<br>", true);
          // echo $sequence;
          $user = get_current_user();
          if ($user == "martin") {
            exec ("Rscript ../Profil_hydro/profil_hydro.R $sequence $fenetre");
          }elseif ($user == "agnesb") {
            exec ("/usr/local/bin/Rscript /Users/agnesb/Sites/projet-web/Profil_hydro/profil_hydro.R $sequence $fenetre");
          }
        }

        // Recupere les infos pfam
        $requete = $bdd -> prepare // query() si pas de variable
        ('
          SELECT *
          FROM pfam
          WHERE locus = ?
        ');

        $requete -> execute(array($id));

        // initialisation des valeurs du tableau
        $pfam = array(); $i=0;

        while($donnees = $requete->fetch()){
          $pfam[$i]["code"] = $donnees["pfam_code"];
          $pfam[$i]["domaine"] = $donnees["domaine"];
          $pfam[$i]["start"] = $donnees["pfam_start"];
          $pfam[$i]["stop"] = $donnees["pfam_stop"];
          $pfam[$i]["length"] = $donnees["length"];
          $pfam[$i]["score"] = $donnees["pfam_score"];

          $i++;
        }
      }

    ?>


<!-- entete de la page -->
    <div id="entete">
     <a href="Accueil.php" title="Vers l'accueil">
       <img src="../img/logo_resize.png" alt="logo logiciel" height="80" width="320"/></a>
    </div>

    <div id="menu">
<!-- Bar de menu avec liens et formulaire -->
      <div id="bandeau">

        <form action="info_gene1.php" method="post">
          Chercher un autre gène : BC1G_<input type="text" name="id"
            value=<?php
              if($_SESSION['var']!=""){echo $_SESSION['var'];}else{echo "00001";}
            ?> maxlength="5" size="15">
          <input type="submit" value="Go !">

          <a class="bouton" href="info_gene.php"> &nbsp Gène &nbsp<img class="bulle gene" src="../img/bulle_gene.png" alt="Gène" /></a>
          <a class="bouton" href="info_prot.php">&nbsp Protéine &nbsp<img class="bulle prot" src="../img/bulle_prot.png" alt="Protéine" /></a>
          <a class="bouton" href="blast.php">&nbsp Blast &nbsp<img class="bulle blast" src="../img/bulle_blast.png" alt="Blast" /></a>

        </form>

      </div>

      <hr>

<!-- Corps de la page -->
<!-- profil d'hydrophobicité -->
      <h1>La séquence protéique :</h1>

      <p id="sequence" wrap=wrap>
        <?php echo "Taille : $length acides aminées <br>$sequence";?></p>

       <h1>Le profil d'hydrophobicité :</h1>

       <form action="info_prot.php" method="post">
         <p style="text-align:center">
           Définir la fenetre : <input type="text" name="fenetre" value=
           <?php
             if($_POST["fenetre"]!=""){
               echo $_POST["fenetre"];
             }else{
               echo "9";
             } ?>
            maxlength="5" size="5">
            <input type="submit" value="Go">
         </p>
         <div id="hydro">
      				<img src="../img/rplot.jpg">
          </div>
        </form>

        <h1>Informations sur les domaines (source : Pfam) :</h1>

<!-- Insertion du tableau des domaines pfam -->
        <table border="1" align="center" style="margin-bottom:10px">
          <?php
            $colname = array("code", "domaine", "start", "stop", "length", "score");
           ?>
           <thead>
             <!-- tr ajoute une ligne -->
             <tr>
               <?php
                 // Entete pour chaque colonne
                 foreach($colname as $key => $name) { ?>
                 <th><?php echo $name; ?></th>
               <?php } ?>
             </tr>
           </thead>

           <tbody>
             <?php
             // Pour chaque ligne
             $rows = count($pfam);
             for($row = 0; $row < $rows; $row++) {
              ?>
              <tr>
                <?php
                // Chaque colonne
                foreach($colname as $key => $name){
                ?>

                  <td>
                    <?php
                      if($name == "code"){ ?>
                        <a href="https://pfam.xfam.org/family/<?php echo $pfam[$row][$name];?>"
                          target="_blank" title="Voir la page Pfam correspondante">
                          <?php echo $pfam[$row][$name];?></a>
                    <?php
                      }else{
                        echo $pfam[$row][$name];
                      }
                    ?>
                </td>

                <?php } ?>
             </tr>

            <?php } ?>

           </tbody>
        </table>

    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
