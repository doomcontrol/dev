<?php 


class core {
    
    public $doctrine;
    
    public $em;
    
    public $user;
    
    public $laod;
    
    public $output;
    
    public $library ;

    
    public function __construct() {
        
        $this->library = new \stdClass();
        
    }
    
    
    public function Init(){
        
        include_once CORE . 'helpers/doctrine_helper.inc.php';
        include_once CORE . 'helpers/url_helper.inc.php';
        
        $this->doctrine = new lib\Doctrine();
        $this->load = new \lib\Load();
        $this->output = new \lib\Output();
        
        $this->predefine_helpers();
        
        
        
        \process\Resolve::ResolveProcess();
        
    }
    
    public function predefine_helpers(){
        
        $this->load->helper(array('Form','URL', 'Doctrine'));
        
    }
    
    
    public function isLoged(){
        
        global $session;
        
        $this->user = $session->get_session('userSes');
        
        return $this->user;
        
    }
    
    
    public function Build(){
        
        $processData = \processData::getProcessData();
        
        $processId = $processData->getID();
        
        global $session;
        
        $this->user = $session->get_session('userSes');
        
        
        $data = \control\Load::LoadByUrl();
        
        foreach($data as $key=>$value){
            $$key = $value;
        }
        
        
        if(! $this->user)
            include APP . 'template' . DIRECTORY_SEPARATOR . 'login' . DIRECTORY_SEPARATOR . 'html_tmpl.phtml';
        else
            include APP . 'template' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'html_tmpl.phtml';
        
    }
    
    
    
    
    
}

