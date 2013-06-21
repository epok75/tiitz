<?php

use Components\Controller\TzController;
use Components\SQLEntities\TzSQL;

class GeneratorController extends TzController{

	public function generateEntityAction() {

		$objPDO = TzSQL::getPDO();
		
		if (!is_null($objPDO)) {
			$obj = $objPDO->prepare('show tables');
			$obj->execute();
			$tables = $obj->fetchAll();

            $dbNameQuery = $objPDO->prepare("SELECT DATABASE() as dbname");
            $dbNameQuery->execute();
            $dbName = $dbNameQuery->fetchAll(PDO::FETCH_ASSOC);

			$columsList = array();
			foreach ($tables as $key => $value) {

				$colums = $objPDO->prepare('show columns from '.$value[0]);
				$colums->execute();
				$columsList[$value[0]] = $colums->fetchAll(PDO::FETCH_ASSOC);
			}

            $foreignKeyQuery ="SELECT A.TABLE_SCHEMA AS FKTABLE_SCHEM, A.TABLE_NAME AS FKTABLE_NAME, A.COLUMN_NAME AS FKCOLUMN_NAME,
                                A.REFERENCED_TABLE_SCHEMA AS PKTABLE_SCHEM, A.REFERENCED_TABLE_NAME AS PKTABLE_NAME,
                                A.REFERENCED_COLUMN_NAME AS PKCOLUMN_NAME
                                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE A, INFORMATION_SCHEMA.TABLE_CONSTRAINTS B
                                WHERE A.TABLE_SCHEMA = B.TABLE_SCHEMA AND A.TABLE_NAME = B.TABLE_NAME
                                AND A.CONSTRAINT_NAME = B.CONSTRAINT_NAME AND B.CONSTRAINT_TYPE IS NOT NULL
                                HAVING PKTABLE_SCHEM IS NOT NULL
                                and A.TABLE_SCHEMA = :dbname
                                ORDER BY A.TABLE_SCHEMA, A.TABLE_NAME, A.ORDINAL_POSITION limit 1000";

            $getFK = $objPDO->prepare($foreignKeyQuery);
            $getFK->execute(array(":dbname"=>$dbName[0]['dbname']));

            $FK = $getFK->fetchAll(PDO::FETCH_ASSOC);

            var_dump($FK);

			if(empty($_POST['generateEntity']) && empty($_POST['tablename'])) {
				require_once ROOT.'/app/Components/Gui/views/entityGeneratorForm.php';
			}
			else{
				require_once(ROOT.'/app/Components/Gui/includes/entityGenerator.php');

				$results = createEntity($_POST['tablename']);

				if(!empty($results))
					require_once(ROOT.'/app/Components/Gui/views/entityGeneratorResults.php');
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}
		} else {
			Header("Location:". WEB_PATH);
		}
		
	}
}