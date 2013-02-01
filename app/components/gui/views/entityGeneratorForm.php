<div class="tiitz">
	<div class="container">
		<form action="<?php echo WEB_PATH; ?>configTiitz/entityGenerator" method="POST" name="formgeneration">
				<?php

					$i = 0;
					foreach ($tables as $key => $value) {

						if($i == 0){
							echo "<div class='row-fluid'>";
						}

						echo '<div class="span3" style="height:150px; margin:10 0 10 0; overflow:auto;">';

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
			<div class="row">
				<input class="span12 btn btn-primary" type="submit" name="generateEntity" value="Generate">
			</div>
		</form>
	</div>
</div>