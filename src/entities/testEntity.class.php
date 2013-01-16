
<?php

			

	class testEntity {
				
		private $q2e;
		
		private $awd;
		


		/********************** GETTER ***********************/
		

		public function getId(){
			return $this->id;
		}

		

		public function getQ2e(){
			return $this->q2e;
		}

		

		public function getAwd(){
			return $this->awd;
		}

		/********************** SETTER ***********************/

		public function setId($val){
			$this->id =  $val;
			}

				

		public function setQ2e($val){
			$this->q2e =  $val;
			}

				

		public function setAwd($val){
			$this->awd =  $val;
			}

				

		/********************** Delete ***********************/

		public function Delete(){

			if(!empty($this->id)){
				$id = $this->id;

				$sql = "DELETE FROM test WHERE id = ".intval($id).";";

				$result = tzSQL::getPDO()->prepare($sql);
				$result->execute();

				return $result;
			}
			else{
				//ERREUR RIEN A SUPPRIMER, utiliser FindOneBy/FindAll AVANT
				//Ex: $test = $xxx->getEntity('user')->findOneBy('id','1')->delete();
			}
		}
				

		/********************** Update ***********************/

		public function Update(){

			$sql = 'UPDATE `test` SET `id` = "'.$this->id.'", `q2e` = "'.$this->q2e.'", `awd` = "'.$this->awd.'" WHERE id = '.intval($this->id);

			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();

			return $result;
		}

		/********************** Insert ***********************/

		public function Insert(){

			$this->id = '';

			$sql = 'INSERT INTO test (`id`,`q2e`,`awd`) VALUES ("'.$this->id.'","'.$this->q2e.'","'.$this->awd.'")';

			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();

			return $result;
		}
				

		/********************** FindAll ***********************/
		public function findAll(){

			$sql = 'SELECT * FROM test';
			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();
			$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
			$entitiesArray = array();

			foreach ($formatResult as $key => $data) {

				$tmpInstance = new testEntity($this->tzSQL);

				foreach ($data as $k => $value) {

					$method = 'set'.ucfirst($k);
					$tmpInstance->$method($value);
				}
				array_push($entitiesArray, $tmpInstance);
			}

			return $entitiesArray;

		}

		/************* FindOneBy(column, value) ***************/
		public function findOneBy($param,$value){


			switch ($param){
				
				case $param == 'id':
					$param = 'id';
					break;
					
				case $param == 'q2e':
					$param = 'q2e';
					break;
					
				case $param == 'awd':
					$param = 'awd';
					break;
					
				default:
					die('colonne introuvable');
					//a changer par le systeme de gestion d'erreur
			}

			$sql =  'SELECT * FROM test WHERE '.$param.' = "'.$value.'"';
			$result = $this->tzSQL->tzExecute($sql, 'obj');

			if(!empty($result)){
						$this->id = $result->id;
						$this->q2e = $result->q2e;
						$this->awd = $result->awd;
					
				return $result;

			}
		}

				

	}

?>
				