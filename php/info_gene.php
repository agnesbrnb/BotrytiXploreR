<?php

// Démarrage de la session pour conserver l'id du gène
session_start();
// $_SESSION['var']=$_POST['id'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="info.css">
    <link rel="icon" href="../img/icon.png">
  </head>
  <!-- Nom de la page -->
  <script langage="java-script">
    document.title = 'Gene | BotrytiXploreR';
  </script>

  <body>

<!-- code php interrogation de la BD pour récupérer les infos du gène -->
  <?php
    $id = "BC1G_".$_SESSION['var'];
    if($id != ""){
      $bdd = new PDO('mysql:host=localhost;dbname=projetweb','barnadavy','fanfreluchedu91',
              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      // Recupere les informations sur le gène
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

      // Recupere les id des genes ayant la meme fonction que le gene cible si
      // la fonction n'est pas "predicted protein" ou "conserved hypothetical protein"
      if($fonction != "predicted protein" &&
        $fonction != "conserved hypothetical protein"){

          $requete = $bdd -> prepare(
          "select locus
          from gene
          where fonction = (SELECT fonction
          from gene
          where locus = ?)"
          );
          $requete -> execute(array($id));

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


<!-- entete de la page -->
    <div id="entete">
     <a href="Accueil.php" title="Vers l'accueil">
       <img src="../img/logo_log.png" alt="logo logiciel" height="80" width="320"/></a>
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

          <a href="info_gene.php">Le gène<img class="bulle gene" src="../img/bulle_gene.png" alt="Gène" /></a>
          <a href="info_prot.php">La protéine<img class="bulle prot" src="../img/bulle_prot.png" alt="Protéine" /></a>
          <a href="blast.php">Faire un Blast<img class="bulle blast" src="../img/bulle_blast.png" alt="Blast" /></a>

        </form>

      </div>

      <hr>

<!-- Corps de la page -->
<!-- remplissage des informations sur le gène -->
             <h1>
                Les informations sur le gène : <br>
              </h1>
        <p>
         Taille de la séquence : <b><?php echo $length; ?></b><br><br>
         Position de début du gène : <b><?php echo $start; ?></b><br><br>
         Position de fin du gène : <b><?php echo $stop; ?></b><br><br>
         Fonction du gène : <b><?php echo $fonction; ?></b><br><br>
         Gène-s ayant la même fonction : <b><?php echo $gene_fct; ?></b><br><br>
       </p>

    </div>

    <div class="auteur">
      <img src="../img/logo.png" alt="logo auteur" height="120" width="120" />
    </div>

  </body>

</html>
