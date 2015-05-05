<?php namespace factory\people\service;


class Data {
    
    
    public static function generateUsers(){
        
        global $core;
        
        $data = [];
        
        return $core->em->getRepository('models\entities\Users')->getAll();
        
    }
    
    
    public static function generateAllGroups(){
        
        global $core;
        
        $data = [];
        
        return $core->em->getRepository('models\entities\Users')->getGroups();
    }
    
}