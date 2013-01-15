<?php

class TiiTz {
    
    public $tzRender;
    
    public $tzSQL;
    
    public $tzPlugin;
    
    public $tzValidator;
    
    private static $tiitzVersion = '0.1';
    
    public function __construct(tzRender $tzRender, $tzPDO = null) {

        $this->tzSQL = $tzPDO;
        $this->tzRender = $tzRender;
        $this->tzPlugin = new tzPlugin;
        //$this->tzValidator = new tzValidator;
        $this->tzSQL;

    }

    public static function getTiitzVersion() {
        return self::$tiitzVersion;
    }
   
}  
