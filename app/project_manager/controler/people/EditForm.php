<?php namespace controler\people;


class EditForm {
    
    public $config;
    
    public $serviceName;
    
    public function __construct() {
        $this->Init();
    }
    
    
    public function Init(){
        
        $this->config = array(

            'live'=>array(
                'target'=>'#group_%s',
                'callback' => 'PostComponent',
                'method'=>'move',
                'id'=>'#cartUser%s'
            ),
        );
        
        $this->serviceName = get_class($this);
        
        return $this;
    }
    
    
    public static function Service(){
        return new \controler\people\EditForm();
    }
    
    
    public function Open($id){
        
        global $core; global $session;
        
        $userData = $session->get_session('userSes');
        
        $response = new \stdClass();
        
        $data = [];
        
        $data['form_data']['groups'] =  $core->em->getRepository('models\entities\User\UserGroupDefinition')->getGroups();
        
        $data['user'] = $core->em->getReference('models\entities\Users', $id);
       
        
        $response->status           = true;
        $response->pid              = \processData::getProcessData()->getID();
        $response->processId        = $response->pid;
        $response->uid              = $userData->getID();
        $response->callback         = null;
        
        $response->object           = new \stdClass();
        $response->object->id       = '#editUserForm' . $id;
        $response->object->target   = 'body';
        $response->object->reinit   = false;
        $response->object->mask      = true;
        $response->object->strOutput= $core->load->view('people/form/edit_user_form', $data, true);
        
        return $response;
        
        
    }
    
}
