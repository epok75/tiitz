<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>TiiTz Framework</title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link href='<?php print WEB_PATH;?>/tiitz/css/bootstrap-responsive.css' rel='stylesheet' type='text/css' />
</head>					 
<body style="">
	<div class="tiitz">
		<div class="container-fluid" style="width:80%; margin:auto;">
			<form action="<?php echo WEB_PATH; ?>configTiitz/entityGenerator" method="POST" name="formgeneration">
					<?php

						$i = 0;
						foreach ($tables as $key => $value) {

							if($i == 0){
								echo "<div class='row-fluid'>";
							}

							echo '<div class="span3" style="height:150px; margin:10 0 10 0; overflow-y:auto;">';

							echo '<input type="checkbox" checked="checked" name="tablename[]" value="'.$value[0].'">'.$value[0].'<br>';

							foreach ($columsList[$value[0]] as $key2 => $value2) {
								if($value2['Key'] == 'PRI'){
									echo $value2['Field'].' - PRI<br>';
									echo '<input type="hidden"  name="'.$value[0].'primKey" value="'.$value2['Field'].'">';
				 
								} else{
									echo $value2['Field'].'<br>';
								}
								
							}
							echo "</div>";

							$i++;

							if($i == 4){
								echo "</div>";
								$i=0;
							}
						}
						if((count($tables) % 4) != 0){
							echo "</div>";
						}
					?>
				<div class="row-fluid">
					<input class="span12 btn btn-primary" type="submit" name="generateEntity" value="Generate">
				</div>
			</form>
		</div>
	</div>
</body>
</html>