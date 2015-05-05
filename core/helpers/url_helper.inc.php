<?php


/**
 * SITE URL
 */
if(!function_exists('site_url')){
    
    function site_url($path=null){
        
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        $domain = $protocol . "://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST);
      
        
        $domain =  rtrim($domain,'/') . '/';
        
        if($path){
            $path = ltrim($path,'/');
            $domain .= $path;
        }
        
        return $domain;
    }
}


/**
 * REDIRECT URL
 */
if(!function_exists('redirect_url')){
    
    function redirect_url($path = null){
       
        header('Location: '.site_url($path));
        die();
        
    }
    
}


/**
 * ASSETS URL
 */
if(!function_exists('assets_url')){
    
    function assets_url($path = null){
       
        $path = ltrim($path,'/');
        
        return site_url('assets/' . $path);
        
    }
    
}


/**
 * URI URL
 */
if(!function_exists('uri_url')){
    
    function uri_url($url = null){
    
        if($url == null)
            return $_SERVER['REQUEST_URI'];
        else 
        {
            $pu = parse_url($url);
           
            if(isset($pu['path'])){
                return $pu['path'];
            } else {
                return '';
            }
        }
    
    }
    
}


/**
 * PARAMS URL
 */
if(!function_exists('params_url')){
    
    function params_url($execlude = array(), $url = null){
    
        $uri = rtrim(ltrim(uri_url($url),'/'),'/');
        
        if(strlen($uri)){
            $e = explode('/', $uri);
            
            if(count($e) == 1){
                if($e[0] == $execlude[0]){ unset($e[0]); }
            }
            else 
            if(count($e) >= 2){
                if($e[0] == $execlude[0]){ unset($e[0]); }
                if($e[1] == $execlude[1]){ unset($e[1]); }
            }
            
            return $e;
            
        } else {
            return array();
        }
    
    }
    
}



if(! function_exists('sub_url')){
    
    function sub_url(){
        
        $suburl = null;
        
        preg_match('/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/i', site_url(), $match);
        
        if(isset($match[1])){  $suburl = $match[1]; }
        
        return $suburl;
    }
    
}


if(!function_exists('exception_message')){
    
    function exception_message($code,$title,$message, $class, $function, $file){
        
        $strMessage = "<h5 class=\"exception-title\">Core Exception ($code code) </h5>";
        $strMessage.= "<h3 class=\"error-title\">$title</h3>";
        $strMessage.= "<code class=\"error-code\">$message</code>";
        $strMessage.= "<div class=\"error-class\"><label>Class:</label>$class</div>";
        $strMessage.= "<div class=\"error-class\"><label>Function:</label>$function</div>";
        $strMessage.= "<div class=\"error-class\"><label>File:</label>$file</div>";
        
        $dbg = debug_backtrace();
        
        $strMessage.= "<div class=\"error-debug\" >";
        $strMessage.="<ul>";
        
        
        if(isset($dbg[1]))
        {
                if(isset($dbg[1]['file'])){
                    $strMessage.= "<li><label>FILE:</label>".$dbg[1]['file']."</li>";
                }
                if(isset($dbg[1]['line'])){
                     $strMessage.= "<li><label>LINE:</label>".$dbg[1]['line']."</li>";
                }
        }
        
        
        
        
        $strMessage.="</ul>";
        $strMessage.= "</div>";
       
        
        throw new Exception($strMessage);
        
    }
}