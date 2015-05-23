<?php namespace controler;



class Assets {
    
    
    public $core, $session, $version;
    
    public $resource;
    
    
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
        
        \core\SessionCore::ValidateSession();
        
        $this->loadResourceConf();
    }

    
    
    /**
     * loadResourceConf
     * ----------------------------------------------
     * Load Assets Resources array files
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     */
    private function loadResourceConf(){
        
        $resourcePath = APP . 'config/resource.inc.php';
        
        $this->resource = [];
        
        if(file_exists($resourcePath))
        {
            $resource = [];
            
            include_once $resourcePath;
            
            $this->resource = $resource;
            
        } else {
            
            die('Assets resource config file not found!');
        }
    }
    
    
    
    /**
     * main_jsAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * 
     * Concat javascript on top in html with dinamic data
     */
    public function main_jsAction(){
        
        $this->writeBaseData();
        
        $key = md5('main.js?v='.VERSION); // key of cache file
        
        $this->loadFile($key, $this->resource['jstop'], 'Content-type: application/javascript', ';');
    }


    
    /**
     * jsAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * 
     * Concat javascript on bottom in html 
     */
    public function jsAction(){
        
        $key = md5('script.js?v='.VERSION); // key of cache file
        

        $this->customJS();
        
        if(self::$customKey != null)
            $key = self::$customKey;
            self::$customKey = null;
            
        
        
        $this->loadFile($key, $this->resource['js'], 'Content-type: application/javascript', ';');
    }

    
    
    /**
     * cssAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * 
     * Concat css files 
     */
    public function cssAction(){
        
        $key = md5('stylesheet.css?v='.VERSION); // key of cache file
        
        $this->customCss();
        
        if(self::$customKey != null)
            $key = self::$customKey;
            self::$customKey = null;
            
 
        $this->loadFile($key, $this->resource['css'],'Content-type: text/css');
    }

    
    
     /** loadFile
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * 
     * Load or generate cache file
     */
    private function loadFile($key, $filesArray, $header = null, $prechar = null){
        
        $cachePath = APP.'cache'.DIRECTORY_SEPARATOR.$key . (ASSETS_GZIP ? '.gz' : '');
        
        if( file_exists($cachePath) ){ 
            
            Header('Location: '.$_SERVER['PHP_SELF']);
            Exit(); //optional
            
        } else {
        
            $this->writeFile($key, $filesArray, $prechar, $header == "Content-type: text/css" ? 'CSS' : 'JS');
            
            Header('Location: '.$_SERVER['PHP_SELF']);
            Exit(); //optional
        }
        
        die();
    }
    
    private static $customKey = null;
    private function customCss(){
         
        if(isset($this->resource['custom']['css']))
        foreach($this->resource['custom']['css'] as $key=>$value){
        
            $pattern = "~$key~";  
            
                preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);
            
                if(isset($matches[0])){
                    self::$customKey = $matches[0] . '.css?v='.VERSION;
                    foreach($value as $css)
                    $this->resource['css'][] = $css;
                }
            
        }
        
    }
    
    private function customJS(){
        
        if(isset($this->resource['custom']['js']))
        foreach($this->resource['custom']['js'] as $key=>$value){
        
            $pattern = "~$key~";  
            
                preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);
            
                if(isset($matches[0])){
                    foreach($value as $js)
                    $this->resource['js'][] = $js;
                }
            
        }
        
    }

    
    
     /** writeBaseData
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * 
     * Write to js dinamic data
     */
    private function writeBaseData(){
        echo user_vars(\processData::getProcessData());
    }

    
    
    /**
     * writeFile
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * Write cache file on server
     * 
     * @param type $key
     * @param type $files
     * @param type $prechar
     */
    private function writeFile($key,$files, $prechar = '', $type=''){

        $str = '';
        
        foreach ($files as $file) {
            
            $string = $prechar . file_get_contents(ASSETS.$file);
            
            if(ASSETS_MINIFIED) $string = $this->slib_compress_script( $string, $type );
            
            $str .= $string;
        }
        
        
        $filePath = APP.'cache'.DIRECTORY_SEPARATOR.$key . (ASSETS_GZIP ? '.gz' : '');
        
        $cacheFile = fopen($filePath, "w") or die("Unable to open file! " . $filePath);
        
        if(ASSETS_GZIP) header("Content-Encoding: gzip");
        
        if(ASSETS_GZIP) $str = gzdeflate($str,9);
        
        fwrite($cacheFile, $str);
        
        fclose($cacheFile);
        
        header_remove("Content-Encoding: gzip");
    }

    
    
    
   

    
    
    
    /**
     * slib_compress_script
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Assets
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * ----------------------------------------------
     * Clean output string
     * 
     * @param type $buffer
     * @return type
     */
    private function slib_compress_script( $string, $type ) {
        
        $this->core->load->library('Minify');
        
        return $this->core->library->minify->exec( $string, $type );
        
    }
    
}