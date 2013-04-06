
	<?php

				

		class guestbookEntity {
					
			private $comment_id;
			
			private $comment;
			
			private $name;
			


			/********************** GETTER ***********************/
			

			public function getComment_id(){
				return $this->comment_id;
			}

			

			public function getComment(){
				return $this->comment;
			}

			

			public function getName(){
				return $this->name;
			}

			
			/********************** SETTER ***********************/

			public function setComment_id($val){
				$this->comment_id =  $val;
			}

					

			public function setComment($val){
				$this->comment =  $val;
			}

					

			public function setName($val){
				$this->name =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->comment_id)){

					$sql = "DELETE FROM guestbook WHERE comment_id = ".intval($this->comment_id).";";

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

				$sql = 'UPDATE `guestbook` SET `comment_id` = "'.$this->comment_id.'", `comment` = "'.$this->comment.'", `name` = "'.$this->name.'" WHERE comment_id = '.intval($this->comment_id);

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if(!empty($this->comment_id)){
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

				$this->comment_id = '';

				$sql = 'INSERT INTO guestbook (`comment_id`,`comment`,`name`) VALUES ("'.$this->comment_id.'","'.$this->comment.'","'.$this->name.'")';

				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();

				if($result){
					$lastid = TzSQL::getPDO()->lastInsertId();
					$this->comment_id = $lastid;
					return true;
				}
				else{
					tzErrorExtend::catchError(array('Fail insert', __FILE__,__LINE__, true));
					return false;
				}
			}
					

			/********************** FindAll ***********************/
			public function findAll(){

				$sql = 'SELECT * FROM guestbook';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new guestbookEntity();

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
					
					case $param == 'comment_id':
						$param = 'comment_id';
						break;
						
					case $param == 'comment':
						$param = 'comment';
						break;
						
					case $param == 'name':
						$param = 'name';
						break;
						
					default:
						tzErrorExtend::catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM guestbook WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->comment_id = $result->comment_id;
					$this->comment = $result->comment;
					$this->name = $result->name;
					
					return true;
				}
				else{
					tzErrorExtend::catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM guestbook WHERE comment_id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->comment_id = $formatResult->comment_id;
					$this->comment = $formatResult->comment;
					$this->name = $formatResult->name;
				
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
					
					case $param == 'comment_id':
						$param = 'comment_id';
						break;
						
					case $param == 'comment':
						$param = 'comment';
						break;
						
					case $param == 'name':
						$param = 'name';
						break;
						
					default:
						tzErrorExtend::catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM guestbook WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new guestbookEntity();

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
					