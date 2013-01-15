<form action="generator.php" method="POST" name="formgeneration">
	<table class="table">
		<tr>
	<?php

		$count = 3;

		foreach ($tables as $key => $value) {

			$count++;

			if(($count % 4 ) == 0){
				echo 
				'</tr>
				<tr>';
			}

			echo '<td>';
			echo '<input type="checkbox" checked="checked" name="tablename[]" value="'.$value[0].'">'.$value[0].'<br>';

			echo '<select name="primKey" multiple>';

			$colums = $tzsql::$tzPDO->prepare('show columns from '.$value[0]);
			$colums->execute();
			$columsList = $colums->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($columsList as $key2 => $value2) {
				if($value2['Key'] == 'PRI'){
					echo '<option selected="selected" value="'.$value2['Field'].'">'.$value2['Field'].'</option>';
				}else{
					echo '<option value="'.$value2['Field'].'">'.$value2['Field'].'</option>';
				}
				
			}

			echo '</select><td>';
		}
	?>
		</tr>
	</table>
	<input type="submit" name="s1" value="Generate Class(es)">
	<input type="hidden" name="f" value="formshowed">
</form>