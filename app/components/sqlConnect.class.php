<?php 

class mysqlConnect
{
	//static var
	private static $db;
	private static $user;
	private static $password;
	private static $host;
	private static $instance;

	private function __construct($host, $user, $password, $db){
		self::setHost($host);
		self::setUser($user);
		self::setPassword($password);
		self::setDb($db);
	}

	//get an instance of PDO
	public static function getPDO(){
		try{
		    $pdo = new PDO('mysql:host='.self::getHost().';dbname='.self::getDb(), self::getUser(), self::getPassword());
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		    return $pdo;
		}
		catch(PDOException $e){
		    exit($e->getMessage());
		}
	}


	//Singleton
	public static function getInstance($host, $user, $password, $db) {
		if (!is_null(self::$instance)) {
			return self::$instance;
		} else {
			// set the path for the view
			self::$instance = new mysqlConnect($host, $user, $password, $db);
			return self::$instance;
		}
	}

	//Setters
	public static function setDb($db){
		self::$db = $db;
	}

	public static function setUser($user){
		self::$user = $user;
	}

	public static function setPassword($password){
		self::$password = $password;	
	}

	public static function setHost($host){
		self::$host = $host;
	}

	//Getters
	public static function getDb(){
		return self::$db;
	}

	public static function getUser(){
		return self::$user;
	}

	public static function getPassword(){
		return self::$password;
	}

	public static function getHost(){
		return self::$host;
	}

}

//exemple utilisation

/*require_once('sqlConnect.class.php');

$mysqlConnect = mysqlConnect::getInstance('localhost','root','root','tiitzbdd');

$test = $mysqlConnect::getPDO();

$request = $test->prepare('SELECT * FROM test');
$request->execute();

$result = $request->fetchAll();

var_dump($result);*/
