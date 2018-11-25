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
    <title>Blast | BotrytiXploreR</title>
  </head>

  <body>

    <?php
      include "./bandeau_blast.php";
     ?>

     <!-- Realisation et lecture du blast -->

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
        while ($ligne != "\n") 
        {
          $ligne = fgets($blastp_file);   
          echo $ligne;     
          $hits["gene_id"] = substr($ligne, 14, 25);
        }

      }
    ?>

    <div id="menu">

      <hr>

      <h1>Recherche de séquence par Blast</h1>
      <p>Cette recherche de séquence s'effectue sur la base des gènes de
        <i>Botrytis cinerea</i>. Entrez votre séquence ci-dessous :</p>

    <form action="blast.php" method="post">      
      <textarea id="seq" name="seq" rows="20" cols="100" 
      style="margin-left:10px" placeholder=" Votre séquence ..."></textarea>

      <input type="submit" value="Blaster !">
    </form>

    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>
  </body>
</html>
