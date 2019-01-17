<!DOCTYPE html>
<html>

<!-- code php interrogation de la BD pour récupérer les infos du gène -->
  <?php
    $id = "BC1G_".$_SESSION['var'];
    if($id != ""){
      $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      // Recupere les informations sur le gène
      $requete = $bdd -> query(
        "select length, start, stop, fonction, sequence
         from gene
         where locus = '$id'"
       );

      while ($donnees = $requete->fetch())
      {
        $length = $donnees['length'];
        $sequence = $donnees['sequence'];
        $start = $donnees['start'];
        $stop = $donnees['stop'];
        $fonction = $donnees['fonction'];
      }

      // Recupere les id des genes ayant la meme fonction que le gene cible si
      // la fonction n'est pas "predicted protein" ou "conserved hypothetical protein"
      if($fonction != "predicted protein" &&
        $fonction != "conserved hypothetical protein"){
          $requete = $bdd -> query(
          "select locus
          from gene
          where fonction = (SELECT fonction
          from gene
          where locus = '$id') and
          locus != '$id'"
        );

        $gene_fct = "";
        while($donnees = $requete -> fetch()){
          if($gene_fct!=""){
            $gene_fct = $gene_fct.", ".$donnees['locus'];
          }else{
            $gene_fct = $donnees['locus'];
          }
        }
      }else{
        $gene_fct = "La fonction n'est pas connue.";
      }

    }else{
      echo "Erreur dans votre entrée";
    }
   ?>
</html>
