<?php namespace controler\people;


class Search {
    
    public $config;
    
    public $serviceName;
    
    public function __construct() {
        $this->Init();
    }
    
    
    public function Init(){
        
        $this->config = array(

        );
        
        $this->serviceName = get_class($this);
        
        return $this;
    }
    
    
    public static function Service(){
        return new \controler\people\Search();
    }
    
    
    public function Display($keyword, $objPeople){
        
        global $core; global $session;
        
        $userData = $session->get_session('userSes');
        
        $response = new \stdClass();
        
        $response->status = false;
        
        $response->message= "Result is empty. Please change your search request";
        
        $keywordString = $core->clean->cleanString($keyword);
        
        if(empty($keywordString)) {
        	$userList = $objPeople->getUserList( );
        } else {
        	$userList = $objPeople->getUserListFiltered( $keywordString );
        }
        
        
        
        
        $response->status           = true;
        $response->message          = null;
        $response->pid              = \processData::getProcessData()->getID();
        $response->processId        = $response->pid;
        $response->uid              = $userData->getID();
        $response->callback         = null;
        
        $response->object           = new \stdClass();
        $response->object->id       = null;
        $response->object->target   = '#userList';
        $response->object->method   = null;
        $response->object->callback = null;
        $response->object->strOutput= $userList;
        
        return $response;
        
        
    }
    
}
