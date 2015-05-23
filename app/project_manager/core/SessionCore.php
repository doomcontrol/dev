<?php namespace core;


class SessionCore {
    
    
    
    public static function ValidateSession(){
        
        
        global $session;
        
        $userData = $session->get_session('userSes');
        
        if(! $userData ){
            
            \redirect_url('login');
            
        } else {
            $session->set_session('userSes',$userData);
        }
        
    }
    
    
    
    
    
    
    
}
