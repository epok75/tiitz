<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TiiTz Framework</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href="styles/bootstrap.css" rel="stylesheet">
    <link href="styles/bootstrap-responsive.css" rel="stylesheet">
    <link href="styles/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/guiStyle.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>					 
<body>
	<header>
		Configuration
	</header>
	<div>
		<div class="content">
			<div class="formPart">
				<h4>Base de données</h4>
				<form method="post" action="controller/gui.php">
						<label for="user">Utilisateur : </label>
						<input type="text" name="user" id="user" />
						<label for="pwd">Mot de Passe : </label>
						<input type="password" name="pwd" id="pwd" />
						<label for="adress">Adresse : </label>
						<input type="text" name="adress" id="adress" />
						<label for="name">Nom : </label>
						<input type="text" name="name" id="name" />
			</div>
			<div class="formPart">
				<h4>Moteur de templates</h4>
					<label for="tpl">Choix : </label>
					<select id="tpl" name="tpl">
						<option>Twig</option>
						<option>Smarty</option>
						<option>Aucun</option>
					</select>
			</div>
			<div class="formPart">
				<h4>Langage du fichier de config</h4>
					<label for="routesLang">Langage : </label>
						<select id="routesLang" name="routesLang">
							<option>YAML</option>
							<option>PHP</option>
						</select>
			</div>
			<div class="formPart">
				<h4>Nom du premier bundle</h4>
					<label for="bundle">Nom du bundle : </label>
					<input type="text" id="bundle" name="bundle"/>
			</div>
			<div class="formPart">
				<input type="submit" value="Terminer" name="firstConfig" class="btn btn-large btn-primary" />
			</div>
			<span class="formEnd"></span>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/guiJS.js"></script>
</body>
</html>