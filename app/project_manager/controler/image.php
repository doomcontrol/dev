<?php namespace controler;


class Image {
    
    
    public function __construct() {
        
    }
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Open Base Image
     * 
     * @category controler
     * @name controler.Image
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $serviceName
     * @param type $imageName
     */
    public function indexAction( $serviceName, $imageName ){
        
        $service = call_user_func_array( sprintf("\controler\upload\%s::Service", $serviceName), array());
        
        $imageRealPath = $service->Init()->getImagePath() . $imageName;
        
        \core\SessionCore::ValidateSession();
        
        \files\Open::Image( $imageRealPath );
    }
    
    
    
    /**
     * pathAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Open Resized Image
     * 
     * @category controler
     * @name controler.Image
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $serviceName
     * @param type $dir
     * @param type $imageName
     */
    public function pathAction( $serviceName,$dir, $imageName ){
        
        
        
        $service = call_user_func_array( sprintf("\controler\upload\%s::Service", $serviceName), array());
        
        $imageRealPath = $service->Init()->getImagePath() . $dir . DIRECTORY_SEPARATOR . $imageName;
        
        
        
        \files\Open::Image( $imageRealPath );
    }
    
    
}

