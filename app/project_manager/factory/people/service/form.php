<?php namespace factory\people\service;


class Form {
    
    
    public static function generateAddForm(){
        
        global $core;
        
        $data = [];
        
        $data['form_id'] = 'adduser' . time();
        
        $data['method'] = "post";
        
        $data['action'] = site_url('call');
        
        $data['groups'] = $core->em->getRepository('models\entities\User\UserGroupDefinition')->getGroups();
        
        return $data;
        
        
    }
    
    
}
