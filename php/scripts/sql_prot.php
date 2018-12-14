<!DOCTYPE html>
<html>

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
          if ($_SESSION['user'] == "martin") {
            exec ("Rscript ./profil_hydro.R $sequence $fenetre");
          }elseif ($_SESSION['user'] == "agnesb") {
            exec ("/usr/local/bin/Rscript /Users/agnesb/Sites/projet-web/php/scripts/profil_hydro.R $sequence $fenetre");
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

</html>
