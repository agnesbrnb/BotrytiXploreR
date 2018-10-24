<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8','USER_LOGIN','PASSWORD');
		
	}
	catch (Exception $e)
	{
        	die('Erreur : ' . $e->getMessage());
	}
	
        $answer = $bdd->query('SELECT name,surname FROM identity');
?>
        <TABLE>
<?php
        $i=0;
        while ($data = $answer->fetch())
        {
            $i++;
            echo '<TR><TD>'.$i.'</TD><TD>'.$data['name'].'</TD><TD>'.$data['surname'].'</TD></TR>';
        }
	$answer->closeCursor();
?>
        </TABLE>
