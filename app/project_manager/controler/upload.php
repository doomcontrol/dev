<?php namespace controler;



class Upload {
    
    public $core;
    
    public $session;
    
   
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
    }
    
    
    public function BoxViewAjax(){
        
        $response = new \stdClass();
        $response->strOutput = \components\upload\box\Component::Display();
            
        $this->core->output->json($response);
        
    }
    
    
    
}