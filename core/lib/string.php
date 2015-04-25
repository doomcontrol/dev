<?php namespace lib;


class String {
    
    
    public function __construct() {
        
    }
    
    
    
    public function strip_alphanumeric($str){
        
        $string = preg_replace("/[^a-zA-Z0-9\s]/", "", $str);
        
        return $string;
        
    }
    
    
    
    
    
    
    
    
}

