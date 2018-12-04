<?php

// Démarrage de la session pour récupérer l'id du gène
session_start();

 ?>

<!DOCTYPE html>
<html>

  <?php
    if (isset($_POST['seq']))
    {
      // initialisation de la sequence
      $seq = "";
      $type = $_POST['type_blast'];
      // Explosion de seq en fonction des \n
      $fasta = explode("\n", $_POST['seq']);

      // creation / "ecrasement" de query.fasta
      $path_to_query = "./tmp/query.fasta";
      $path_to_res = "./tmp/result.blastp";

      $query_file = fopen("$path_to_query", 'w');

      // Boucle sur les "morceaux" de l'explosion
      for ($i=0; $i < sizeof($fasta); $i++)
      {
        // traitement de la premiere ligne
        if ($i == 0)
        {
          // si elle commence avec > alors il y a un ligne de description
          if(substr($fasta[$i], 0, 1) != '>')
          {
            // sinon ecriture d'un ligne generique pour respecter le format fasta
            fputs($query_file, "> query\n");
            // concatenation de la sequence
            $seq .= $fasta[$i];
          }
          else
          {
            // Ecriture de la ligne descriptive - (celle avec ">")
            fputs($query_file, $fasta[$i]);
          }
        }
        else
        {
          // concatenation de la sequence
          $seq .= $fasta[$i];
        }

      }
      // Suppression des espaces present dans la sequence
      $seq = preg_replace("/\s+/", "", $seq);
      // Toutes les lettres sont mises en majuscule
      $seq = strtoupper($seq);
      // ecriture de la sequence
      fputs($query_file, $seq);
      // fermeture
      fclose($query_file);

      // Realisation du blast
      if ($_SESSION['user'] == "martin") {
        exec ("blast".$type[0]." -query $path_to_query -db ../bd/".$type."_db/botrytis_".$type."_db -out $path_to_res");

      }elseif ($_SESSION['user'] == "agnesb") {
        exec ("/usr/local/bin/blast".$type[0]." -query $path_to_query -db ../bd/".$type."_db/botrytis_".$type."_db -outfmt \"7 stitle evalue\" -out $path_to_res");
      }

      // Affichage du resultat blast
      // ouverture du blastp
      $blastp_file = fopen("$path_to_res", 'r');
      $ligne = fgets($blastp_file);
      $result = array();
      // Lecture jusqu'aux resultats
      while ($ligne[0] == "#")
      {
        $ligne = fgets($blastp_file);
      }
      $hits  = array(); $i=0;

      while ($ligne[0] != "#")
      {
        // Stock id
        $hits[$i]["locus"] = substr($ligne, 2, 10);
        // Stock le hit
        $tmp = explode(")", $ligne);
        $hits[$i]["fonction"] = $tmp[1].")";
        $hits[$i]["evalue"] = $tmp[2];

        $i++;
        $ligne = fgets($blastp_file);
      }

    }
  ?>
</html>
