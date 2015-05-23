<?php namespace lib;

class Clean {
    
    public function cleanString( $string, $clean = "HTML|XSS", $char = ""){
        $cln = explode('|', $clean);
        foreach( $cln as $c ){
            switch ($c){
                case "HTML":
                    $this->cleanHTML($string);
                break;
                case "XSS":
                    $this->cleanXSS($string);
                break;
                case "NUM":
                    $string = $this->numeric($string);
                break;
                case "EMAIL":
                    $string = $this->email($string);
                break;
                case "TRIM":
                    $this->Trim($string, $char);
                break;
            }
        }
        return $string;
    }
    
    private function cleanHTML( & $string ){
        $string = strip_tags($string);
    }
    
    private function cleanXSS( & $string ){
        // Fix &entity\n;
        $string = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $string);
        $string = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $string);
        $string = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $string);
        $string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $string = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $string);

        // Remove javascript: and vbscript: protocols
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $string);
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $string);
        $string = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $string);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $string = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $string);
        $string = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $string);
        $string = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $string);

        // Remove namespaced elements (we do not need them)
        $string = preg_replace('#</*\w+:\w[^>]*+>#i', '', $string);

        do
        {
                // Remove really unwanted tags
                $old_data = $string;
                $string = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $string);
        }
        while ($old_data !== $string);

        // we are done...
    }
    
    public function Trim( & $string, $char ){
        $string = preg_replace('/\s+/', $char, $string);
    }
    
    public function string( $string, $trim = false, $char = '' ){
        
        $this->cleanHTML($string);
        $this->cleanXSS($string);
        
        if($trim) $this->Trim( $string, $char );
        
        return $string;
    }
    
    public function numeric( $string ){
        return preg_replace("/[^0-9]/","",$string);
    }
    
    public function email( $string ){
        
        if( filter_var($string, FILTER_SANITIZE_EMAIL)) return $string; else return null;
        
    }
    
    
}
