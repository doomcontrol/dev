<?php namespace controler;



class Error404 {
    
    public $core;
    
   
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
       
    }
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Error404
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $message
     * @return \stdClass
     */
    public function indexAction( $message = "Undifined error message"){
        
        $data = [];
        $data['message'] = $message;
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('error/404', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    
    
    
}