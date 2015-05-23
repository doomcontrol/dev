<?php namespace components\wizard;


class Component {
    
    private static $core;
    
    private static $display;
    
    public static function Display(){
        
        if(! WIZARD_ACTIVE) return;
        
        global $core;
        
        self::$core = $core;
        
        switch ($core->registerControler){
            
            case "People.indexAction":
                self::$display = \components\wizard\people\indexActionService::Display( $core );
            break;
            
        }
        
        
        return self::$display;
        
    }
    
    
    
    
}
