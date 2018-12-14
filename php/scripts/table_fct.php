<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>

<!-- Insertion du tableau des domaines list_locus -->
  <table border="1" align="center" style="margin-bottom:10px">
    <?php
      $colname = array("locus", "fonction");
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
       $rows = count($list_locus);
       for($row = 0; $row < $rows; $row++) {
        ?>
        <tr>
          <?php
          // Chaque colonne
          foreach($colname as $key => $name){
          ?>

            <td>
              <?php
                if($name == "locus"){
                    $code = explode("_", $list_locus[$row][$name])[1];
                    $url = "info_gene1.php?id=$code";
              ?>

                  <a href=<?php echo $url; ?> title="Voir la fiche du gène">
                    <?php echo $list_locus[$row][$name];?></a>

              <?php
                }else{
                  echo $list_locus[$row][$name];
                }
              ?>
          </td>

          <?php } ?>
       </tr>

      <?php } ?>

     </tbody>
  </table>

</html>
