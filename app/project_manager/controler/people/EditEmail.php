<?php namespace controler\people;


class EditEmail {
    
    public $config;
    
    public $serviceName;
    
    public function __construct() {
        $this->Init();
    }
    
    
    public function Init(){
        
        $this->config = array(

            'live'=>array(
                'target'=>'.mail.user%s',
                'callback' => 'PostComponent',
                'method'=>'html',
                'id'=>'#cartUser%s'
            ),
        );
        
        $this->serviceName = get_class($this);
        
        return $this;
    }
    
    
    public static function Service(){
        return new \controler\people\EditEmail();
    }
    
    
    public function Store($id, $value){
        
        global $core; global $session;
        
        $userData = $session->get_session('userSes');
        
        $response = new \stdClass();
        
        $item = $core->em->getReference('models\entities\Users', $id);
        
        if(! $item){
            $response->status = false;
            $response->message = "There is some error. User not found!";
            return $response;
        }
        
        $item->setEmail( $value );
        
        try {
            $core->em->persist( $item );
            $core->em->flush();
        } catch(\Exception $e){
            $response->status = false;
            $response->message = "There is some error. User not found!";
        }
        
        $response->status           = true;
        $response->pid              = \processData::getProcessData()->getID();
        $response->processId        = $response->pid;
        $response->uid              = $userData->getID();
        $response->callback         = $this->config['live']['callback'];
        
        $response->object           = new \stdClass();
        $response->object->id       = sprintf( $this->config['live']['id'], $id);
        $response->object->target   = sprintf( $this->config['live']['target'], $id);
        $response->object->method   = $this->config['live']['method'];
        $response->object->callback = $this->config['live']['callback'];
        $response->object->strOutput= '<a href="mailto:'.$value.'" class="mail user'.$id.'">'.$value.'</a>';
        
        return $response;
        
        
    }
    
}
