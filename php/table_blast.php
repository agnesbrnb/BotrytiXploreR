<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>

<!-- Insertion du tableau des domaines pfam -->
  <table style="margin-left:10px" >

     <tbody>
       <?php
       // Pour chaque ligne
       foreach($table_ligne as $key => $name){
        ?>
        <tr>
            <td>
              <?php
                  echo $name;
              ?>
          </td>
       </tr>

      <?php } ?>

     </tbody>
  </table>

</html>
