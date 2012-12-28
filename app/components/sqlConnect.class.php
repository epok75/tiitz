<?php 

class mysqlConnect
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

		if ( !empty( $host ) ) {
			self::setHost($host);
		} elseif ( empty( $this->host ) ) {
			throw new Exception( '<strong>Error:</strong> No host defined for SQL connection' );
		}

		if ( !empty( $user ) ) {
			self::setUser($user);
		} elseif ( empty( $this->user ) ) {
			throw new Exception( '<strong>Error:</strong> No user defined for SQL connection' );
		}

		if ( !empty( $password ) ) {
			self::setPassword($password);
		} elseif ( empty( $this->password ) ) {
			throw new Exception( '<strong>Error:</strong> No password defined for SQL connection' );
		}

		if ( !empty( $db ) ) {
			self::setDb($db);
		} elseif ( empty( $this->db ) ) {
			throw new Exception( '<strong>Error:</strong> No database defined for SQL connection' );
		}
	}

	//get PDO
	public static function getPDO() {
		try{
		    $pdo = new PDO('mysql:host='.self::getHost().';dbname='.self::getDb(), self::getUser(), self::getPassword());
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		    self::$pdo = $pdo;
		}
		catch(PDOException $e){
		    exit($e->getMessage());
		}
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
			self::$instance = new mysqlConnect($host, $user, $password, $db);
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
			exit($e->getMessage());
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
				exit($e->getMessage());
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
			exit($e->getMessage());
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
			exit($e->getMessage());
		}
    }

}


//exemple utilisation

/*
require_once('sql.class.php');

$mysqlConnect = mysqlConnect::getInstance('localhost','root','root','tiitzbdd');

$test = $mysqlConnect::getPDO();

$where = array('test' => 'test', 'and' , 'test2' => 'plopance');

$insert =array( array('test2' => 'plopance', 'test'=> 'test'),
                array('test2' => 'plopance', 'test'=> 'test')          
              );

$columns = array("test","test2");


//$mysqlConnect->insert('test', $insert); 			//insert(nom de table, array(array('colonne'=>'valeur')),array('colonne'=>'valeur'))
//$mysqlConnect->delete('test', $where);  			//insert(nom de table, array('colonne'=>'valeur'))
//$mysqlConnect->update('test', $insert, $where);   //insert(nom de table, array('colonne'=>'valeur'), array('colonne'=>'valeur'))
//var_dump($mysqlConnect->read('test', $columns, $where));
*/
