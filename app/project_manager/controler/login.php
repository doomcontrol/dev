<?php namespace controler;

use controler\login\Submit_Login;

class Login {
    
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
        
        if($this->session->get_session('userSes')){
            redirect_url();
        }
        
        if(isSubmit()){
            $processSubmit      = new Submit_Login($this);
            $processSubmit->processesSubmit();
        }
        
        if($this->session->get_session('userSes')){
            redirect_url();
        }
        
        $data['status']         = $this->status;
        $data['message']        = $this->message;
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('login/form', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
        
    }
    
    
    
    
}