<?php namespace lib;


class Zebra {
    
    public function __construct() {
    
        require 'zebra/Zebra_Image.php';
        
    }
    
    
    /**
     * Init
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale Zebra library 
     * 
     * @category upload files
     * @name lib.Zebra
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \Zebra_Image
     */
    public function Init(){
        
        return new \Zebra_Image();
        
    }
    
}
