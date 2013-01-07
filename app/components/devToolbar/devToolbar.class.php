<?php
class DevToolbar {

	private static $environnement;
	private static $route = array();
	private $phpVersion;

	private function __construct(){

	}

	public static function toolbar ($environnement, $route) {
		self::$environnement = $environnement;
		self::$route = $route;
		if(self::$environnement === 'dev') {
			return require_once ROOT.'/app/components/devToolbar/controllers/mainController.php';
		} else {
			return false;
		}
	}
	public static function getToolbar() {
		
	}

	public static function setPhpVersion() {
		$this -> phpVersion = phpversion();
	}

	public static function getPhpVersion () {
		return $this -> phpVersion;
	}

	public static function getRoute () {
		return self::$route;
	}
}