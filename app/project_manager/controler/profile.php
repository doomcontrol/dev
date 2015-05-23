<?php namespace controler;



class Profile {
    
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
     * @name controler.Profile
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function indexAction(){
        
        $data = [];
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('profile/index', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    
    
    
    
    
}