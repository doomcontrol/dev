<?php namespace controler\documentation;

class Index {
 
    
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
        
        if($str == 'null') $str = 'index';

        $data = [];
        
        $data['navigation'] = $this->navigation;
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('documentation'.($str ? '/'.$str : ''), $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
        
    }
    
    
}
