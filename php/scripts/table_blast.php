<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>

<!-- Insertion du tableau des domaines pfam -->
  <table border="1" align="center" style="margin-left:10px" >

       <?php
       $colname = array("locus", "fonction", "evalue");
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
          $rows = count($hits);
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
                     $code = explode("_", $hits[$row][$name])[1];
                     $url = "info_gene1.php?id=$code";
                  ?>
                     <a href= <?php echo $url; ?> title="Voir la fiche du gène">
                       <?php echo $hits[$row][$name];?></a>
                 <?php
                   }else{
                     echo $hits[$row][$name];
                   }
                 ?>
             </td>

             <?php } ?>
          </tr>

         <?php } ?>

        </tbody>

  </table>

</html>
