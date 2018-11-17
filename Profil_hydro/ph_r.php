<html>
<head>

</head>
<body>
	<!-- FORMULAIRE -->
		<form action="ph_r.php" method="post">
			<p> <font size = "+3"> Profil d'hydrophobicité </font></p>
			ID <input type="text" name="id">
			fenetre <input type="text" name="fenetre">
			<input type="submit" value="Valider">
		</form>


		<!--  RECHERCHE DANS LA BASE DE DONNEES DE LA SEQUENCE -->
		<?php
			if (isset($_POST['id']))
			{
				// charger la base de données
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb','agnes','password',
								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

				$requete = $bdd -> prepare // query() si pas de variable
				('
					SELECT id_gene, sequence
					FROM protein
					WHERE id_gene = ?
					OR id_transcrit = ?
				');							// ? designe les caracteres a changer

				$requete -> execute(array($_POST['id'],$_POST['id'])); // change les valeurs dans l'ordre

				// Dans notre cas on veux que la recherche se fasse soit avec id du transcrit ou du gene
				// d'ou la ligne OR id_transcrit = ?
				// C'est pour cela qu'il y a deux fois $_POST["id"]


				// stocke la sequence dans une autre variable
				while ($donnees = $requete->fetch())
				{
					$sequence = $donnees['sequence'];
				}
				$fenetre = $_POST["fenetre"];

			}

			if (isset($sequence) AND isset($fenetre)) {
				echo $sequence;
				exec ("Rscript profil_hydro.R $sequence $fenetre");
				?>
				<img src="../img/rplot.jpg">
				<?php
			}
		?>





</body>
</html>
