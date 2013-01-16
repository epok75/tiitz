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

	<form method="post" action="<?php print $_SERVER["SCRIPT_NAME"] ?>">
	

	<div class="">
		<h4>Moteur de templates</h4>

		<label for="tpl">Choix : </label>
		<select id="tpl" name="tpl">
			<option value="twig">Twig</option>
			<option value="smarty">Smarty</option>
			<option value="php">Aucun</option>
		</select>
	</div>
	<?php if(isset($error['tpl'])) : ?>
		<div class="error-tiitz">
			<p><?php print $error['tpl']; ?></p>
		</div>
	<?php endif; ?>
	
	
	<div class="">
		<h4>Routing</h4>
		<div>
			<label for="routesLang">Langage : </label>
			<select id="routesLang" name="routesLang">
				<option value="yml">YAML</option>
				<option value="php">PHP</option>
			</select>
		</div>
		<?php if(isset($error['route'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['route']; ?></p>
			</div>
		<?php endif; ?>
	</div>	


	<div class="">
		<?php if(isset($error['connectDb'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['connectDb']; ?></p>
			</div>
		<?php endif; ?>
		<h4>Base de données</h4>
		<div>
			<label for="user">Utilisateur : </label>
			<input type="text" name="user" <?php if(isset($error['user_value'])) print "value='".$error['user_value']."'"; ?> id="user" placeholder="root" />
		</div>
		<?php if(isset($error['user'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['user']; ?></p>
			</div>
		<?php endif; ?>
		<div>
			<label for="pwd">Mot de Passe : </label>
			<input type="password" name="pwd" id="pwd" />
		</div>
		<?php if(isset($error['pwd'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['pwd']; ?></p>
			</div>
		<?php endif; ?>
		<div>
			<label for="adress">Hôte : </label>
			<input type="text" name="adress" <?php if(isset($error['adress_value'])) print "value='".$error['adress_value']."'"; ?> id="adress" placeholder="127.0.0.1"/>
		</div>
		<?php if(isset($error['adress'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['adress']; ?></p>
			</div>
		<?php endif; ?>
		<div>		
			<label for="name">Nom : </label>
			<input type="text" name="name" <?php if(isset($error['name_value'])) print "value='".$error['name_value']."'"; ?> id="name" placeholder="tiitzBDD" />
		</div>
		<?php if(isset($error['name'])) : ?>
			<div class="error-tiitz">
				<p><?php print $error['name']; ?></p>
			</div>
		<?php endif; ?>
	</div>

	<div>
		<h3>Nouvelles pages</h3>
		<div>
			<label for="">Nom</label>
			<input class='field' id='firstField' type='text' name='pages[]' /><br id='REPERE' />
			<a class='btn btn-success' href='javascript:void(0)' onclick='addField()'><i class='icon-plus icon-white'></i></a>
		</div>	
				
	</div>

	<div class="formEnd">
		<input type="submit" value="Terminer" name="firstConfig" class="btn btn-large btn-primary" />
	</div>

	</form>
	<script type="text/javascript" src="tiitz/js/gui.js"></script>
</body>
</html>