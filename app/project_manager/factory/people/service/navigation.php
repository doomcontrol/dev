<?php namespace factory\people\service;


class Navigation {
    
    public static $userData;
    
    
    private static function getNavigationItems(){
        
        return array(
            array(
                'name'=>'Users_list',
                'link'=>\site_url('people'),
                'icon'=>'icon-user',
            ),
            array(
                'name'=>'Manage_user_groups', 
                'link'=>\site_url('people/manage_user_groups'),
                'icon'=>'icon-group',
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