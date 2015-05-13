<?php namespace resource_manager;

class Concate_Files {
    
    static $session;
    static $version;
    static $resource;
    
    public static function Init(){
        
        global $session;
        self::$session = $session;
        
        include_once CORE . 'helpers' . DIRECTORY_SEPARATOR . 'form_helper.inc.php';
        include_once CORE . 'helpers' . DIRECTORY_SEPARATOR . 'user_helper.inc.php';
        include_once CORE . 'helpers' . DIRECTORY_SEPARATOR . 'url_helper.inc.php';
    }
    
    
    /**
     * Stylesheet
     * -----------------------------------
     * 
     * @return type
     * @version 1.0
     */
    public static function Stylesheet(){

        if(stripos($_SERVER['REQUEST_URI'], 'stylesheet.css') == false) return;
        
        if(!ASSETS_CONCAT) return;
        
        $key = md5('stylesheet.css?v='.VERSION); // key of cache file
        
        self::loadFile($key,'Content-type: text/css');
    }
    
    
    /**
     * MainJS
     * -------------------------------------
     * 
     * @return type
     * @version 1.0
     */
    public static function MainJS(){
        
        if(stripos($_SERVER['REQUEST_URI'], 'main.js') == false) return;
        
        if(!ASSETS_CONCAT) return;
        
        $key = md5('main.js?v='.VERSION);
            
        self::loadFile($key,'Content-type: application/javascript', user_vars() );
    }
    
    
    
    /**
     * JS
     * -------------------------------------------
     * 
     * @return type
     * @version 1.0
     */
    public static function JS(){
        
        if(stripos($_SERVER['REQUEST_URI'], 'script.js') == false) return;
        if(!ASSETS_CONCAT) return;
        
        $key = md5('script.js?v='.VERSION);

        self::loadFile($key,'Content-type: application/javascript');
    }
    
    
    
    /**
     * loadFile
     * -------------------------------------------
     * 
     * @param type $key
     * @param type $header
     * @param type $prestring
     * @version 1.0
     */
    static function loadFile($key, $header, $prestring = null){
        
        $string = "";
        
        $cachePath = APP.'cache'.DIRECTORY_SEPARATOR.$key . (ASSETS_GZIP ? '.gz' : '');
        
        if(file_exists($cachePath)){
            
            
            if($prestring) echo $prestring;
            
            if(ASSETS_GZIP)
                if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
            else 
                ob_start();
            
            include $cachePath;
            
            $string = ob_get_clean();
            
            if(ASSETS_GZIP){ $string = gzinflate($string); }
            
            header($header);
            
            headerNeverExpire();
            
            die($string);
        } 
        
        
    }
    
    
    
    /**
     * url_origin
     * -------------------------------------------
     * 
     * @param type $use_forwarded_host
     * @return type
     * @version 1.0
     */
    static function url_origin($use_forwarded_host=false)
    {
        $s          = $_SERVER;
        $ssl        = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
        $sp         = strtolower($s['SERVER_PROTOCOL']);
        $protocol   = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port       = $s['SERVER_PORT'];
        $port       = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host       = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host       = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        
        return $protocol . '://' . $host . '/';
    }
    
    
    
    
    
    /**
     * LoadResource
     * -------------------------------------------
     * 
     * @version 1.0
     * @return type
     * @version 1.0
     */
    private static function LoadResource(){
        if(self::$resource) return;
        $resource = [];
        include_once APP . 'config' . DIRECTORY_SEPARATOR . 'resource.inc.php';
        self::$resource = $resource;
    }
    
    
    
    /**
     * DisplayCSS
     * -------------------------------------------
     * 
     * @version 1.0
     * @return string
     */
    static function DisplayCSS(){
        
        if(ASSETS_CONCAT){
            
            return '<link type="text/css" rel="stylesheet" href="'.site_url('stylesheet.css?v='.VERSION).'" /> ' . "\n\t";
        } else {
            
            $String = '';  self::LoadResource();
            
            foreach(self::$resource['css'] as $file) $String.= '<link type="text/css" rel="stylesheet" href="'.assets_url($file.'?v='.VERSION).'" /> ' . "\n\t";
            
            return $String;
        }
    }
    
    
    /**
     * DisplayMainJS
     * -----------------------------------------
     * 
     * @return string
     * @version 1.0
     */
    static function DisplayMainJS(){
        
        if(ASSETS_CONCAT){
            
            return  '<script src="'.site_url('main.js?v=').VERSION.'"></script>' . "\n\t"; 
        } else {
            
            $String = ''; self::LoadResource();
            
            foreach(self::$resource['jstop'] as $file) $String.= '<script src="'.assets_url($file.'?v=').VERSION.'"></script>' . "\n\t"; 
            
            return $String;
        }
    }
    
    
    
    /**
     * DisplayJS
     * -----------------------------------------
     * 
     * @return string
     * @version 1.0
     */
    static function DisplayJS(){
        
        if(ASSETS_CONCAT){
            
            return  '<script src="'.site_url('script.js?v=').VERSION.'"></script>' . "\n\t"; 
        } else {
            
            $String = '';  self::LoadResource();
            
            foreach(self::$resource['js'] as $file) $String.= '<script src="'.assets_url($file.'?v=').VERSION.'"></script>' . "\n\t"; 

            return $String;
        }
    }
}

/**
 * headerNeverExpire
 */
function headerNeverExpire(){
	header("Expires: " . gmdatestr(time() + 315360000));
	header("Cache-Control: max-age=315360000");
}


/**
 * gmdatestr
 * 
 * @param type $time
 * @return type
 */
function gmdatestr($time = null) {
	if (is_null($time)) $time = time();
	return gmdate("D, d M Y H:i:s", $time) . " GMT";
}
