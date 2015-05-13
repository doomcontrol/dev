<?php namespace controler\people;


class EditGroup {
    
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
        return new \controler\people\EditGroup();
    }
    
    
    public function Store($id, $group_Id){
        
        global $core; global $session;
        
        $groupId = $core->clean->numeric($group_Id);
        
        $userData = $session->get_session('userSes');
        
        $response = new \stdClass();
        
        $item = $core->em->getReference('models\entities\Users', $id);
        
        if(! $item){
            $response->status = false;
            $response->message = "There is some error. User not found!";
            return $response;
        }

        $group      = $core->em->getReference('models\entities\User\UserGroupDefinition', $groupId);
        $oldGroup   = \user_obj_definition($item, true);
        
        
        if(! $group ) return;
        
        if($oldGroup)
        $item->getUserGroupDefinition()->removeElement( $oldGroup );
        
        $item->setUsrGroupsDefinition($group);
        $core->em->persist($item);
        $core->em->flush();

        
        $response->status           = true;
        $response->pid              = \processData::getProcessData()->getID();
        $response->processId        = $response->pid;
        $response->uid              = $userData->getID();
        $response->callback         = $this->config['live']['callback'];
        
        $response->object           = new \stdClass();
        $response->object->id       = sprintf( $this->config['live']['id'], $id);
        $response->object->target   = sprintf($this->config['live']['target']. ' .sortable', $groupId );
        $response->object->previd   = null;
        $response->object->method   = $this->config['live']['method'];
        $response->object->callback = $this->config['live']['callback'];
        $response->object->reinit   = true;
        $response->object->strOutput= "";
        
        return $response;
        
        
    }
    
}
