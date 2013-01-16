<?php

class TiiTz {
    
    public $tzRender;
        
    public $tzPlugin;
    
    public $tzValidator;
    
    private static $tiitzVersion = '0.1';
    
    public function __construct(tzRender $tzRender) {
        $this->tzRender = $tzRender;
        $this->tzPlugin = new tzPlugin;
        //$this->tzValidator = new tzValidator;
    }

    public static function getTiitzVersion() {
        return self::$tiitzVersion;
    }
   
}  
