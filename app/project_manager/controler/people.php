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
        
        parent::__construct();
    }
    
    
    public function indexAction(){
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        $data['add_user_form']  = $this->getAddUserForm();
        $data['user_list']      = $this->getUserList();
         
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/index', $data, true);
        $objOutput->status      = true;
        
        
        
        return $objOutput;
        
    }
    
    
    public function AddNewAjax($firstName, $lastName, $email, $group){
        
        $response = new \stdClass();
        
        $validate = $this->validateNewUserData($firstName, $lastName, $email, $group); // valid data return null
        
        if($validate){
            $response->state        = false;
            $response->message      = $validate['error'];
            $response->description  = $validate['description'];
            
            $this->core->output->json($response);
        }
        
        $response = $this->saveNewUser($firstName, $lastName, $email, $group);
        
        $this->core->output->json($response);
    }
    
    
    public function user_listAction(){
        
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/user_list', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
    }
    
    
    public function manage_user_groupsAction(){
        
        
        $data = [];
        
        $data['navigation']     = $this->getNavigation();
        
        $objOutput              = new \stdClass();
        
        $objOutput->content     = $this->core->load->view('people/manage_user_groups', $data, true);
        $objOutput->status      = true;
        
        return $objOutput;
    }
    
}