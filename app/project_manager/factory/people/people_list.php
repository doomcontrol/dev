<?php namespace factory\people;


class People_List {
    
    public static $userData;
    
    public function __construct() {
        
        self::$userData = \objects\user\UserData::userData();
        
    }
    
    
    public function getNavigation(){
        
        $data = [];
        
        $data['nav_items'] = \factory\people\service\Navigation::generateNavigation();
        
        if( ! $data['nav_items']) return null;
        
        return $this->core->load->view('people/navigation/index', $data, true);
        
    }
    
    public function getAddUserForm(){
        
        $data = [];
        
        $data['form_data'] = \factory\people\service\Form::generateAddForm();
        
        
        
        if( ! $data['form_data']) return null;
        
        return $this->core->load->view('people/form/add_user_form', $data, true);
        
    }
    
    public function getUserList(){
        
        $data = [];
        
        $data['users'] = \factory\people\service\Data::generateUsers();
        
        $data['groups'] = \factory\people\service\Data::generateAllGroups();
        
        if( ! $data['users']) return null;
        
        return $this->core->load->view('people/list/user_list', $data, true);
        
    }
    
    
    public function validateNewUserData($firstName,$lastName,$email,$group){
        
        $data = [];
        
        if( $msg = $this->core->validate->validateName($firstName)){
            $data['error'] = "Name_string_invalid";
            $data['description'] = $msg;
            return $data;
        }
        
        if( $msg = $this->core->validate->validateName($lastName)){
            $data['error'] = "Last_Name_string_invalid";
            $data['description'] = $msg;
            return $data;
        }
        
        if( $msg = $this->core->validate->validateMail($email)){
            $data['error'] = "Email_string_invalid";
            $data['description'] = $msg;
            return $data;
        }
        
        if( $msg = $this->core->validate->validateInt($group)){
            $data['error'] = "Group_string_invalid";
            $data['description'] = $msg;
            return $data;
        }
        
        return  null;
    }
    
    public function saveNewUser($firstName,$lastName,$email,$group){
        
        $data = [];
        
        $data['firstName']  = rtrim(ltrim($firstName));
        $data['lastName']   = rtrim(ltrim($lastName));
        $data['email']      = rtrim(ltrim($email));
        $data['password']   = rtrim(ltrim($email));
        $data['username']   = rtrim(ltrim($email));
        $data['userGroup']  = rtrim(ltrim($group));
        
        $modelUser = $this->core->em->getRepository('models\entities\Users');
        
        $result = $modelUser->addNewUser($data);

        if($result->state == false){ return $result; }
        
        /**
         * Send data to socket service
         */
        $data = [];
        $data['user'] = $result->object;
        
        $response                       = new \stdClass();
        $response->state                = true;
        $response->uid                  = self::$userData->getId();
        $response->pid                  = \processData::getProcessData()->getID();
        $response->object               = new \stdClass();
        $response->object->strOutput    = \components\user\userbox\Component::Display( $data );
        $response->object->userid       = $data['user']->getID();
        $response->object->id           = "#cart-" .$response->object->userid;
        $response->object->target       = '.user_lists .usercell.group_' . \user_obj_definition($data['user']);
        $response->object->method       = 'append'; // append, prepend, text, html
        $response->callback             = 'PostComponent';


        //TODO send invitation mail
        
        return $response;
        
    }
    
}

