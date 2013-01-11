<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TiiTz Framework</title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />
	<link href="tiitz/css/bootstrap.css" rel="stylesheet" type='text/css'/>
    <link href="tiitz/css/bootstrap-responsive.css" rel="stylesheet" type='text/css' />
    <link rel="stylesheet" type="text/css" href="tiitz/css/style-gui.css" type='text/css' />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>					 
<body>
		<fieldset>
			<header>
				Configuration initiale
			</header>
			<form method="post" action="<?php $_SERVER["SCRIPT_NAME"] ?>">
			<div class="content">
				<div id="notif" class="error">&nbsp;</div>
				<div class="formPart">
					<h4>Base de données</h4>
					
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
					<h4>Routing</h4>
						<label for="routesLang">Langage : </label>
							<select id="routesLang" name="routesLang">
								<option value="yml">YAML</option>
								<option value="php">PHP</option>
							</select>
							<label for="">Pages à créer : </label>
							<input class='field' id='firstField' type='text' name='pages[]' /><br id='REPERE' />
							<a class='btn btn-success' href='javascript:void(0)' onclick='addField()'><i class='icon-plus icon-white'></i></a>
							<!--<textarea name="pages" id="pages" rows="7" placeholder="inscription			connexion				accueil				contact"></textarea>
						-->
				</div>
				<!--<div class="formPart">
					<h4>Nom du premier bundle</h4>
						<label for="bundle">Nom du bundle : </label>
						<input type="text" id="bundle" name="bundle"/>
				</div>-->
				<div class="formEnd">
					<input type="submit" value="Terminer" name="firstConfig" class="btn btn-large btn-primary" />
				</div>
				
		</div>
		</form>
		</fieldset>
	<script type="text/javascript" src="tiitz/js/gui.js"></script>
	<script type="text/javascript">
    	function addField() {
    		var obj = $('#firstField').clone();
    		obj.removeAttr('id');
    		obj.removeAttr('value');
    		$('#REPERE').before(obj);
    	}
    </script>
</body>
</html>