<?php namespace controler;



class Guitext {
    
     public $core;
    
    public function __construct() {
        global $core;
        $this->core = $core;
    }
    
    
    function indexAjax( $guiString ){
        
        $data = [];
        
        $data['strOutput'] = \gui_text( $guiString );
        
        
        $this->core->output->json($data);
        
    }
    
}
