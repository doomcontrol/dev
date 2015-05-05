<?php namespace controler;



class Message {
    
    public $core;
    
    public $session;
    
   
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
    }
    
    
    public function StoreAjax( $title, $message){
        
        $data = [];
        
        $this->core->load->library('String');
        
        $data['title']  =  $this->core->library->string->strip_alphanumeric( $title );
        $data['message'] =  $this->core->library->string->strip_alphanumeric( $message );
        
        $modelMessage = $this->core->em->getRepository('models\entities\UsersMessage');
        
        $data['message'] = $modelMessage->saveMessage($data);
        
        $process = \processData::getProcessData();
        $userData = $this->session->get_session('userSes');
        
        $response = new \stdClass();
        $response->pid = $process->getID();
        $response->uid = $userData->getID();
        $response->callback = "FotItem.callBackStore";
        $response->object = new \stdClass();
        $response->object->strOutput = \components\message\footer\post\Component::display( $data );
        $response->object->status = $data['message'] ? true : false;
        
        $this->core->output->json($response);
        
    }
    
    
    
    public function MarkReadedAjax( $id ){
        
        $modelMessage = $this->core->em->getRepository('models\entities\UsersMessage');
        
        $modelMessage->markReaded($id);
        
    }
    
    
    
    
    
    
    
}