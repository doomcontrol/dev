<?php namespace controler;



class Dashboard {
    
    public $core;
    
    public $session;
    
    public $message;
    
    public $status;
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
    }
    
    
    public function indexAction(){
        
        $data = [];
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('dashboard/index', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    public function mysetupAction($configId,$type){
        
        $data = [];
        
        $data['configId']   = $configId;
        $data['type']       = $type;
        
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('dashboard/mysetup', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    
    
    
}