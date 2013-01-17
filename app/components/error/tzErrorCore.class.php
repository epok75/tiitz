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

		if ($error['type'] == 1 || $error['type'] == 64) {
			$store = '<div class="tiitz-error-popup" style="color: #B94A48;background-color: #F2DEDE;border-color: #EED3D7;margin: 0px; padding:0px;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;">';
		} else {
			$store = '<div class="tiitz-error-popup" style="color: #C09853;background-color: #FCF8E3;border : 1px solid #FBEED5;margin: 0px; padding:0px;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;">';
		}

		$store .= '	<a class="close" data-dismiss="alert" href="#">&times;</a>
					<ul style="list-style-type:none;margin: 0px;padding:5px;">
					<h4 style="margin:5px 0px;font-size:16px">';
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
		self::highlight_linesfile($error['file'], $error['line'], $return = false);
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
			/*	if (self::$currentError['message']) {
					$line .= $key .'=>'.str_replace("\n"," ",$value)."\t";
				} else {
					$line .= $key .'=>'.$value."\t";
				}
				*/
				$line .= $key .'=>'.str_replace("\n"," ",$value)."\t";
			} else {
				$line .= $key .'=>'.str_replace("\n"," ",$value);
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


	public static function highlight_linesfile($filename, $lineError, $return = false) { 
		
	    if(file_exists($filename) && is_file($filename)) { 

	        $output = '<pre><code><span style="color: '.ini_get('highlight.html').';">'; 
	        
	        $code = substr(highlight_file($filename, true), 36, -15); 
	        $start_line = 1; 
	        $lines = explode('<br />', $code); 
	        
	        $chr_lines = count($lines); 
	        $chr_lines = strlen($chr_lines); 
	        
	        foreach($lines as $line) 
	        {   
	        	$nline = str_pad($start_line, $chr_lines, ' ', STR_PAD_LEFT); 
		        if($lineError == $start_line) {
		        	$output .= '<span style="color: #f1f1f1; background-color: red;" class="php_highlight_line">'.$nline. ': '.$line."</span>\n"; 
		        }  else {
		        	$output .= '<span style="color: grey;" class="php_highlight_line">'.$nline. ':</span> '.$line."\n"; 
		        }  
		        $start_line ++; 
		    } 
	        
	        $output .= '</span></code></pre>'; 
	        
	        if($return === true) {
	        	return $return; 
	        }
	        else {
	        	print $output;
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