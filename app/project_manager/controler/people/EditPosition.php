<?php namespace controler\people;


class EditPosition {
    
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
        return new \controler\people\EditPosition();
    }
    
    
    public function Store($id, $prevId, $target, $groupId ){
        
        global $core; global $session;
        
        $prevUserId = $core->clean->numeric($prevId);
        
        //echo "ID: $id Prev ID: $prevUserId Group ID: $groupId";
        
        $this->storeOrder($id, $prevUserId, $groupId, $core);
        
        $userData = $session->get_session('userSes');
        
        $response = new \stdClass();
        
        $response->status           = true;
        $response->pid              = \processData::getProcessData()->getID();
        $response->processId        = $response->pid;
        $response->uid              = $userData->getID();
        $response->callback         = $this->config['live']['callback'];
        
        $response->object           = new \stdClass();
        $response->object->id       = sprintf( $this->config['live']['id'], $id);
        $response->object->target   = sprintf($this->config['live']['target']. ' .sortable', $groupId );
        $response->object->previd   = $prevId;
        $response->object->method   = $this->config['live']['method'];
        $response->object->callback = $this->config['live']['callback'];
        $response->object->reinit   = true;
        $response->object->strOutput= "";
        
        return $response;
        
        
    }
    
    
    private function storeOrder($id, $prevUserId, $groupId, $core){
        
        $sub    = \sub_url();
        
        $tbl  = "`projectcontrol_$sub`.`users`"; 
        
        $models = 'models\entities\Users';
        
        $user   = $core->doctrine->Sort( $models, $id, $prevUserId, $tbl);
        
        
        
        $group      = $core->em->getReference('models\entities\User\UserGroupDefinition', $groupId);
        $oldGroup   = \user_obj_definition($user, true);
        
        if(! $group ) return;
        
        if($oldGroup)
        $user->getUserGroupDefinition()->removeElement( $oldGroup );
        
        $user->setUsrGroupsDefinition($group);
        $core->em->persist($user);
        $core->em->flush();
        
    }
    
}
