<?php namespace lib;

class Output {
    
    
    public function __construct() {
        
    }
    
    
    public function json($array){
        
        header('Content-Type: application/json');
        
        $json = json_encode( $array );
        
        die( $json );
        
    }
    
    
}