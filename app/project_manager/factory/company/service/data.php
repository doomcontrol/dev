<?php namespace factory\company\service;


class Data {
    
    
    public static function generateCompanies(){
        
        global $core;
        
        $data = [];
        
        return $core->em->getRepository('models\entities\Company')->getAll();
        
    }
    
    
    public static function filterCompanies($keywords = null){
        
        global $core;
        
        $data = [];
        
        return $core->em->getRepository('models\entities\Company')->getAll($keywords);
        
    }
    
    
    
    
}