<?php namespace components\message\footer;


class Component {
    
    
    
    static function Display(){
        
        $data = [];
        
        global $core;
        
        $modelUserMessage = $core->em->getRepository('models\entities\UsersMessage');
        
        $data['messages'] = $modelUserMessage->findLast();
        
        $strView = $core->load->view('components/message/footer/index', $data, true);
        
        return $strView;
        
    }
}