<form action="<?php echo WEB_PATH; ?>configTiitz/entityGenerator" method="POST" name="formgeneration">
	
	<?php


		foreach ($tables as $key => $value) {

			echo '<div>';

			echo '<input type="checkbox" checked="checked" name="tablename[]" value="'.$value[0].'">'.$value[0].'<br>';

			foreach ($columsList[$value[0]] as $key2 => $value2) {
				if($value2['Key'] == 'PRI'){
					echo $value2['Field'].' - PRI<br>';
					echo '<input type="hidden"  name="'.$value[0].'primKey" value="'.$value2['Field'].'">';
 
				} else{
					echo $value2['Field'].'<br>';
				}
				
			}

			echo '<div>';
		}
	?>

	<input type="submit" name="generateEntity" value="Generate">
</form>