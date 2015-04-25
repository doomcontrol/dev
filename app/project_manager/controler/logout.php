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
    
    
    public function indexAction(){
        
        $data = [];
        
        $this->session->delete_session('userSes');
        
        header('Location:' . site_url('login') );
        
    }
    
    
    
    
}