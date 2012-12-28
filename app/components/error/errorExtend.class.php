<?php
class ErrorExtend  extends ErrorCore {

	public function __construct() {
		// manage fatal error
		register_shutdown_function(array($this, 'callRegisteredShutdown'));
		// manage warning and other error not fatal
		set_error_handler(array($this, 'exception_handler'));
	}

	public function callRegisteredShutdown() {
		$error = error_get_last();

		if($error != null){
			$error['date'] = date("Y-m-d H:i:s");
			self::$errorShutdown = $error;
			// length of array error for more scalabilities in the futur
			$this -> lenghtArray = count(self::$errorShutdown);
			// display error if user want to display them
			if ($this -> displayError === true) {
				$this -> errorTpl($error);
			}
			// save in log file
	    	$this -> saveInfile();
		}
	}

	public function exception_handler($errno, $errstr, $errfile, $errline) {
		
		$error = array(	'type' 		=> $errno, 
						'message' 	=> $errstr, 
						'file' 		=> $errfile, 
						'line' 		=> $errline,
						'date' 		=> date("Y-m-d H:i:s"));
		self::$errorShutdown = $error;
		$this -> count = count(self::$errorShutdown);
		// display error if user want to display them
		if ($this -> displayError === true) {
			$this -> errorTpl($error);
		}	
		// save in log file
	    $this -> saveInfile();
	}
	
	// getter
	

	// setter 
	
}