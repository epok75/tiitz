
	<?php

				

		class usersEntity {
					
			private $id;
			
			private $firstname;
			
			private $lastname;
			
			private $address;
			
			private $right_id;
			


			/********************** GETTER ***********************/
			

			public function getId(){
				return $this->id;
			}

			

			public function getFirstname(){
				return $this->firstname;
			}

			

			public function getLastname(){
				return $this->lastname;
			}

			

			public function getAddress(){
				return $this->address;
			}

			

			public function getRight_id(){
				return $this->right_id;
			}

			
			/********************** SETTER ***********************/

			public function setId($val){
				$this->id =  $val;
			}

					

			public function setFirstname($val){
				$this->firstname =  $val;
			}

					

			public function setLastname($val){
				$this->lastname =  $val;
			}

					

			public function setAddress($val){
				$this->address =  $val;
			}

					

			public function setRight_id($val){
				$this->right_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->id)){

					$sql = "DELETE FROM users WHERE id = ".intval($this->id).";";

					$result = TzSQL::getPDO()->prepare($sql);
					$result->execute();

					return $result;
				}
				else{
					DebugTool::$error->catchError(array('Fail delete', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** Update ***********************/

			public function Update(){

				$sql = 'UPDATE `users` SET `id` = "'.$this->id.'", `firstname` = "'.$this->firstname.'", `lastname` = "'.$this->lastname.'", `address` = "'.$this->address.'", `right_id` = "'.$this->right_id.'" WHERE id = '.intval($this->id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->id)){
					if($result)
						return true;
					else{
						DebugTool::$error->catchError(array('Fail update', __FILE__,__LINE__, true));
						return false;
					}
				}
				else{
					DebugTool::$error->catchError(array('Fail update: primkey is null', __FILE__,__LINE__, true));
					return false;
				}
			}

			/********************** Insert ***********************/

			public function Insert(){

				$this->id = '';

				$sql = 'INSERT INTO users (`id`,`firstname`,`lastname`,`address`,`right_id`) VALUES ("'.$this->id.'","'.$this->firstname.'","'.$this->lastname.'","'.$this->address.'","'.$this->right_id.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->id = $lastid;
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM users';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new usersEntity();

					foreach ($data as $k => $value) {

						$method = 'set'.ucfirst($k);
						$tmpInstance->$method($value);
					}
					array_push($entitiesArray, $tmpInstance);
				}

				if(!empty($entitiesArray))
					return $entitiesArray;
				else{
					DebugTool::$error->catchError(array('No results', __FILE__,__LINE__, true));
					return false;
				}						

			}

			/************* FindOneBy(column, value) ***************/
			public function findOneBy($param,$value){


				switch ($param){
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'firstname':
						$param = 'firstname';
						break;
						
					case $param == 'lastname':
						$param = 'lastname';
						break;
						
					case $param == 'address':
						$param = 'address';
						break;
						
					case $param == 'right_id':
						$param = 'right_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->id = $result->id;
					$this->firstname = $result->firstname;
					$this->lastname = $result->lastname;
					$this->address = $result->address;
					$this->right_id = $result->right_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM users WHERE id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->id = $formatResult->id;
					$this->firstname = $formatResult->firstname;
					$this->lastname = $formatResult->lastname;
					$this->address = $formatResult->address;
					$this->right_id = $formatResult->right_id;
				
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}
			

			/************* FindManyBy(column, value) ***************/
			public function findManyBy($param,$value){


				switch ($param){
					
					case $param == 'id':
						$param = 'id';
						break;
						
					case $param == 'firstname':
						$param = 'firstname';
						break;
						
					case $param == 'lastname':
						$param = 'lastname';
						break;
						
					case $param == 'address':
						$param = 'address';
						break;
						
					case $param == 'right_id':
						$param = 'right_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new usersEntity();

						foreach ($data as $k => $value) {

							$method = 'set'.ucfirst($k);
							$tmpInstance->$method($value);
						}
						array_push($entitiesArray, $tmpInstance);
					}

					if($entitiesArray)
						return $entitiesArray;
					else{
						DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
						return false;
					}

				}
			}

					

		}

	?>
					