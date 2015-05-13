<?php namespace controler;



class Logout {
    
    public $core;
    
    public $session;
    
    
    
    public function __construct() {
        global $core;
        $this->core = $core;
        global $session;
        $this->session = $session;
    }
    
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Logout
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     */
    public function indexAction(){
        
        $data = [];
        
        $this->session->delete_session('userSes');
        
        header('Location:' . site_url('login') );
        
    }
    
    
    
    
}