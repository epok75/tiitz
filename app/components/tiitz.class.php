<?php

class TiiTz {
    
    public $tzView;
    
    public $tzSQL;
    
    public $tzPlugin;
    
    public $tzValidator;
    
    
    public function __construct($tzView, $tzPlugin, $tzValidator, $tzSQL = null) {
        if(!($tzView instanceof TzView)) {
            tzErrorExtend::newError();
        }
        elseif(!($tzPlugin instanceof TzPlugin)) {
            
        }
        elseif(!($tzValidator instanceof TzValidator)) {
            
        }
        elseif(!is_null($tzSQL) && !($tzSQL instanceof TzPDO)){
            
        }

        $this->tzView = $tzView;
        $this->tzPlugin;
        $this->tzValidator;
        $this->tzSQL
        
        
    }
    
}