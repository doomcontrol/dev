<?php


if( !function_exists('isSubmit')){
    
    function isSubmit(){
        
        if(isset($_POST['submit'])) return true; else return false;
        
    }
    
}



if( !function_exists('is_serialized')){
    function is_serialized($str, $unserialize = false){

        $is = ($str == serialize(false) || @unserialize($str) !== false);
        
        if($unserialize && $is){
            return unserialize($str);
        } else if($unserialize){
            return $str;
        }
        
        return $is;

    }
}