<?php 

class tzPDO
{
	/** 
	 * @param string $host     Host of a database
	 * @param string $user     User to login to a database
	 * @param string $password Password to login to a database
	 * @param string $db 	   Database to establish connection with
	 **/

	private static $db;
	private static $user;
	private static $password;
	private static $host;
	private static $instance;

	private static $pdo;

	

	private function __construct($host, $user, $password, $db){
		self::setHost($host);
		self::setUser($user);
		self::setPassword($password);
		self::setDb($db);

		try {
		    $pdo = new PDO('mysql:host='.self::getHost().';dbname='.self::getDb(), self::getUser(), self::getPassword());
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		    self::$pdo = $pdo;
		}
		catch(PDOException $e){
			self::$instance == null;
			ErrorExtend::catchError($e);
		}
	}

	//get PDO
	public static function getPDO() {
		return self::$pdo;
	}


	/**
	* Singleton
	* get an instance of this class
	**/
	public static function getInstance($host, $user, $password, $db) {
		if (!is_null(self::$instance)) {
			return self::$instance;
		} 
		else {
			// set the path for the view
			self::$instance = new tzPDO($host, $user, $password, $db);
			return self::$instance;
		}
	}

	/**
	* Setter
	**/
	public static function setDb($db) {
		self::$db = $db;
	}

	public static function setUser($user) {
		self::$user = $user;
	}

	public static function setPassword($password) {
		self::$password = $password;	
	}

	public static function setHost($host) {
		self::$host = $host;
	}

	/**
	* Getter
	**/
	public static function getDb() {
		return self::$db;
	}

	public static function getUser() {
		return self::$user;
	}

	public static function getPassword() {
		return self::$password;
	}

	public static function getHost() {
		return self::$host;
	}


	/*
	* insert function
	* $table -> table of the database
	* $arr -> array or array in array like :
	*
	* $arr = array(
	*			array('test' => 'coucou', 'test2' => 'PLOP')
	* 		);
	*
	*
	* Where test/test2 are culumns and coucou/PLOP are values
	*
	*/
	public function insert($table, $arr) {
		$count = '';
		$arrlength  = count($arr);

		if (array_filter( $arr, 'is_array' )){
			// If multidimentional then recurse
			foreach ( $arr as $row ) {
				$results[] = $this->insert($table, $row);
			}
			return $results;
		}
		else{
			$query = "INSERT INTO {$table} (";

			foreach ( $arr as $key => $val ) {

				if($count < ($arrlength -1))
					$query .= "`".mysql_real_escape_string($key)."`,";
				else
					$query .= "`".mysql_real_escape_string($key)."`)";

				$count++;
			}

			//remise du compteur a 0
			$count = 0;

			$query .= " VALUES (";
			foreach ($arr as $key => $val)
			{
				if($count < ($arrlength -1))
					$query .= "'".mysql_real_escape_string($val)."',";
				else
					$query .= "'".mysql_real_escape_string($val)."')";

				$count++;
			}
		}

		try{
			$request = self::$pdo->prepare($query);
			$request->execute();
		}
		catch(PDOException $e){
			ErrorExtend::catchError($e, false);
		}
	}

	public function delete($table,$where){
		$query = "DELETE FROM ".$table." ";

		if (array_filter( $where, 'is_array' )){
			// If multidimentional then recurse
			foreach ( $where as $row ) {
				$results[] = $this->delete($table, $row);
			}
			return $results;
		}
		else{

			if(is_array($where)){

				$query .= " WHERE ";

				foreach ($where as $key => $value) {
					if(!is_int($key))
						$query.= "`".$key."` = '".$value."'";
					else
						$query .= " ".$value." ";
				}
			}
			else
				throw new Exception( 'Error: $where must be an array' );

			try{
				$request = self::$pdo->prepare($query);
				$request->execute();
			}
			catch(PDOException $e){
				ErrorExtend::catchError($e, false);
			}
		}
    }


    public function update($table, $arr, $where){
    	$count = '';
		$arrlength  = count($arr);

		$query = "UPDATE `".$table."` SET ";
		foreach ($arr as $key => $val) 
		{
			if($count < ($arrlength -1))
				$query .= "`".$key."` = '".$val."',";
			else
				$query .= "`".$key."` = '".$val."'";

			$count++;

		}
		
		if(is_array($where)){

				$query .= " WHERE ";

				foreach ($where as $key => $value) {
					if(!is_int($key))
						$query .= "`".$key."` = '".$value."'";
					else
						$query .= " ".$value." ";
				}
			}
		else
			throw new Exception( 'Error: where must be an array' );

		try{
			$request = self::$pdo->prepare($query);
			$request->execute();
		}
		catch(PDOException $e){
			ErrorExtend::catchError($e, false);
		}
    }

     public function read($table, $columns, $where){

    	$query = "SELECT ";

    	if(is_array($columns)){

    		$count = '';
    		$columsleght = count($columns);

    		foreach ($columns as $value) {
    			if($count < ($columsleght -1)){
    				$query .= '`'.$value."`, ";
    			}
    			else{
    				$query .= '`'.$value.'`';
    			}
    			$count++;
    		}
    	}
    	else{
    		$query .= $columns;
    	}

    	$query .= " FROM {$table} ";

		if(is_array($where)){

			$query .= " WHERE ";

			foreach ($where as $key => $value) {
				if(!is_int($key))
					$query .= "`".$key."` = '".$value."'";
				else
					$query .= " ".$value." ";
			}
		}
		else
			throw new Exception( 'Error: where must be an array' );

		try{
			$request = self::$pdo->prepare($query);
			$request->execute();
			$results = $request->fetchAll();

			return $results;
		}
		catch(PDOException $e){
			ErrorExtend::catchError($e, false);
		}
    }
}
