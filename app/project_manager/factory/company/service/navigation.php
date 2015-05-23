<?php namespace factory\company\service;


class Navigation {
    
    public static $userData;
    
    
    private static function getNavigationItems(){
        
        return array(
            array(
                'name'=>'Company_list',
                'link'=>\site_url('company'),
                'icon'=>'icon-bank',
            ),
            
        );
    }
    
    
    public static function generateNavigation(){
        
        global $core;
        
        $data = [];
        
        $modules = \user_modules();
        
        
        if( \is_user_have_module(1,true)) {
            return self::getNavigationItems();
        }
        else {
            return array();
        }
        
        
        
    }
    
    
    
    
}