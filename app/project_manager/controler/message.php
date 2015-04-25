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
        
        
        $id = $modelMessage->saveMessage($data);

        $data['status'] = $id ? true : false;
        
        $data['id'] = $id;
        
        $this->core->output->json($data);
        
    }
    
    
    
    public function MarkReadedAjax( $id ){
        
        $modelMessage = $this->core->em->getRepository('models\entities\UsersMessage');
        
        $modelMessage->markReaded($id);
        
    }
    
    
    
    
    
    
    
}