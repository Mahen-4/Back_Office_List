<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=problem_signal;charset=utf8','root','');

if(isset($_POST['con']))
{
	$mailconnect = htmlspecialchars($_POST["email"]);
	$mdpconnect = sha1($_POST["mdp"]);
	$erreur;
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requeser = $bdd->prepare("SELECT * FROM tech_co WHERE email = ? AND mdp = ?");
		$requeser->execute(array($mailconnect,$mdpconnect));
		$userexist = $requeser->rowCount();
		if($userexist > 0)
		{
			header("Location: page2.php");
		}
		else
		{
			$erreur = "Mauvais mail ou mot de passe";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="shortcut icon" type="x-icon" href="icon.png">
	<style type="text/css">
*{
	margin: 0px;
	padding: 0px;
	font-family: 'Microsoft JhengHei UI';

}
body{
	background: #f9fbff;
	height: 100vh;
	overflow: hidden;
}
table{
	position: absolute;
	top: 25%;
	left: 42%;
}
td{
	padding: 10px;
}
input{
	border: 0px solid grey;
	border-radius: 3px;
	width:210px;
	height: 35px;
	outline: none;
	border-bottom: 2px solid #94C3D8;


}
input:hover{
	border-bottom: 3px solid #3ECF96;
	transition: 0.2s linear;
}
#fontW{
	height: 300px;
	width: 280px;
	background-color: white;
	position: absolute;
	left: 40.5%;
	top: 20%;
	border: 0;
	border-radius: 15px;
	box-shadow: 0 5px 10px #e1e5ee;
	overflow: hidden;
	border-radius: 20px;

}

#connexion{
	outline: none;
	display: block;
	border: 0;
	font-size: 20px;
	line-height: 1;
	border-radius: 30px;
	background: linear-gradient(120deg,#94C3D8,#3ECF96);
	color: white;
	cursor: pointer;
	transition: all 0.3s linear;
	position: absolute;
	top: 48%;
	left: 43%;
	height: 50px;
	width: 200px;
}
#connexion:hover,
#connexion:focus{
	background: linear-gradient(120deg,#3ECF96,#94C3D8);
}
#connexion:active{
	border: 1px solid black;
	color: black;
}

h1{
	color: #3ECF96;
	font-size: 45px;
	z-index: 2;
	position: absolute;
	left: 35%;
	top: 1%;
}

h2{
	position: absolute;
	top: 75%;
	left: 35%;
	color: black;
	z-index: 3;

}
	</style>
</head>
<body>	
	<h1 data-text="Connexion Technicien">Connexion Technicien</h1>
	<div id="fontW"></div>
	<form method="POST" action="">
		<table>
			<tr>
				<td>
					<input type="email" name="email" placeholder="email">
				</td>
			</tr>
			<tr>
				<td>
					<input type="password" name="mdp" placeholder="mot de passe">
				</td>
			</tr>
			<input type="submit" name="con" id="connexion" value="Connexion">
		</table>
		<?php if(isset($erreur)){echo "<h2>" . $erreur . "</h2>";} ?>
	</form>
</body>
</html>