<?php
class ErrorExtend  extends ErrorCore {

	private $errorReport = 0;

	/**
	 * launch php function for managing error
	 * @param integer $errorReport manage visibility of php error
	 */
	public function __construct($errorReport = 0) {
		// error_repport : default to none
		$this -> errorReport = $errorReport;
		$this -> errorReporting();
		// manage fatal error
		register_shutdown_function(array($this, 'callRegisteredShutdown'));
		// manage warning and other error not fatal
		set_error_handler(array($this, 'exception_handler'));
	}

	/**
	 * manage fatal error
	 * @return void
	 */
	public function callRegisteredShutdown() {
		// get last error
		$error = error_get_last();
		
		if($error != null){
			// add date to the array error
			$error['date'] = date("Y-m-d H:i:s");
			// store it in an array to be reusable
			self::$currentError = $error;
			// load the workflow method
			self::displaySaveError();
		}
	}

	/**
	 * manage warning error
	 * @param  [type] $errno   error number
	 * @param  [type] $errstr  error message
	 * @param  [type] $errfile error file
	 * @param  [type] $errline error line
	 * @return void
	 */
	public function exception_handler($errno, $errstr, $errfile, $errline) {
		// construct an array of error
		$error = array(	'type' 		=> $errno, 
						'message' 	=> $errstr, 
						'file' 		=> $errfile, 
						'line' 		=> $errline,
						'date' 		=> date("Y-m-d H:i:s"));
		// store it in an array to be reusable
		self::$currentError = $error;
		// load the workflow method
		self::displaySaveError();
	}
	
	/**
	 * method static use to catch error thanks to try catch
	 * @param  Object $e   [description]
	 * @param  boolean $die [description]
	 * @return void
	 */
	public static function catchError($e, $die = false) {
		if (is_object($e)) {
			// construct an array of error
			$error = array(
					'type' 		=> $e->getCode(), 
					'message' 	=> $e->getMessage(), 
					'file' 		=> $e->getFile(), 
					'line' 		=> $e->getLine(),
					//'trace'		=> $e->getTraceAsString(),
					'date' 		=> date("Y-m-d H:i:s")
			);
			// store it in an array to be reusable
			self::$currentError = $error;
		} 		
		
		// load the workflow method
		self::displaySaveError();
		if ($die === true) {
			die();
		}
	}

	/**
	 * php function error_report()
	 * @return [type] [description]
	 */
	private function errorReporting() {
		switch ($this -> errorReport) {
			case 0 :
				$report = 0;
				break;
			
			case 1 :
				$report = E_ERROR | E_WARNING | E_PARSE;
				break;

			case 2 :
				$report = E_ERROR | E_WARNING | E_PARSE | E_NOTICE;
				break;

			case 3 :
				$report = E_ALL;
				break;

			default:
				$report = 0;
				break;
		}
		return error_reporting($report);
	}

	// getter
	public function getErrorRepport() {
		return $this->errorReport;
	}

	// setter
	public function setErrorRepport($errorRepport) {
		$this -> errorRepport = $errorRepport;
	}
	
}