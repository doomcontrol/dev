<?php namespace control;


class Load {
    
    
    /**
     * MATCH CONTROLER BY URL
     * @global type $core
     * @return type
     */
    public static function LoadByUrl(){
        
        global $core;
        
        $url = site_url(uri_url());
        $query = explode("&", $_SERVER['QUERY_STRING']);
        
        $url = self::match_route($url);
        
        $parseUrl = (parse_url($url));
        
        $path   = $parseUrl['path'];
        $scheme = $parseUrl['scheme'];
        $host   = $parseUrl['host'];
        
        if(strlen(trim($path)) > 0){
            
            $splitPath      = explode('/', ltrim($path,'/'));
            
            if(count($splitPath) > 1){
                
                // -- TRY TO FIND MATCH CONTROLER BY CLASS AND METHOD FROM URL
                $classObj   = $splitPath[0];
                $classFunct = $splitPath[1];
                
                $nmsp   = '\controler\\' . $classObj;
                $funct  = $classFunct.'Action';
                
                try{
                    $class= new $nmsp();
                }catch (\Exception $e){
                        $class= new \controler\Error404();
                        return $class->{'indexAction'}($e->getMessage());
                    }
                
                // -- IF METHOD EXISTS FROM URL
                if(method_exists($class,$funct)){
                    
                    $args = ( params_url( array($classObj,$classFunct), $url) );

                    $method = new \ReflectionMethod($class, $funct);
                    $num = $method->getNumberOfParameters();
                  
                    if($num <= count($args)){ return call_user_func_array(array($class, $funct), $args); }
                    else {
                        $class= new \controler\Error404();
                        return $class->{'indexAction'}(PAGE_NOT_FOUND_MESSAGE);
                    }
                } else { 
                    // -- METHOD NOT FOUND FROM URL - LOAD DEFAULT METHOD
                    try{
                        
                        $method = new \ReflectionMethod($class, 'indexAction');
                        $num = $method->getNumberOfParameters();
                        
                        if($num > 0){ throw new \Exception(PAGE_NOT_FOUND_MESSAGE); }
                        
                        return $class->{'indexAction'}(); 
                        
                        
                    } catch(\Exception $e) {
                        $class= new \controler\Error404();
                        return $class->{'indexAction'}($e->getMessage());
                    }
                }
                
            } else if(count($splitPath) == 1){
                
                $classObj   = $splitPath[0];
                $classFunct = "index";
                
                $nmsp   = '\controler\\' . $classObj;
                
                // -- TRY TO LOAD CONTROLER FORM URL NAME
                if(strlen(trim($classObj)) > 0){
                     
                        try{
                            $class= new $nmsp();
                            $funct = $classFunct . 'Action';
                            
                            $args = ( params_url( array($classObj,$classFunct), $url) );
                    
                            $method = new \ReflectionMethod($class, $funct);
                            $num = $method->getNumberOfParameters();
                            
                             if($num <= count($args)){
                            
                                return $class->{'indexAction'}();
                             } else {
                                // -- FUNCTION ARGUMENTS NOT MATCH PASED ARGS 
                                $class= new \controler\Error404();
                                return $class->{'indexAction'}(PAGE_NOT_FOUND_MESSAGE);
                             }
                        } catch(\Exception $e){
                            // -- CONTROLER FORM URL NOT FOUND
                            $class= new \controler\Error404();
                            return $class->{'indexAction'}($e->getMessage());
                        }
                    
                } else {
                    
                    if(! $core->isLoged() ){
                        // -- REDIRECT TO LOGIN
                        $class= new \controler\Login();
                        return $class->{'indexAction'}();
                    } else {
                        // -- REDIRECT TO DEFAULT CONTROLLER - DASHBOARD
                        $class= new \controler\Dashboard();
                        return $class->{'indexAction'}();
                    }
                }
            }
        }
    }
    
    /**
     * OVERIDE DEFAULT URL WITH ROUTE CONFIG
     * @param type $url
     * @return type
     */
    private static function match_route($url){
        
        $routeConfPath = APP . 'config' . DIRECTORY_SEPARATOR . 'route.inc.php';
        
        include_once $routeConfPath;
        
        if(isset($route)){
            
            foreach($route as $key=>$value){
                
                $pattern = "~$key~";
            
                preg_match($pattern, uri_url(), $matches);

                if(count($matches)){

                    foreach($matches as $k=>$v){ $value = str_replace('$'.$k, $v, $value); }
                    
                    $match = $value;
                    
                    $url = site_url($match);
                    break;
                }
            }
        }
        
        return $url;
    }
}
