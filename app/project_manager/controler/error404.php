<?php namespace controler;



class Error404 {
    
    public $core;
    
   
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
       
    }
    
    
    public function indexAction( $message = "Undifined error message"){
        
        $data = [];
        $data['message'] = $message;
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('error/404', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    
    
    
}