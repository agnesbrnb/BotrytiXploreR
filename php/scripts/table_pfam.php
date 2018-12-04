<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  
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

</html>
