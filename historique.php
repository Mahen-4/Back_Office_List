<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=problem_signal;charset=utf8','root','');

$req = $bdd->query("SELECT * FROM problem_details WHERE etat = 'Résolu' ORDER BY id DESC");



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Historique des problèmes</title>
	<link rel="shortcut icon" type="x-icon" href="icon.png">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div id="bar_coter"></div>
	<h1 id="titre">Historique des problèmes</h1>
	<a href="page2.php" id="menu1">Liste des problèmes</a>
	<img src="icon.png" alt="icon" id="icon">

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
	while($result = $req->fetch())
	{
	?>
	<tr>
		<td><?php echo $result["salle"]; ?></td>
		<td><?php echo $result["sujet"]; ?></td>
		<td><?php echo $result["typedeprobleme"]; ?></td>
		<td><?php echo $result["nom"]; ?></td>
		<td><?php echo $result["date_envoie"]; ?></td>
		<td><h3 id="etatR"><?php echo $result["etat"];?></h3></td>
		<td><a href="view.php?view=<?php echo $result["id"]; ?>" class="btn-view"><img src="eye.png" alt="" title="Voir plus"></a> </td>
		<br />
	</tr>
	<?php		
	}
	?>
</table>
</body>
</html>