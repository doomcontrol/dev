<?php namespace lib;

class Output {
    
    
    public function __construct() {
        
    }
    
    
    public function json($array, $die = true){
        
        if($die)
            header('Content-Type: application/json');
        
        $json = json_encode( $array );
        
        if($die)
            die( $json );
        
        if(! $die)
            return $json;
        
    }
    
    
}