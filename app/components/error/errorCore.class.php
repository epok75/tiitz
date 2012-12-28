<?php
// Core Manager error
abstract class ErrorCore {
	
	// Array of error
	protected static $errorShutdown 	= array();
	protected $lenghtArray 				= 5;
	// true : Display error / false : no display
	protected $displayError 			= true;
	// Array of all the error in the log file
	protected $storeError				= array();
	// where the file is
	private static $file 				= "error.txt";
	private static $path 				= "/app/log/";

	private function __construct () {
		
	}

	protected function errorTpl(array $error) {

		$store = '<div style="color: #B94A48;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding:0px;">
					<ul style="list-style-type:none;margin: 0px;padding:5px;">
					<h4 style="margin:5px 0px;border-bottom:1px solid #B94A48">';
		(isset($error['type']) && $error['type'] == 1) ? $store .= "Erreur Fatale" : $store .= "Erreur durant l'execution du script";
		$store .= '</h4>';
		// loop through error array
		foreach ($error as $key => $value) {
			$store .= '<li><strong>["'.$key.'"]</strong> : '.$value.'</li>';
		}
		
		$store .= '</ul></div>';

		print_r($store);
	}

	protected function saveInfile(){
		
		$line = '';
		$i = 1;
		foreach (self::$errorShutdown as $key => $value) {
			if ($i < $this -> lenghtArray) {
				$line .= $key .'=>'.$value."\t";
			} else {
				$line .= $key .'=>'.$value;
			}
			$i++;	
		}
		$line .= "\n";

		file_put_contents(ROOT.self::$path.self::$file, $line, FILE_APPEND | LOCK_EX);
	}

	protected function saveInDb(array $database) {

	}

	private function arrayFormatError() {
		$currentError = array();
		$handle = @fopen(ROOT.self::$path.self::$file, "rb");
		
		if ($handle) {
			while (false !== ($line = fgets($handle))) {
				// We need to remove \m from the array
				$line 		= str_replace("\n","|",$line);
				$newEntry 	= explode("\t", $line);
				$i = 1;
				foreach ($newEntry as $key => $value) {
					$current = explode('=>', $value);
					if($i < $this -> lenghtArray) {
						$currentError[$current[0]] = $current[1];						
					} else {
						$currentError[$current[0]] = substr($current[1],0,-1);
					}
					$i++;
				}
				$i = 1;
				array_push($this -> storeError, $currentError);				
				unset($currentError);
	      	}
    	}
	}

	// export data in differents formats
	public function exportArray() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}
		return $this -> storeError;				
	}

	public function exportJson() {
		if(file_exists(ROOT.self::$path.self::$file)){
			$this -> arrayFormatError();
		}	
		return json_encode($this->storeError);
	}

	// getter
	private static function getErrorShutdown() {
		return self::$errorShutdown;
	}

	public static function getPath() {
		return self::$path;
	}

	public static function getFile(){
		return self::$file;
	}

	public function getDisplayError() {
		return $this -> displayError;
	}
	
	// setter
	public function setDisplayError($isDisplay) {
		$this -> displayError = $isDisplay;
	}
	
}