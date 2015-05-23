<?php namespace controler;

use factory\people\People_List;

class People  extends People_List {
    
    public $core;
    
    public $session;
    
   
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
        
        
        \core\SessionCore::ValidateSession();
        
        parent::__construct();
    }
    
    
    
    /**
     * indexAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Page
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function indexAction(){
        
        $this->core->registerControler = "People.indexAction";
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        $data['add_user_form']  = $this->getAddUserForm();
        $data['user_list']      = $this->getUserList();
         
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/index', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
        
    }
    
    
    
    /**
     * AddNewAjax
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc New user form
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $firstName
     * @param type $lastName
     * @param type $email
     * @param type $group
     */
    public function AddNewAjax($firstName, $lastName, $email, $group){

        $validate = $this->validateNewUserData($firstName, $lastName, $email, $group); // valid data return null
        
        if($validate){
            
            $response = new \stdClass();
            
            $response->state        = false;
            $response->message      = $validate['error'];
            $response->description  = $validate['description'];
            
            $this->core->output->json($response);
        }
        
        $response = $this->saveNewUser($firstName, $lastName, $email, $group);
        
        $this->core->output->json($response);
    }
    
    
    /**
     * user_listAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc New user form
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function user_listAction(){
        
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/user_list', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
    }
    
    
    
    /**
     * manage_user_groupsAction
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc New user form
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function manage_user_groupsAction(){
        
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/manage_user_groups', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
    }
    
    
    
    /**
     * EditEmailAjax
     * ----------------------------------------
     * 10.05.2015
     * 
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     * @param type $value
     */
    public function EditEmailAjax($id,$value){
        
        $this->core->output->json( \controler\people\EditEmail::Service()->Store($id, $value) );
        
    }
    
    
    
    /**
     * EditNameAjax
     * ----------------------------------------
     * 10.05.2015
     * 
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     * @param type $first_name
     * @param type $last_name
     */
    public function EditNameAjax($id,$first_name, $last_name){
        
        $this->core->output->json(\controler\people\EditName::Service()->Store($id, $first_name, $last_name) );
        
    }
    
    
    
    public function PositionAjax( $id, $groupId, $target, $prevId = null  ){
        
        $this->core->output->json(\controler\people\EditPosition::Service()->Store($id, $prevId, $groupId, $target ) );
        
    }
    
    
    
    
    
    /**
     * EditGroupAjax
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Store user group
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     * @param type $groupId
     * @return \stdClass
     */
    public function EditGroupAjax($id, $groupId){
        
       $this->core->output->json( \controler\people\EditGroup::Service()->Store($id, $groupId) );
        
    }
    
    
    /**
     * EditFormAjax
     * ----------------------------------------
     * 16.05.2015
     * 
     * @desc Get edit user form
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     */
    public function EditFormAjax($id){
        
        $this->core->output->json( \controler\people\EditForm::Service()->Open($id) );
        
    }
    
    
    /**
     * SaveFormAjax
     * ----------------------------------------
     * 16.05.2015
     * 
     * @desc Store edit user data
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     * @param type $fname
     * @param type $lname
     * @param type $email
     * @param type $username
     * @param type $password
     * @param type $groupId
     */
    public function SaveFormAjax($id,$fname,$lname,$email,$username,$password,$groupId){
        
        $formData = new \stdClass();
        
        $formData->id           = $this->core->clean->numeric( $id );
        $formData->firstName    = $this->core->clean->string( $fname );
        $formData->lastName     = $this->core->clean->string( $lname );
        $formData->email        = $this->core->clean->email( $email );
        $formData->username     = $this->core->clean->string( $username, $trim = true, $char = '_' );
        $formData->password     = $this->core->clean->string( $password );
        $formData->groupId      = $this->core->clean->numeric( $groupId );
        
        $this->core->output->json( \controler\people\SaveEditForm::Service()->Store( $formData ) );
        
    }
    
    
    
     /**
     * SearchAjax
     * ----------------------------------------
     * 16.05.2015
     * 
     * @desc Get edit user form
     * 
     * @category controler
     * @name controler.People
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $id
     */
    public function SearchAjax($keyword){
        
        $this->core->output->json( \controler\people\Search::Service()->Display($keyword, $this) );
        
    }
    
    
    
}