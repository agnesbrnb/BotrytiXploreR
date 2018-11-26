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
      // Explosion de seq en fonction des \n
      $fasta = explode("\n", $_POST['seq']);
      // creation / "ecrasement" de query.fasta
      $query_file = fopen('query.fasta', 'w');

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
      $user = get_current_user();
      if ($user == "martin") {
        exec ("blastp -query query.fasta -db ../bd/prot_db/botrytis_prot_db -out result.blastp");

      }elseif ($user == "agnesb") {
        exec ("/usr/local/bin/blastp -query query.fasta -db ../bd/prot_db/botrytis_prot_db -out result.blastp");
      }

      // Affichage du resultat blast
      // ouverture du blastp
      $blastp_file = fopen('result.blastp', 'r');
      $ligne = "";
      $result = array();
      // Lecture jusqu'aux resultats
      while (substr($ligne, 0, 9) != "Sequences")
      {
        $ligne = fgets($blastp_file);
      }
      // Saute la ligne vide
      $ligne = fgets($blastp_file);
      $ligne = fgets($blastp_file);
      $hits  = array();

      $table_ligne = array(); $i=0;

      while ($ligne != "\n")
      {
        $ligne = fgets($blastp_file);
        $table_ligne[$i] = $ligne;
        $hits["gene_id"] = substr($ligne, 14, 25);
        $i++;
      }

    }
  ?>
</html>
