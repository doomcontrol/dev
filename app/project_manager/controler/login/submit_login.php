<?php namespace controler\login;


class Submit_Login {
    
    public  $core,
            $session,
            $loginControl,
            $userModel;
    
    public function __construct($loginControl) {
        
        global $core, $session;
        
        $this->core     = $core;
        $this->session  = $session;
        
        $this->loginControl = $loginControl;
        
        $this->userModel = $core->em->getRepository('models\entities\users');
        
    }
    
    
    public function processesSubmit(){
        
        
        if( ! isset($_REQUEST['username']) || ! isset($_REQUEST['password'])){
            
            $this->loginControl->status     = 'warning';
            $this->loginControl->message    = "All field is required. You must enter your username and your password.";
            
            return;
        }
        
        $username = strip_tags($_REQUEST['username']);
        $password = md5(trim(strip_tags($_REQUEST['password'])));
        
        // GET USER FROM CLIENT DATABASE ------------------------------------------------------
        $user = $this->userModel->findByLogin($username,$password);
        
        // OWNER PROCESS DATA -----------------------------------------------------------------
        $processData    = \processData::getProcessData();
        $ownerUsername  =  $processData->getOwner()->getUsername();
        $ownerPassword  = $processData->getOwner()->getPassword();
        $isOwner        = false;
        
        // USER NOT EXIST, TRY TO MATCH WITH OWNER -------------------------------------------
        if(!$user){
            if($username == $ownerUsername && $password == $ownerPassword){
                // OWNER  FOUND, INSERT INTO CLIENT USER TABLE -------------------------------
                $user = $processData->getOwner();
                $isOwner = true;
                
                $userE = new \models\entities\Users();
                $userE->setHash(  $processData->getOwner()->getHash() );
                $userE->setIsOwner( true );
                $userE->setStatus( true );
                $userE->setLastName( $processData->getOwner()->getLastName() );
                $userE->setName( $processData->getOwner()->getName() );
                $userE->setEmail( $processData->getOwner()->getEmail() );
                $userE->setUsername( $ownerUsername );
                $userE->setPassword( $ownerPassword, false);
                $userE->setHash( \generate_hash() );
                
                $this->core->em->persist( $userE );
                $this->core->em->flush();
                // CHECK IF ISER SAVED SUCCESSFULY -----------------------------------------
                if($userE->getID()) $user = $userE; else  $user = null;
            }
        }
        
        // FINALY CHECK IF USER FOUND ------------------------------------------------------
        if($user){
            
            $userObj = new \objects\user\UserData();
            $userObj->setFirstName( $user->getName() );
            $userObj->setLastName( $user->getLastName() );
            $userObj->setId( $user->getID() );
            $userObj->setHash( $user->getHash() );
            $userObj->setisOwner( $user->getIsOwner() );
            $userObj->setEmail( $user->getEmail() );
            
            $this->session->set_session('userSes', $userObj);
            
            $this->storeSimpleData( $userObj );
            
            
            redirect_url();
            
        } else {
            // NO.... USER NOT FOUND AFTER ALL ---------------------------------------------
            $this->loginControl->status     = 'error';
            $this->loginControl->message    = "User not found. Please check your username and password and try again!";
        }
        
    }
    
    
    protected function storeSimpleData($user){
        
        $processData    = \processData::getProcessData();
        
        $this->session->set_session_raw('processId', $processData->getID() );
        $this->session->set_session_raw('userId', $user->getID() );
        $this->session->set_session_raw('userName', $user->getFirstName() . ' ' . $user->getLastName() );
        
    }
    
}