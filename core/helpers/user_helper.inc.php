<?php

if( ! function_exists('user_modules')){
    
    function user_modules(){
        
        $userData = \objects\user\UserData::userData();
        
        if(! $userData )  redirect_url('login');
        
        $userModules = $userData->getModules();
        
        $modules = array();
        
        foreach($userModules as $module){
            
            $m = new \stdClass();
            
            $m->id   = $module->getID();
            $m->name = $module->getName();
            
            $modules[] = $m;
            
        }
        
        return $modules;
    }
}


if( ! function_exists('user_obj_definition')){
    
    function user_obj_definition($user, $all = false){
        
        foreach ($user->getUserGroupDefinition() as $def){
            if(! $all)
                return $def->getID();
            else 
                return $def;
        }
        
    }
    
}



if( ! function_exists('user_privilegies')){
    
    function user_privilegies(){
        
        $userData = \objects\user\UserData::userData();
        
        $userPrivilegies = $userData->getPrivilegies();
        
        foreach($userPrivilegies as $privilegy){
            
            $m = new \stdClass();
            
            $m->id   = $privilegy->getID();
            $m->read = $privilegy->getRead();
            $m->write = $privilegy->getWrite();
            $m->edit = $privilegy->getEdit();
            $m->delete = $privilegy->getDelete();
            $m->upload = $privilegy->getUpload();
            $m->viewInternal = $privilegy->getViewInternal();
            $m->manageAll = $privilegy->getmanageAll();
            
            return $m;
            
        }
        
        return null;
    }
}



if( !function_exists('is_user_have_module')){
    
    function is_user_have_module($module_name, $byID = false){
        
        $moduleList = user_modules();
        
        if(! $moduleList ) return null;
        
        foreach($moduleList as $module){
            if($byID){
                if( $module->id == $module_name )
                    return true;
            }
            if(! $byID){
                if( $module->name == $module_name )
                    return true;
            }
        }
        
        return false;
        
    }
    
}