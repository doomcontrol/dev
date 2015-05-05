<?php 

global $guiText;

if(!function_exists('gui_text')){
    
    function gui_text($name){
        
        global $core;
        global $guiText;
        
        $arrayGui = array();
        
        
        if(!$guiText)
        foreach($core->guiText as $gt){
            
            $arrayGui[$gt['guiString']] = $gt['guiText'];
            
        } else {
            $arrayGui = $guiText;
        }
        
        if(!$guiText) $guiText = $arrayGui;
        
        if(isset($arrayGui[$name])) return $arrayGui[$name];
        
        return 'Translate  for (' . $name . ') does not exists';
        
    }
    
    
}