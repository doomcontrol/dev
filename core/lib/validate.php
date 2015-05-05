<?php namespace lib;


class Validate {
    
    
    public function __construct() {
        
    }
    
    //TODO zameniti sa qui text
    
    function validateName($str){
        $nameErr = null;
        if (!preg_match("/^[\p{L}-. ]*$/u",$str)) {
            $nameErr = "Only letters and white space allowed"; 
        }
        
        return $nameErr;
    }
    
    
    function validateMail($str){
        $nameErr = null;
        if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
            $nameErr = "Invalid email format"; 
        }

        return $nameErr;
    }
    
    
    function validateUrl($str){
        $nameErr = null;
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$str)) {
            $nameErr = "Invalid URL"; 
        }
        
        return $nameErr;
    }
    
    
    function validateInt($str){
        $nameErr = null;
        if(! filter_var($str, FILTER_VALIDATE_INT)) {
            $nameErr = "Field must be integer"; 
        }
        
        return $nameErr;
    }
    
    
    function validateDate($str, $format = 'd.m.Y'){
        $nameErr = null;
    
        if(! \DateTime::createFromFormat($format, $str)){
            $nameErr = "Date is invalid"; 
        }
        return $nameErr;
    }
    
    
    function validateDateTime($str, $format = 'd.m.Y H:i'){
        $nameErr = null;
    
        if(! \DateTime::createFromFormat($format, $str)){
            $nameErr = "Date is invalid"; 
        }
        return $nameErr;
    }
    
    
    function validateString($str){
        
        $nameErr = null;
        if(strlen($str) != strlen(strip_tags($str))) {
            $nameErr = "have invalid strings such as html elements"; 
        }
        return $nameErr;
    }


}
