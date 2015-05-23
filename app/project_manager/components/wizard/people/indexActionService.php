<?php namespace components\wizard\people;

class indexActionService {
    
    
    static function Display( $core ){
        
        $data = [];
        
        
        
        $view = $core->load->view('components/wizard/people/index_action', $data, true);
        
        
        return $view;
        
    }
    
    
}

