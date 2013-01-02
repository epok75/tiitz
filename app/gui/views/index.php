<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TiiTz Framework</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href="../gui/styles/bootstrap.css" rel="stylesheet" />
    <link href="../gui/styles/bootstrap-responsive.css" rel="stylesheet">
    <link href="../gui/styles/docs.css" rel="stylesheet">
    <link href="../gui/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../gui/styles/guiStyle.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>					 
<body>
		<fieldset>
			<header>
				Configuration initiale
			</header>
			<div class="content">
				<div id="notif" class="error">&nbsp;</div>
				<div class="formPart">
					<h4>Base de données</h4>
					<form method="post" action="<?php $_SERVER["SCRIPT_NAME"] ?>">
							<label for="user">Utilisateur : </label>
							<input type="text" name="user" onblur="checkBDD()" id="user" placeholder="root" />
							<label for="pwd">Mot de Passe : </label>
							<input type="password" onblur="checkBDD()" name="pwd" id="pwd" />
							<label for="adress">Hôte : </label>
							<input type="text" name="adress" id="adress" onblur="checkBDD()" placeholder="127.0.0.1"/>
							<label for="name">Nom : </label>
							<input type="text" name="name" id="name" onblur="checkBDD()" placeholder="tiitzBDD" />
				</div>
				<div class="formPart">
					<h4>Moteur de templates</h4>
						<label for="tpl">Choix : </label>
						<select id="tpl" name="tpl">
							<option value="twig">Twig</option>
							<option value="smarty">Smarty</option>
							<option value="php">Aucun</option>
						</select>
				</div>
				<div class="formPart">
					<h4>Langage de Routing</h4>
						<label for="routesLang">Langage : </label>
							<select id="routesLang" name="routesLang">
								<option value="yml">YAML</option>
								<option value="php">PHP</option>
							</select>
				</div>
				<!--<div class="formPart">
					<h4>Nom du premier bundle</h4>
						<label for="bundle">Nom du bundle : </label>
						<input type="text" id="bundle" name="bundle"/>
				</div>-->
				<div class="formEnd">
					<input type="submit" value="Terminer" name="firstConfig" class="btn btn-large btn-primary" />
				</div>
				</form>
		</div>
		</fieldset>
	<script type="text/javascript" src="../gui/js/guiJS.js"></script>
</body>
</html>