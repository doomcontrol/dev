<?php namespace lib;


class Load {
    
    
    public function __construct() {
        
    }
    
    public function view($path, $data, $return_string = false){
        
        global $core; 
        
        global $session;
        
        if(file_exists(APP.'views'.DIRECTORY_SEPARATOR .$path. '_view.php')){
            
             if(is_array($data)) foreach ($data as $key=>$value)  $$key = $value;
            
             ob_start();  include APP.'views'.DIRECTORY_SEPARATOR .$path. '_view.php';  $strView = (ob_get_clean());
             
             if($return_string) return $strView; else echo $strView;
        } else {
            
             $errorTitle = "View ($path) not found";
             $vp = APP.'views'.DIRECTORY_SEPARATOR .$path. '_view.php';
             $errorMessage = "Try to find in:<em>$vp</em>";
       
             \exception_message(2, $errorTitle, $errorMessage, __CLASS__, __FUNCTION__, __FILE__ );
        }
    }
    
    
    public function helper($name){
        
        if(is_array($name)){
            foreach($name as $n){
                $this->helper($n);
            }
        } else {
            
            $found = false;
            
            if(file_exists(CORE.'helpers'.DIRECTORY_SEPARATOR. strtolower($name).'_helper.inc.php')){
                include_once CORE.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php';
                $found = true;
            } 
            
            if(file_exists(APP.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php')){
                include_once APP.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php';
                $found = true;
            }
            
            if(! $found){
                \exception_message(3, "Helper ($name) not found", null, __CLASS__, __FUNCTION__, __FILE__ );
            }
            
        }
        
    }
    
    
    
    public function library($name){
        
        
        global $core;
        
        $name = "/lib/" . $name;
        
        $e = explode("/", $name);
        
        $realName = strtolower( end($e) );
        
        $nmsp = str_replace("/", "\\", $name);
        
        $core->library->{$realName} = new $nmsp;
        
        
    }
    
    

}
