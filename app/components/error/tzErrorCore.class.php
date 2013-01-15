<?php
// Core Manager error
abstract class tzErrorCore {
	
	private static $file 				= "error.txt";
	private static $path 				= "/app/log/";
	// true : Display error / false : no display
	protected static $displayError 		= true;
	// Array of error
	protected static $currentError	 	= array();
	// Lenght of $currentError array : useful to add \n 
	// at the end of a line when we write the error in the log file
	protected static $lenghtArray 		= 5;
	// Array of all the error in the log file
	protected $allErrorFromLog			= array();
	
	
	private function __construct () {
		
	}

	/**
	 * the flow when an error is received : display and save
	 * @return void 
	 */
	protected static function displaySaveError() {
		// length of $currentError
		self::$lenghtArray = count(self::$currentError);
		// Display current error
		if (self::$displayError === true) {
			self::errorTpl(self::$currentError);
		}	
		// save in log file
	    self::saveInfile();
	}

	/**
	 * Template that is going to be displayed  in the screen
	 * @param  array  $error  Store type, line, message, date, trace, code
	 * @return void
	 */
	protected static function errorTpl(array $error) {

		$store = '<div style="color: #B94A48;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding:0px;">
					<ul style="list-style-type:none;margin: 0px;padding:5px;">
					<h4 style="margin:5px 0px;border-bottom:1px solid #B94A48">';
		(isset($error['type']) && ($error['type'] == 1 || $error['type'] == 64)) ? $store .= "Erreur Fatale" : $store .= "Erreur durant l'execution du script";
		$store .= '</h4>';
		// loop through error array
		foreach ($error as $key => $value) {
			if(is_array($value)) {
				self::errorTpl($value);
			} else {
				$store .= '<li><strong>["'.$key.'"]</strong> : '.$value.'</li>';
			}
		}
		
		$store .= '</ul></div>';

		print_r($store);
	}

	/**
	 * Save the error in the log file
	 * @return void
	 */
	protected static function saveInfile(){
		
		$line = '';
		$i = 1;
		foreach (self::$currentError as $key => $value) {
			if ($i < self::$lenghtArray) {
				$line .= $key .'=>'.$value."\t";
			} else {
				$line .= $key .'=>'.$value;
			}
			$i++;	
		}
		$line .= "\n";
		// write error in the log file
		@file_put_contents(ROOT.self::$path.self::$file, $line, FILE_APPEND);
	}
	
	/**
	 * format all error from the log file in a array
	 * @return void
	 */
	private function arrayFormatError() {
		$currentError = array();
		$handle = @fopen(ROOT.self::$path.self::$file, "rb");
		
		if ($handle) {
			while (false !== ($line = fgets($handle))) {
				// We need to remove \m from the array
				$line 		= str_replace("\n","|",$line);
				$newEntry 	= explode("\t", $line);
				$i = 1;
				var_dump($newEntry);
				foreach ($newEntry as $key => $value) {
					$current = explode('=>', $value);
					if($i < self::$lenghtArray) {
						$currentError[$current[0]] = $current[1];						
					} else {
						$currentError[$current[0]] = substr($current[1],0,-1);
					}
					$i++;
				}
				$i = 1;
				array_push($this -> allErrorFromLog, $currentError);				
				unset($currentError);
	      	}
    	}
	}

	/**
	 * getter
	 * @return [array] retrieve an array of log error
	 */
	public function exportArray() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}
		return $this -> allErrorFromLog;				
	}
	/**
	 * export last errors from log file
	 * @param  int $nb number of errors exported
	 * @return array     errors
	 */
	public function exportLastErrors($nb) {
		return null;
	}
	/**
	 * getter
	 * @return [array] retrieve all log errer in Json format
	 */
	public function exportJson() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}	
		return json_encode($this->allErrorFromLog);	
	}

	// getter
	private static function getCurrentError	() {
		return self::$currentError;
	}

	public static function getPath() {
		return self::$path;
	}

	public static function getFile(){
		return self::$file;
	}

	public function getDisplayError() {
		return self::$displayError;
	}
	
	// setter
	public function setDisplayError($isDisplay) {
		self::$displayError = $isDisplay;
	}
	
}