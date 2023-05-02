<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=problem_signal;charset=utf8','root','');	



if(isset($_POST['envoyer'])){

	$salle = htmlspecialchars($_POST['salle']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$email = htmlspecialchars($_POST['email']);
	$sujet = htmlspecialchars($_POST['sujet']);
	$typedeprobleme = htmlspecialchars($_POST['typedeprobleme']);
	$description =  htmlspecialchars($_POST['description']);
	$erreur;

	if(!empty($salle) AND !empty($nom)  AND !empty($email) AND !empty($sujet) AND !empty($typedeprobleme) AND !empty($description))
	{
			setlocale(LC_TIME, 'fr_FR');
			date_default_timezone_set('Europe/Paris');
			$date = strftime('%d-%m-%Y, %H:%M');
			$etat = "Non traité";
			$insertprb = $bdd->prepare("INSERT INTO problem_details(salle,nom,prenom,email,sujet,typedeprobleme,description,date_envoie,etat) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$insertprb->execute(array($salle, $nom, $prenom, $email, $sujet, $typedeprobleme, $description, $date,$etat));
			$erreur = "Votre problème a bien était signalé !";
	}
	else
	{
		$erreur = "Tous les champs obligatoire doivent être complété !";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Signalisation de problème</title>
	<link rel="stylesheet" type="text/css" href="../styles/styletest.css">
	<link rel="shortcut icon" type="x-icon" href="../images/icon.png">
</head>
<body>
	<div id="fontW"></div>
	<div align="center">
		<h1 data-text="Signaler un problème">Signaler un problème</h1>
		<form method="POST" action="" >
			<table>
				<tr>
					<td align="right">
						<h4>* = Champ obligatoire </h4>
						<input type="text" placeholder="Salle*" name="salle" id="salle" value="<?php if(isset($salle)){ echo $salle;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="text" placeholder="Nom*" name="nom" id="nom" value="<?php if(isset($nom)){ echo $nom;}?>">
					</td>
				</tr>	
				<tr>
					<td align="right">
						<input type="text" name="prenom" placeholder="Prenom" id="prenom" value="<?php if(isset($prenom)){ echo $prenom;}?>">
					</td>
				</tr>	
				<tr>
					<td align="right">
						<input type="email" name="email" placeholder="Email*" id="email" value="<?php if(isset($email)){ echo $email;}?>">
					</td>
				</tr>	
				<tr>
					<td align="right">
						<input type="text" name="sujet" id="sujet" placeholder="Sujet*" value="<?php if(isset($sujet)){ echo $sujet;}?>">
					</td>
				</tr>	
				<tr>
					<td align="right">
						<input type="text" name="typedeprobleme" placeholder="Type de problème*" id="typedeprobleme" value="<?php if(isset($typedeprobleme)){ echo $typedeprobleme;}?>">
					</td>
				</tr>	
				<tr >
					<td align="right">
						<textarea type="text"  placeholder="Description*" name="description" id="description" value="<?php if(isset($description)){ echo $description;}?>"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">
						<br /> 
						<input type="submit" value="Envoyer" name="envoyer" id="btnE">
					</td>
				</tr>
			</table>

		</form> 
		<?php if(isset($erreur)){echo "<h2>" . $erreur . "</h2>";} ?>
	</div>
	<a href="connexion.php"><button id="conex">Connexion Technicien</button></a>

</body>
</html>