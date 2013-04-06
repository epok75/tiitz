
	<?php

				

		class usersEntity {
					
			private $user_id;
			
			private $first_name;
			
			private $last_name;
			
			private $user;
			
			private $password;
			
			private $avatar;
			


			/********************** GETTER ***********************/
			

			public function getUser_id(){
				return $this->user_id;
			}

			

			public function getFirst_name(){
				return $this->first_name;
			}

			

			public function getLast_name(){
				return $this->last_name;
			}

			

			public function getUser(){
				return $this->user;
			}

			

			public function getPassword(){
				return $this->password;
			}

			

			public function getAvatar(){
				return $this->avatar;
			}

			
			/********************** SETTER ***********************/

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			public function setFirst_name($val){
				$this->first_name =  $val;
			}

					

			public function setLast_name($val){
				$this->last_name =  $val;
			}

					

			public function setUser($val){
				$this->user =  $val;
			}

					

			public function setPassword($val){
				$this->password =  $val;
			}

					

			public function setAvatar($val){
				$this->avatar =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->user_id)){

					$sql = "DELETE FROM users WHERE user_id = ".intval($this->user_id).";";

					$result = TzSQL::getPDO()->prepare($sql);
					$result->execute();

					return $result;
				}
				else{
					tzErrorExtend::catchError(array('Fail delete', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** Update ***********************/

			public function Update(){

				$sql = 'UPDATE `users` SET `user_id` = "'.$this->user_id.'", `first_name` = "'.$this->first_name.'", `last_name` = "'.$this->last_name.'", `user` = "'.$this->user.'", `password` = "'.$this->password.'", `avatar` = "'.$this->avatar.'" WHERE user_id = '.intval($this->user_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->user_id)){
					if($result)
						return true;
					else{
						tzErrorExtend::catchError(array('Fail update', __FILE__,__LINE__, true));
						return false;
					}
				}
				else{
					tzErrorExtend::catchError(array('Fail update: primkey is null', __FILE__,__LINE__, true));
					return false;
				}
			}

			/********************** Insert ***********************/

			public function Insert(){

				$this->user_id = '';

				$sql = 'INSERT INTO users (`user_id`,`first_name`,`last_name`,`user`,`password`,`avatar`) VALUES ("'.$this->user_id.'","'.$this->first_name.'","'.$this->last_name.'","'.$this->user.'","'.$this->password.'","'.$this->avatar.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->user_id = $lastid;
					return true;
				}
				else{
					tzErrorExtend::catchError(array('Fail insert', __FILE__,__LINE__, true));
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
					tzErrorExtend::catchError(array('No results', __FILE__,__LINE__, true));
					return false;
				}						

			}

			/************* FindOneBy(column, value) ***************/
			public function findOneBy($param,$value){


				switch ($param){
					
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'first_name':
						$param = 'first_name';
						break;
						
					case $param == 'last_name':
						$param = 'last_name';
						break;
						
					case $param == 'user':
						$param = 'user';
						break;
						
					case $param == 'password':
						$param = 'password';
						break;
						
					case $param == 'avatar':
						$param = 'avatar';
						break;
						
					default:
						tzErrorExtend::catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM users WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->user_id = $result->user_id;
					$this->first_name = $result->first_name;
					$this->last_name = $result->last_name;
					$this->user = $result->user;
					$this->password = $result->password;
					$this->avatar = $result->avatar;
					
					return true;
				}
				else{
					tzErrorExtend::catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM users WHERE user_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->user_id = $formatResult->user_id;
					$this->first_name = $formatResult->first_name;
					$this->last_name = $formatResult->last_name;
					$this->user = $formatResult->user;
					$this->password = $formatResult->password;
					$this->avatar = $formatResult->avatar;
				
					return true;
				}
				else{
					tzErrorExtend::catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}
			

			/************* FindManyBy(column, value) ***************/
			public function findManyBy($param,$value){


				switch ($param){
					
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'first_name':
						$param = 'first_name';
						break;
						
					case $param == 'last_name':
						$param = 'last_name';
						break;
						
					case $param == 'user':
						$param = 'user';
						break;
						
					case $param == 'password':
						$param = 'password';
						break;
						
					case $param == 'avatar':
						$param = 'avatar';
						break;
						
					default:
						tzErrorExtend::catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
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
						tzErrorExtend::catchError(array('Result is null', __FILE__,__LINE__, true));
						return false;
					}

				}
			}

					

		}

	?>
					