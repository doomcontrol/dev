<?php namespace process;


class Resolve {
    
    
    private static $subdomain = null;
    
    /**
     * RESOLVE PROCESS BY URL
     * @global type $core
     * @return type
     */
    public static function ResolveProcess(){
        
        global $core;
        
        $url = site_url();
        
        preg_match('/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/i', $url, $match);
        
        if(isset($match[1])){  self::$subdomain = $match[1]; }
        
        //TODO redirect to main site
        if( ! self::$subdomain ) { die(); }
        
        $processModel = $core->em->getRepository('models\entities\Core\Process' );
        
        $processData = $processModel->findBySubdomain( self::$subdomain );
        
        //TODO redirect to main site
        if(! $processData ) { die();}
        
        \processData::setProcessData( $processData );
        
    
    }
    
    
    public static function ResolveGuiText(){
        
        global $core;
        global $session;
        
        
        
    }
    
    
    
    
}