
	<?php

				

		class commentsEntity {
					
			private $id;
			
			private $comment;
			
			private $date;
			
			private $user_id;
			
			private $post_id;
			


			/********************** GETTER ***********************/
			

			public function getId(){
				return $this->id;
			}

			

			public function getComment(){
				return $this->comment;
			}

			

			public function getDate(){
				return $this->date;
			}

			

			public function getUser_id(){
				return $this->user_id;
			}

			

			public function getPost_id(){
				return $this->post_id;
			}

			
			/********************** SETTER ***********************/

			public function setId($val){
				$this->id =  $val;
			}

					

			public function setComment($val){
				$this->comment =  $val;
			}

					

			public function setDate($val){
				$this->date =  $val;
			}

					

			public function setUser_id($val){
				$this->user_id =  $val;
			}

					

			public function setPost_id($val){
				$this->post_id =  $val;
			}

					

			/********************** Delete ***********************/

			public function Delete(){

				if(!empty($this->id)){

					$sql = "DELETE FROM comments WHERE id = ".intval($this->id).";";

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

				$sql = 'UPDATE `comments` SET `id` = "'.$this->id.'", `comment` = "'.$this->comment.'", `date` = "'.$this->date.'", `user_id` = "'.$this->user_id.'", `post_id` = "'.$this->post_id.'" WHERE id = '.intval($this->id);

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

				$sql = 'INSERT INTO comments (`id`,`comment`,`date`,`user_id`,`post_id`) VALUES ("'.$this->id.'","'.$this->comment.'","'.$this->date.'","'.$this->user_id.'","'.$this->post_id.'")';

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

				$sql = 'SELECT * FROM comments';
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				foreach ($formatResult as $key => $data) {

					$tmpInstance = new commentsEntity();

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
						
					case $param == 'comment':
						$param = 'comment';
						break;
						
					case $param == 'date':
						$param = 'date';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'post_id':
						$param = 'post_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM comments WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$result =  $data->fetch(PDO::FETCH_OBJ);

				if(!empty($result)){
					$this->id = $result->id;
					$this->comment = $result->comment;
					$this->date = $result->date;
					$this->user_id = $result->user_id;
					$this->post_id = $result->post_id;
					
					return true;
				}
				else{
					DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
					return false;
				}
			}

					

			/********************** Find(id) ***********************/
			public function find($id){

				$sql = 'SELECT * FROM comments WHERE id = ' . $id;
				$result = TzSQL::getPDO()->prepare($sql);
				$result->execute();
				$formatResult = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($formatResult)){
					$this->id = $formatResult->id;
					$this->comment = $formatResult->comment;
					$this->date = $formatResult->date;
					$this->user_id = $formatResult->user_id;
					$this->post_id = $formatResult->post_id;
				
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
						
					case $param == 'comment':
						$param = 'comment';
						break;
						
					case $param == 'date':
						$param = 'date';
						break;
						
					case $param == 'user_id':
						$param = 'user_id';
						break;
						
					case $param == 'post_id':
						$param = 'post_id';
						break;
						
					default:
						DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
						return false;
				}

				$sql =  'SELECT * FROM comments WHERE '.$param.' = "'.$value.'"';
				$data = TzSQL::getPDO()->prepare($sql);
				$data->execute();
				$formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
				$entitiesArray = array();

				if(!empty($formatResult)){

					foreach ($formatResult as $key => $data) {

						$tmpInstance = new commentsEntity();

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
					