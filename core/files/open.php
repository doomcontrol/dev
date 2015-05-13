<?php namespace files;


class Open {
    
    
    /**
     * Image
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Open Stored Image
     * 
     * @category controler
     * @name files.Open
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $targetPath
     * @return type
     */
    public static function Image( $targetPath ){
        
        $fileExtension = \pathinfo( $targetPath, PATHINFO_EXTENSION );
        
        if(! $fileExtension ) return; // break if file is not recognized
        
        $header = "";
        
        switch ($fileExtension){
            
            case "jpeg":
                $header = "image/jpeg";
            break;
            case "jpg":
                $header = "image/jpg";
            break;
            case "png":
                $header = "image/png";
            break;
            case "gif":
                $header = "image/gif";
            break;
            default: 
                $header = "image/jpeg";
        }
        
        header('Content-Type: ' . $header);
        header("Cache-Control: private, max-age=10800, pre-check=10800");
        header("Pragma: private");
        header("Expires: " . date(DATE_RFC822,strtotime(" 7 day")));
        header('Last-Modified: '.gmdate(DATE_RFC1123,filemtime($targetPath)));
        
        if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
            header('Last-Modified: '.$_SERVER['HTTP_IF_MODIFIED_SINCE'],true,304);
            exit;
        }
        
       
        readfile($targetPath);
    }
    
    
    
    /**
     * getRequestHeaders
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Get HTTP Headers
     * 
     * @category controler
     * @name files.Open
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    function getRequestHeaders() {
      if (function_exists("apache_request_headers")) {
        if($headers = apache_request_headers()) {
          return $headers;

        }
      }
      $headers = array();
      // Grab the IF_MODIFIED_SINCE header
      if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
        $headers['If-Modified-Since'] = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
      }
      return $headers;
    }
    
    
}