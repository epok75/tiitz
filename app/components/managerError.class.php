<?php
class managerError {
	private static $file = "error.txt";
	private static $path = "/app/log/";
	private static $displayError = true;

	public function __construct (){
		// manage fatal error
		register_shutdown_function(array($this, 'callRegisteredShutdown'));
		// manage warning and other error not fatal
		set_error_handler(array($this, 'exception_handler'));
	}

	// callback for fatal error
	public function callRegisteredShutdown() {
		$error = error_get_last();
		if($error != null){
			// display error if user want to display them
	    	self::$displayError ? $this->getFatalError($error):null;
	    	// save error in log file		
			self::saveError($error);
		}	
	}

	public function exception_handler($errno, $errstr, $errfile, $errline) {
  		$store = '<div style="color: #B94A48;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding:0px;">
					<ul style="list-style-type:none;margin: 0px;padding:5px;">
					<h4 style="margin:5px 0px;border-bottom:1px solid #B94A48">Erreur durant l\'execution du script</h4>';
		$store .= '<li><strong>["Numéro erreur"]</strong> : '.$errno.'</li>';	
		$store .= '<li><strong>["Ligne"]</strong> : '.$errline.'</li>';	
		$store .= '<li><strong>["Fichier"]</strong> : '.$errfile.'</li>';
		$store .= '<li><strong>["Erreur"]</strong> : '.$errstr.'</li>';			
		$store .= '</ul></div>';
		print_r($store);	

		$error = array();
		$error = array($errno, $errstr, $errfile, $errline);
		// need to save in a log file
		// self::saveError();		
  	}

	// save error in log file app/log/error.txt
	private function saveError(array $error){
		$line = '*** ';
		foreach ($error as $key => $value) {
			$line .= $key .'=>'.$value.' *** ';
		}
		$line .= '\n';

		$fp = fopen(ROOT.self::$path.self::$file, "a+");
		fwrite($fp, $line);
		fclose($fp);
	}

	// display error in a graceful way :)
	public function getFatalError($error) {
		
		$store = '<div style="color: #B94A48;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding:0px;">
					<ul style="list-style-type:none;margin: 0px;padding:5px;">
					<h4 style="margin:5px 0px;border-bottom:1px solid #B94A48">Erreur fatale!</h4>';
		foreach ($error as $key => $value) {
			$store .= '<li><strong>["'.$key.'"]</strong> : '.$value.'</li>';		
		}
		$store .= '</ul></div>';
		print_r($store);
	}

	// display all error in the log file
	public function getAllError() {

	}

	// export error in a database
	public function exportError() {

	}

	// getter
	public function getFile() {
		return self::path;
	}
	public function getPath() {
		return self::file;
	}
	
}