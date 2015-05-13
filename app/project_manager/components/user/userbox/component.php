<?php namespace components\user\userbox;


class Component {
    
    
    
    static function Display( $data ){

        global $core;
        global $session;
        
        $data['form_data']['groups'] = $core->em->getRepository('models\entities\User\UserGroupDefinition')->getGroups();
        
        $strView = $core->load->view('components/user/userbox/index', $data, true);
        
        return $strView;
        
    }
}