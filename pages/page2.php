<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="shortcut icon" type="x-icon" href="../images/icon.png">
	<title>Liste des problèmes</title>
</head>
<body>	

	<div id="bar_coter"></div>
	<a href="historique.php" id="menu1">Historique des problèmes</a>
	<a href="page1.php" id="menu2">Signaler un problème</a>
	<h1 id="titre">LISTE DES PROBLÈMES</h1>
	<img src="../images/icon.png" alt="icon" id="icon">
	<?php 

	$bdd = new PDO('mysql:host=127.0.0.1;dbname=problem_signal;charset=utf8','root','');
	$requete = $bdd->query("SELECT * FROM problem_details WHERE etat = 'Non traité' OR etat = 'En attente' ORDER BY id DESC");
	if(isset($_POST['filtre1'])){

		$requete = $bdd->query("SELECT * FROM problem_details WHERE etat = 'En attente' ORDER BY id DESC");

	}
	else if(isset($_POST['filtre2'])){

		$requete = $bdd->query("SELECT * FROM problem_details WHERE etat = 'Non traité' ORDER BY id DESC");		
	}
	else if(isset($_POST['filtre3'])){

		$requete = $bdd->query("SELECT * FROM problem_details WHERE etat = 'Non traité' OR etat = 'En attente' ORDER BY id DESC");		
	}
	else if(isset($_POST['valider_etage'])){
		$etage = $_POST['etage'];
		switch($etage){

			case 'rdj':
				$requete = $bdd->query("SELECT * FROM problem_details WHERE salle LIKE 'R%' AND etat != 'Résolu' ORDER BY id DESC");
				break;
			case 'etage0':
				$requete = $bdd->query("SELECT * FROM problem_details WHERE salle LIKE '_0%' AND etat != 'Résolu' ORDER BY id DESC");
				break;
			case 'etage1':
				$requete = $bdd->query("SELECT * FROM problem_details WHERE salle LIKE '_1%' AND etat != 'Résolu' ORDER BY id DESC");
				break;
			case 'etage2':
				$requete = $bdd->query("SELECT * FROM problem_details WHERE salle LIKE '_2%' AND etat != 'Résolu' ORDER BY id DESC");
				break;
			case 'etage3':
				$requete = $bdd->query("SELECT * FROM problem_details WHERE salle LIKE '_3%' AND etat != 'Résolu' ORDER BY id DESC");
				break;			
		}
	}

	?>
<table>

	<thead>
		<tr>
			<th>Salle</th>
			<th>Sujet</th>
			<th>Type de problème</th>
			<th>Nom</th>
			<th>Date d'envoie</th>
			<th>Etat</th>
		</tr>
	</thead>
	<?php
	while($resultat = $requete->fetch())
	{
	?>
	<tr>	
		<td><?php echo $resultat["salle"]; ?></td>
		<td><?php echo $resultat["sujet"]; ?></td>
		<td><?php echo $resultat["typedeprobleme"]; ?></td>
		<td><?php echo $resultat["nom"]; ?></td>
		<td><?php echo $resultat["date_envoie"]; ?></td>
		<td><?php if($resultat["etat"] == "Résolu"){ ?> <h3 id="etatR"> <?php echo $resultat["etat"];?></h3><?php }elseif($resultat["etat"] == "En attente"){?>
		<h3 id="etatA"> <?php echo $resultat["etat"];?></h3> <?php }else{?> <h3 id="etatN"> <?php echo $resultat["etat"];?> </h3> <?php }; ?></td>
		<td><a href="view.php?view=<?php echo $resultat["id"]; ?>" class="btn-view"><img src="../images/eye.png" alt="" title="Voir plus"></a> </td>
		<br />
	</tr>
	<?php		
	}
	?>
	<form method="POST" action="">
		<h2>Filtre</h2>
		<input type="submit" name="filtre1" value="En attente" id="filtre1">
		<input type="submit" name="filtre2" value="Non traité" id="filtre2">
		<input type="submit" name="filtre3" value="Tout" id="filtre3">
		<select name="etage">
			<option value="rdj">Rez-de-jardin</option>
			<option value="etage0">Etage 0</option>
			<option value="etage1">Etage 1</option>
			<option value="etage2">Etage 2</option>
			<option value="etage3">Etage 3</option>
		</select>
		<input type="submit" name="valider_etage" id="valider_etage" value="Valider">
	</form>
</table>
</body>
</html>