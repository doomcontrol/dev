<?php namespace controler\documentation;

class Library {
 
    
    public $core;
    
    private $navigation;
    
    public function __construct() {
        global $core;
        
        $this->core = $core;
    }
    
    
    public function Navigation( $str ){
        $this->navigation = $str;
    }
    
    
    public function Page( $str ){
        
        $data = [];
        
        $data['navigation'] = $this->navigation;
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('documentation/library'.($str ? '/'.$str : ''), $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
        
    }
    
    
}
