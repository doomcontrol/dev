<?php namespace controler;



class Assets {
    
    public $core, $session, $version;
    
    public $resource;
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
        
        
        
        $this->loadResourceConf();
    }
    
    
    
    
    
    
    /**
     * loadResourceConf
     * ----------------------------------------------
     * 
     * Load Assets Resources array files
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
     * ----------------------------------------------
     * 
     * Concat javascript on bottom in html 
     */
    public function jsAction(){
        
        $key = md5('script.js?v='.VERSION); // key of cache file
        
        $this->loadFile($key, $this->resource['js'], 'Content-type: application/javascript', ';');
    }
    
    
    
    
    
    
    
    /**
     * cssAction
     * ----------------------------------------------
     * 
     * Concat css files 
     */
    public function cssAction(){
        
        $key = md5('stylesheet.css?v='.VERSION); // key of cache file
        
        $this->loadFile($key, $this->resource['css'],'Content-type: text/css');
    }
    
    
    
    
    
    
    
    /**
     * loadFile
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
        
            $this->writeFile($key, $filesArray, $prechar);
            
            Header('Location: '.$_SERVER['PHP_SELF']);
            Exit(); //optional
        }
        
        die();
    }
    
    
    
    
    
    
    /**
     * writeBaseData
     * -------------------------------------------
     * 
     * Write to js dinamic data
     */
    private function writeBaseData(){
        
        $procesData = \processData::getProcessData();
        $userSes = $this->session->get_session('userSes');
        
        $string = '';
        $string.= 'var app_url = \''.site_url().'\';';
        $string.= 'var processId = \''.$procesData->getID().'\';';
        $string.= 'var sessionId = '.$userSes->getID().';';
        
        echo $string;
    }
    
    
    
    
    
    /**
     * writeFile
     * ----------------------------------------------------------
     * 
     * Write cache file on server
     * 
     * @param type $key
     * @param type $files
     * @param type $prechar
     */
    private function writeFile($key,$files, $prechar = ''){
        
        
        
        $str = '';
        
        foreach ($files as $file) {
            
            $string = $prechar . file_get_contents(ASSETS.$file);
            
            if(ASSETS_MINIFIED) $string = $this->slib_compress_script( $this->stripPhpComments($string));
            
            
            $str .= $string;
        }
        
        
        $filePath = APP.'cache'.DIRECTORY_SEPARATOR.$key . (ASSETS_GZIP ? '.gz' : '');
        $cacheFile = fopen($filePath, "w") or die("Unable to open file! " . $filePath);
        
        if(ASSETS_GZIP) header("Content-Encoding: gzip");
        
        if(ASSETS_GZIP){
                
            $str = gzdeflate($str,9);
        }
            
        
        fwrite($cacheFile, $str);
        
        fclose($cacheFile);
        
        header_remove("Content-Encoding: gzip");
    }
    
    
    
    
    
    /**
     * stripPhpComments
     * ----------------------------------------------------
     * 
     * Clean output string
     * 
     * @param type $code
     * @return type
     */
    private function stripPhpComments($code)
    {
        $tokens = token_get_all($code);
        $strippedCode = '';

        while($token = array_shift($tokens)) {        
            if((is_array($token) && token_name($token[0]) !== 'T_COMMENT') 
                || !is_array($token)) 
            {
                $strippedCode .= is_array($token) ? $token[1] : $token;
            }
        }
        return $strippedCode;        
    }
    
    
    
    
    
    /**
     * slib_compress_script
     * ----------------------------------------------------
     * 
     * Clean output string
     * 
     * @param type $buffer
     * @return type
     */
    private function slib_compress_script( $buffer ) {

        // JavaScript compressor by John Elliot <jj5@jj5.net>

        $replace = array(
          '#\'([^\n\']*?)/\*([^\n\']*)\'#'  => "'\1/'+\'\'+'*\2'",  // remove comments from ' strings
          '#\"([^\n\"]*?)/\*([^\n\"]*)\"#'  => '"\1/"+\'\'+"*\2"',  // remove comments from " strings
          '#/\*.*?\*/#s'                    => "",                  // strip C style comments
          '#[\r\n]+#'                       => "\n",                // remove blank lines and \r's
          '#\n([ \t]*//.*?\n)*#s'           => "\n",                // strip line comments (whole line only)
          '#([^\\])//([^\'"\n]*)\n#s'       => "\\1\n",
          '#\n\s+#'                         => "\n",                // strip excess whitespace
          '#\s+\n#'                         => "\n",                // strip excess whitespace
          '#(//[^\n]*\n)#s'                 => "\\1\n",             // extra line feed after any comments left
          '#/([\'"])\+\'\'\+([\'"])\*#'     => "/*",                // restore comments in strings,
        );

        $search = array_keys( $replace );
        $script = preg_replace( $search, $replace, $buffer );

        $replace = array(
          "&&\n" => "&&",
          "||\n" => "||",
          "(\n"  => "(",
          ")\n"  => ")",
          "[\n"  => "[",
          "]\n"  => "]",
          "+\n"  => "+",
          ",\n"  => ",",
          "?\n"  => "?",
          ":\n"  => ":",
          ";\n"  => ";",
          "{\n"  => "{",
      //  "}\n"  => "}", (because I forget to put semicolons after function assignments)
          "\n]"  => "]",
          "\n)"  => ")",
          "\n}"  => "}",
          "\n\n" => "\n"
        );

        $search = array_keys( $replace );
        $script = str_replace( $search, $replace, $script );

        return trim( $script );
    }
    
}