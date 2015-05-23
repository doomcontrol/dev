<?php namespace controler\people;


class SaveEditForm {
    
    public $config;
    
    public $serviceName;
    
    private $message;
    
    private $validate;
    
    private $core, $session;
    
    public function __construct() {
        $this->Init();
    }
    
    /**
     * Init
     * ----------------------------------------
     * 16.05.2015
     * 
     * @desc Initialize config data
     * 
     * @category controler
     * @name controler.People.SaveEditForm
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \controler\people\SaveEditForm
     */
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
        
        global $core; global $session;
        
        $this->core = $core; 
        $this->session = $session;
        
        return $this;
    }
    
    
    public static function Service(){
        return new \controler\people\SaveEditForm();
    }
    
    
    public function Store($formData){

        
        $userData = $this->session->get_session('userSes');
        
        $response = new \stdClass();
        
        $response->status = true;
        $this->validate = true;
        
        if( $response->message = $this->validateID( $formData->id) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        if( $response->message = $this->validateFirstName( $formData->firstName) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        if( $response->message = $this->validateLastName( $formData->lastName) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        if( $response->message = $this->validateEmail( $formData->email) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        if( $response->message = $this->validateUsername( $formData->username) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        if( $response->message = $this->validateGroupID( $formData->groupId) ) {
            $response->status = $this->validate;
            return $response;
        }

        
        $formData->group =  $this->core->em->getReference( 'models\entities\User\UserGroupDefinition', $formData->groupId );
        
        if( $response->message = $this->validateGroupID( $formData->group) ) {
            $response->status = $this->validate;
            return $response;
        }
        
        
        $formData->user = $this->core->em->getReference('models\entities\Users', $formData->id);
        
        if( $response->message = $this->validateID( $formData->user) ) {
            $response->status = $this->validate;
            return $response;
        }

        
        if( $oldGroup = \user_obj_definition($formData->user, true) )  $formData->user->getUserGroupDefinition()->removeElement( $oldGroup );
        
        
        $formData->user->setName( $formData->firstName );
        $formData->user->setLastName( $formData->lastName );
        $formData->user->setUsername( $formData->username );
        $formData->user->setEmail( $formData->email );
        $formData->user->setUsrGroupsDefinition( $formData->group );
        
        if(!empty($formData->password)){
            //TODO polsati mail korisniku
            $formData->user->setPassword( $formData->password );
        }
        
        
        try{
        $this->core->em->persist( $formData->user );
        $this->core->em->flush();
        } catch(\Exception $e){
            $response->status = false;
            $response->message = ENVIRONMENT == 'development' ? $e->getMessage() : 'There is system error. User not saved. Please report this to bug service';
            return $response;
        }
       
        
        $response->status               = true;
        $response->pid                  = \processData::getProcessData()->getID();
        $response->processId            = $response->pid;
        $response->uid                  = $userData->getID();
        $response->callback             = null;
        
        $response->object               = new \stdClass();
        $response->object->id           = '';
        $response->object->target       = '';
        $response->object->reinit       = false;
        $response->object->mask         = false;
        $response->object->strOutput    = 'null';
        $response->object->close        = '.removable-mask, .extended-window ';
        $response->object->move         = $formData->groupId != $oldGroup ? array('target'=>sprintf('#group_%s'. ' .sortable', $formData->groupId ),'element'=>'#cartUser'.$formData->id) : null;
        $response->object->highlight    = "#cartUser".$formData->id;
        
        $response->object->data                     = array(
            array( 'target'=>'.userFirstName'.$formData->id, 'value'=>$formData->firstName ),
            array( 'target'=>'.userLastName'.$formData->id, 'value'=>$formData->lastName ),
            array( 'target'=>'.userFullName'.$formData->id, 'value'=>$formData->firstName. ' ' .$formData->lastName ),
            array( 'target'=>'.userEmail'.$formData->id, 'value'=>$formData->email ),
        );
        
        return $response;
    }
    
    private function validateID( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. User not found!";
        }
        
        return NULL;
    }
    
    private function validateFirstName( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. User first name can not be empty!";
        }
        
        return NULL;
    }
    
    private function validateLastName( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. User last name can not be empty!";
        }
        
        return NULL;
    }
    
    private function validateEmail( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. User email can not be empty!";
        }
        
        return NULL;
    }
    
    private function validateUsername( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. User username can not be empty!";
        }
        
        return NULL;
    }
    
    private function validateGroupID( $string ){
        
        if(empty($string)) {
            $this->validate = false;
            return "There is some error. Group not found!";
        }
        
        return NULL;
    }
}