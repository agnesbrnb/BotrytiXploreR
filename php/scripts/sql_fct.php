<!DOCTYPE html>
  <html>

  <!-- code php interrogation de la BD pour chercher des gènes avec une fonction -->
    <?php
      $fct = $_POST['fct'];
      if($fct != ""){
        $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        // Recupere les informations sur le gène
        $requete = $bdd -> query(
          "select locus, fonction
           from gene
           where fonction LIKE '%$fct%'"
         );

        $list_locus = array(); $i=0;
        while ($donnees = $requete->fetch())
        {
          $list_locus[$i]["locus"]=$donnees['locus'];
          $list_locus[$i]["fonction"]=$donnees["fonction"];
          $i++;
        }
      }
    ?>

</html>
