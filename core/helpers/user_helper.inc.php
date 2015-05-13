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



if(! function_exists('user_vars')){
    
    function user_vars(){

        global $session; 
        
        $userSes = ($session->get_session('userSes'));
        
        $privilegies = $session->get_session('userSes')->getPrivilegies();
        $privilegy = reset( $privilegies ); 
        
        $string = '';
        $string.= 'var app_url = \''.site_url().'\';';
        $string.= 'var processId = '.$userSes->getProcessID().';';
        $string.= 'var sessionId = '.$userSes->getID().';';
        
        
        $string.= 'var readP = ' .$privilegy->getRead(). ';';
        $string.= 'var writeP = ' .$privilegy->getWrite(). ';';
        $string.= 'var editP = ' .$privilegy->getEdit(). ';';
        $string.= 'var deleteP = ' .$privilegy->getDelete(). ';';
        $string.= 'var uploadP = ' .$privilegy->getUpload(). ';';
        $string.= 'var viewInternalP = ' .$privilegy->getViewInternal(). ';';
        $string.= 'var manageAllP = ' .$privilegy->getManageAll(). ';';
        $string.= is_mobile() ? 'var isMobile = true;' : 'var isMobile = false;';
        
        $string.= 'var modules = ['; 
        foreach($userSes->getModules() as $module): 
            $string.="'".($module->getName())."'".','; 
        endforeach; 
        $string.='];';
        
        return $string;
    }
    
}