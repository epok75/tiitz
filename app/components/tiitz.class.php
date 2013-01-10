<?php

class TiiTz {
    
    public $tzView;
    
    public $tzSQL;
    
    public $tzPlugin;
    
    public $tzValidator;
    
    
    public function __construct($tzView, $tzPlugin, $tzValidator, $tzError, $tzSQL = null) {
        if(!($tzView instanceof TzView)) {
            
        }
        elseif(!($tzPlugin instanceof TzPlugin)) {
            
        }
        elseif(!($tzValidator instanceof TzValidator)) {
            
        }
        elseif(!($tzError instanceof TzError)) {
            
        }
        elseif(!is_null($tzSQL) && !($tzSQL instanceof TzPDO)){
            
        }
        
        
    }
    
}