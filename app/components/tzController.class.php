<?php

class tzController {

	public $tiitzData;  
    public $tzPlugin;
    public $tzValidator;
    private static $tiitzVersion = '0.1';
    
    public function __construct(array $tzData) {
        $this->tiitzData = $tzData;
        //$this->tzValidator = new tzValidator;
    }

    public static function getTiitzVersion() {
        return self::$tiitzVersion;
    }

    // Made by Tiitz team for Mister Gael Coat, special dedicasse !
    protected static function callController(string $controller, string $action) {
    	if (is_file(ROOT.$this->$tiitzData['route']['dirPath'].$controller.'.php'))	 {
    		require_once ROOT.$this>$tiitzData['route']['dirPath'].$controller.'.php';
    		
            $newController = new $controller($this->tiitzData);
            $newController->$action();
    	}
    }

}