<?php

class TiiTz {
    
    public $tzView;
    
    public $tzSQL;
    
    public $tzPlugin;
    
    public $tzValidator;
    
    private static $tiitzVersion = '0.1';
    
    public function __construct(tzView $tzView, tzPlugin $tzPlugin, tzValidator $tzValidator, tzSQL $tzSQL = null) {
       

        $this->tzView = $tzView;
        $this->tzPlugin;
        $this->tzValidator;
        $this->tzSQL;

    }

    public static function getTiitzVersion() {
        return self::$tiitzVersion;
    }
   
}  
