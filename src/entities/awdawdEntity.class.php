
<?php

			

	class awdawdEntity {
				
		private $id;
		
		private $name;
		
		private $pass;
		


		/********************** GETTER ***********************/
		

		public function getId(){
			return $this->id;
		}

		

		public function getName(){
			return $this->name;
		}

		

		public function getPass(){
			return $this->pass;
		}

		/********************** SETTER ***********************/

		public function setId($val){
			$this->id =  $val;
			}

				

		public function setName($val){
			$this->name =  $val;
			}

				

		public function setPass($val){
			$this->pass =  $val;
			}

				

		/********************** Delete ***********************/

		public function Delete(){

			if(!empty($this->id)){
				$id = $this->id;

				$sql = "DELETE FROM awdawd WHERE id = ".intval($id).";";

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

			$sql = 'UPDATE `awdawd` SET `id` = "'.$this->id.'", `name` = "'.$this->name.'", `pass` = "'.$this->pass.'" WHERE id = '.intval($this->id);

			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();

			return $result;
		}

		/********************** Insert ***********************/

		public function Insert(){

			$this->id = '';

			$sql = 'INSERT INTO awdawd (`id`,`name`,`pass`) VALUES ("'.$this->id.'","'.$this->name.'","'.$this->pass.'")';

			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();

			return $result;
		}
				

		/********************** FindAll ***********************/
		public function findAll(){

			$sql = 'SELECT * FROM awdawd';
			$result = tzSQL::getPDO()->prepare($sql);
			$result->execute();
			$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
			$entitiesArray = array();

			foreach ($formatResult as $key => $data) {

				$tmpInstance = new awdawdEntity($this->tzSQL);

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
					
				case $param == 'name':
					$param = 'name';
					break;
					
				case $param == 'pass':
					$param = 'pass';
					break;
					
				default:
					die('colonne introuvable');
					//a changer par le systeme de gestion d'erreur
			}

			$sql =  'SELECT * FROM awdawd WHERE '.$param.' = "'.$value.'"';
			$result = $this->tzSQL->tzExecute($sql, 'obj');

			if(!empty($result)){
						$this->id = $result->id;
						$this->name = $result->name;
						$this->pass = $result->pass;
					
				return $result;

			}
		}

				

	}

?>
				