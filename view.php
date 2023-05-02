<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=problem_signal;charset=utf8','root','');

$alert = "<h2>" . "Changement d'état éffectué !" . "</h2>";

if(isset($_GET['view'])){
	$id = $_GET['view'];
	$req = $bdd->prepare("SELECT * FROM problem_details WHERE id = ?");
	$req->execute(array($id));

	if (isset($_POST['attente'])) {
		$requete = $bdd->prepare("UPDATE problem_details SET etat = ? WHERE id = ? ");
		$requete->execute(array('En attente', $id));
		echo $alert;
	}
	if (isset($_POST['resolu'])) {
		$r = $bdd->prepare("UPDATE problem_details SET etat = ? WHERE id = ? ");
		$r->execute(array('Résolu', $id));
		echo $alert;
	}
	if (isset($_POST['non_traiter'])) {
		$r = $bdd->prepare("UPDATE problem_details SET etat = ? WHERE id = ? ");
		$r->execute(array('Non traité', $id));
		echo $alert;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="shortcut icon" type="x-icon" href="icon.png">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<div id="bar_coter"></div>
	<h1 id="titre">Détail du problème</h1>
	<a href="page2.php" id="menu1">Liste des problèmes</a>
	<a href="historique.php" id="menu2">Historique des problèmes</a>
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
	while($resultat = $req->fetch())
	{
		?>	
		<tr>
			<form method="POST" action="">
			<td><?php echo $resultat["salle"]; ?></td>
			<td><?php echo $resultat["sujet"]; ?></td>
			<td><?php echo $resultat["typedeprobleme"]; ?></td>
			<td><?php echo $resultat["nom"]; ?></td>
			<td><?php echo $resultat["date_envoie"]; ?></td>
			<td><?php if($resultat["etat"] == "Résolu"){ ?> <h3 id="etatR"> <?php echo $resultat["etat"];?></h3><?php }elseif($resultat["etat"] == "En attente"){?>
			<h3 id="etatA"> <?php echo $resultat["etat"];?></h3> <?php }else{?> <h3 id="etatN"> <?php echo $resultat["etat"];?> </h3> <?php }; ?></td>
			
			</form>
		<br />
		</tr>
	</table>
	<table id="desc">

		<th>Description</th>
		<tr>
			<td><?php echo $resultat["description"]; ?></td>
		</tr>
	</table>
	<?php
		if(isset($_POST['resolu'])){
		$to = $resultat["email"];
		$subject  = 'Rapport du problème';
		$text = 'SALLE : ' . $resultat["salle"] . "<br>" .
				'NOM : ' . $resultat["nom"] . "<br>" .
				'PRENOM : ' . $resultat["prenom"] . "<br>" .
				'EMAIL : ' . $resultat["email"] . "<br>" .
				'SUJET : ' . $resultat["sujet"] . "<br>" .
				'TYPE DE PROBLEME : ' . $resultat["typedeprobleme"] . "<br>" .
				'DESCRIPTION : ' . $resultat["description"] . "<br>" .
				'DATE D\'ENVOIE : ' . $resultat["date_envoie"] . "<br>".
				'ETAT : Résolu' . "<br>";

		$message  = $text;
		$headers  = 'From: [EPSI_BOL_REPORT@gmail.com' . "\r\n" .
		            'MIME-Version: 1.0' . "\r\n" .
		            'Content-type: text/html; charset=utf-8';
		mail($to, $subject, $message, $headers);
	}
	}
	?>
	<form method="POST" action="">
		<label ><h3 id="text_change">Changer l'état du problème : </h3></label>
		<input type="submit" value="En attente" id="attente" name="attente"/>
		<input type="submit" value="Résolu" id="resolu" name="resolu" />
		<input type="submit" value="Non traité" id="non_traiter" name="non_traiter" />
	</form>
</body>
</html>