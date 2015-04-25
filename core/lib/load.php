<?php namespace lib;


class Load {
    
    
    public function __construct() {
        
    }
    
    public function view($path, $data, $return_string = false){
        
        
        if(file_exists(APP.'views'.DIRECTORY_SEPARATOR .$path. '_view.php')){
            
             if(is_array($data)) foreach ($data as $key=>$value)  $$key = $value;
            
             ob_start();  include APP.'views'.DIRECTORY_SEPARATOR .$path. '_view.php';  $strView = (ob_get_clean());
             
             if($return_string) return $strView; else echo $strView;
        }
    }
    
    
    public function helper($name){
        
        if(is_array($name)){
            foreach($name as $n){
                $this->helper($n);
            }
        } else {
            
            if(file_exists(CORE.'helpers'.DIRECTORY_SEPARATOR. strtolower($name).'_helper.inc.php')){
                include_once CORE.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php';
            }
            
            if(file_exists(APP.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php')){
                include_once APP.'helpers'.DIRECTORY_SEPARATOR.strtolower($name).'_helper.inc.php';
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
