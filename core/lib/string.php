<?php namespace lib;


class String {
    
    
    public function __construct() {
        
    }
    
    
    
    public function strip_alphanumeric($str, $custom=''){
        
        $string = preg_replace("/[^a-zA-Z0-9\s$custom]/", "", $str);
        
        return $string;
        
    }
    
    
    
    
    
    
    
    
}

