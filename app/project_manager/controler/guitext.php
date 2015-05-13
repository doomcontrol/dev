<?php namespace controler;



class Guitext {
    
    public $core;
    
     
     
    public function __construct() {
        global $core;
        $this->core = $core;
    }
    
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Guitext
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $guiString
     */
    function indexAjax( $guiString ){
        
        $data = [];
        
        $data['strOutput'] = \gui_text( $guiString );
        
        
        $this->core->output->json($data);
        
    }
    
}
