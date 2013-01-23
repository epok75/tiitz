<?php

foreach ($_POST['tablename'] as $tablename) {

	// fill parameters from form
	$table = $tablename;
	$class = $tablename."Entity";

	$primkey = empty($_POST[$tablename.'primKey']) ? false : $_POST[$tablename.'primKey'] ;

	$sql = "SHOW COLUMNS FROM ".$table;
	$colums = tzSQL::getPDO()->prepare( $sql );
	$colums->execute();
	$columsResult = $colums->fetchAll();

	$filename = ROOT . "/src/entities/" . $class . ".class.php";


	// open file in insert mode
	$file = fopen( $filename, "w+" );
	$filedate = date( "d.m.Y" );


	$c = "
<?php

			

	class $class {
				";


	foreach ( $columsResult as $key => $value ) {
		$col=$value[0];

		$c.= "
		private $$col;
		";
	}


	$c.="


		/********************** GETTER ***********************/
		";

	foreach ( $columsResult as $key => $value ) {
		$col=$value[0];

		$mname = "get" . ucfirst( $col ) . "()";
		$mthis = "$" . "this->" . $col;
		$c.="

		public function $mname{
			return $mthis;
		}

		";
	}

	$c.= "
		/********************** SETTER ***********************/";

	foreach ( $columsResult as $key => $value ) {
		$col=$value[0];

		$c.=
			"

		public function set" . ucfirst( $col ) . "($" . "val){
			$" . "this->" . $col . " =  $" . "val;
		}

				";
	}

	$c.="

		/********************** Delete ***********************/

		public function Delete(){

			if(!empty($" . "this->id)){
				$" . "id = $" . "this->id;

				$" . "sql" . " = \"DELETE FROM $table WHERE id = \".intval($" . "id).\";\";

				$" . "result = tzSQL::get" . "PDO()->prepare($" . "sql);
				$" . "result->execute();

				return $". "result;
			}
			else{
				//ERREUR RIEN A SUPPRIMER, utiliser FindOneBy/FindAll/Find AVANT
				//Ex: $" . "test = $" . "xxx->getEntity('user')->findOneBy('id','1')->delete();
			}
		}
				";

	$count = 0;

	$sql = "UPDATE `".$table."` SET ";
	foreach ( $columsResult as $key => $value ) {
		$col = $value[0];

		if ( $count < ( count( $columsResult ) -1 ) )
			$sql .= "`".$col."` = \"'.$" . "this->$col.'\", ";
		else
			$sql .= "`".$col."` = \"'.$" . "this->$col.'\" ";

		$count++;
	}

	$sql .= "WHERE id = '.intval($" . "this->id)";

	$c.="

		/********************** Update ***********************/

		public function Update(){

			$" . "sql = '".$sql.";

			$" . "result = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "result->execute();

			if(!empty($" . "this->id)){
				return $". "result;
			}
			else{
				//ERREUR RIEN A SUPPRIMER, utiliser FindOneBy/FindAll/Find AVANT
				//Ex: $" . "test = $" . "xxx->getEntity('user')->findOneBy('id','1')->delete();
			}
		}";

	$count = 0;

	$sql = "INSERT INTO ".$table." (";

	foreach ( $columsResult as $key => $value ) {
		$col=$value[0];

		if ( $count < ( count( $columsResult ) - 1 ) )
			$sql .= "`".$col."`,";
		else
			$sql .= "`".$col."`)";

		$count++;
	}

	//remise du compteur a 0
	$count = 0;

	$sql .= " VALUES (";

	foreach ( $columsResult as $key => $value ) {
		$col=$value[0];

		if ( $count < ( count( $columsResult ) - 1 ) )
			$sql .= "\"'.$" . "this->$col.'\",";
		else
			$sql .= "\"'.$" . "this->$col.'\")";

		$count++;
	}

	$c.="

		/********************** Insert ***********************/

		public function Insert(){

			$" . "this->id = '';

			$" . "sql = '".$sql."';

			$" . "result = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "result->execute();

			return $". "result;
		}
				";


	$c.="

		/********************** FindAll ***********************/
		public function findAll(){

			$" . "sql = 'SELECT * FROM ".$table."';
			$" . "result = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "result->execute();
			$" . "formatResult = $" . "result->fetchAll(PDO::FETCH_ASSOC);
			$" . "entitiesArray = array();

			foreach ($" . "formatResult as $" . "key => $" . "data) {

				$" . "tmpInstance = new ".$class."();

				foreach ($" . "data as $" . "k => $" . "value) {

					$" . "method = 'set'.ucfirst($" . "k);
					$" . "tmpInstance->$" . "method($" . "value);
				}
				array_push($" . "entitiesArray, $" . "tmpInstance);
			}

			return $" . "entitiesArray;

		}

		/************* FindOneBy(column, value) ***************/
		public function findOneBy($" . "param,$" . "value){


			switch ($" . "param){
				";


	foreach ( $columsResult as $key => $value ) {

		$col = $value[0];

		$c.= "
				case $" . "param == '".$col."':
					$"."param = '".$col."';
					break;
					";
	}


	$c.="
				default:
					die('colonne introuvable');
					//a changer par le systeme de gestion d'erreur
			}

			$" . "sql =  'SELECT * FROM $table WHERE '.$"."param.' = \"'.$" . "value.'\"';
			$" . "data = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "data->execute();
			$" . "result =  $" . "data->fetch(PDO::FETCH_OBJ);

			if(!empty($" . "result)){
				";

			foreach ( $columsResult as $key => $value ) {

				$col = $value[0];

				$c.="$" . "this->" . $col . " = $" . "result->" . $col.";
				";
			}
	$c.="
			}
		}

				";

	if($primkey){
		$c.=
		"

		/********************** Find(id) ***********************/
		public function find($". "id){

			$" . "sql = 'SELECT * FROM ".$table." WHERE ".$primkey." = ' . $" . "id;
			$" . "result = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "result->execute();
			$" . "formatResult = $" . "result->fetch(PDO::FETCH_OBJ);
			if(!empty($" . "formatResult)){
			";

		foreach ( $columsResult as $key => $value ) {

			$col = $value[0];

			$c.="	$" . "this->" . $col . " = $" . "formatResult->" . $col.";
			";
		}


		$c.="
			}
			else
				return false;
			//pas de resultat trouve
		}
		";
	}

	$c.="

		/************* FindManyBy(column, value) ***************/
		public function findManyBy($" . "param,$" . "value){


			switch ($" . "param){
				";


	foreach ( $columsResult as $key => $value ) {

		$col = $value[0];

		$c.= "
				case $" . "param == '".$col."':
					$"."param = '".$col."';
					break;
					";
	}


	$c.="
				default:
					die('colonne introuvable');
					//a changer par le systeme de gestion d'erreur
			}

			$" . "sql =  'SELECT * FROM $table WHERE '.$"."param.' = \"'.$" . "value.'\"';
			$" . "data = tzSQL::get" . "PDO()->prepare($" . "sql);
			$" . "data->execute();
			$" . "formatResult = $" . "data->fetchAll(PDO::FETCH_ASSOC);
			$" . "entitiesArray = array();

			if(!empty($" . "formatResult)){

				foreach ($" . "formatResult as $" . "key => $" . "data) {

					$" . "tmpInstance = new ".$class."();

					foreach ($" . "data as $" . "k => $" . "value) {

						$" . "method = 'set'.ucfirst($" . "k);
						$" . "tmpInstance->$" . "method($" . "value);
					}
					array_push($" . "entitiesArray, $" . "tmpInstance);
				}

				return $" . "entitiesArray;

			}
		}

				";

	$c.="

	}

?>
				";

	fwrite( $file, $c );

	echo "La classe \"$class\" a bien ete generee<br>";
}