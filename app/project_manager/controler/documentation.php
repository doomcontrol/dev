<?php namespace controler;


class Documentation {
    
    public $core;
    
    public function __construct() {
        global $core;
        
        $this->core = $core;
    }
    
    
    public function indexAction($str, $str2 = null){
        
        $strNamespace = "\controler\documentation\\" . $str; 
        
        $doc = new $strNamespace;
        
        $navigation = $this->core->load->view('documentation/navigation', array(), true);
        
        $doc->Navigation($navigation);
        
        return $doc->Page( $str2 );
       
        
    }
    
    
}

