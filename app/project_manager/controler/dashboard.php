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
        
        \core\SessionCore::ValidateSession();
    }
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Dashboard
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function indexAction(){
        
        $data = [];
        
        $objOutput              = new \stdClass();
        
        //print_r(reset($userData = $this->session->get_session('userSes')->getPrivilegies())); die();
        
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