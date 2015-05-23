<?php namespace factory\company;


class Company_List {
    
    public static $userData;
    
    
    
    public function __construct() {
        
        self::$userData = \objects\user\UserData::userData();
        
    }
    
    /**
     * Company_List.getNavigation
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    public function getNavigation(){
        
        $data = [];
        
        $data['nav_items'] = \factory\company\service\Navigation::generateNavigation();
        
        if( ! $data['nav_items']) return null;
        
        return $this->core->load->view('people/navigation/index', $data, true);
        
    }
    
    
    /**
     * Company_List.getAddCompanyForm
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    public function getAddCompanyForm(){
        
        $data = [];
        
        $data['form_data'] = \factory\company\service\Form::generateAddForm();

        if( ! $data['form_data'] ) return null;
        
        return $this->core->load->view('company/form/add_company_form', $data, true);
    }
    
    
    /**
     * Company_List.getCompanyList
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    public function getCompanyList(){
        
        $data = [];
        
        $data['companies'] = \factory\company\service\Data::generateCompanies();
        
        
        if( ! $data['companies']) return null;
        
        return $this->core->load->view('company/list/company_list', $data, true);
        
    }
    
    /**
     * Company_List.getCompanyListFiltered
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $keyword
     * @return type
     */
    public function getCompanyListFiltered($keyword){
        
        $data = [];
        
        $data['keyword'] = strip_tags($keyword);
        
        $data['companies'] = \factory\company\service\Data::filterCompanies( $keyword );
        
        
        if( ! $data['companies']) return $this->core->load->view('company/list/company_list_empty', $data, true);
        
        return $this->core->load->view('company/list/company_list', $data, true);
        
    }
    
    
    /**
     * Company_List.validateNewCompanyData
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $firstName
     * @param type $lastName
     * @param type $email
     * @param type $group
     * @return type
     */
    public function validateNewCompanyData($firstName,$lastName,$email,$group){
        
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
    
    
    /**
     * Company_List.saveNewCompany
     * -----------------------------------------
     * 22.05.2015
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $firstName
     * @param type $lastName
     * @param type $email
     * @param type $group
     * @return \stdClass
     */
    public function saveNewCompany($firstName,$lastName,$email,$group){
        
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
     
        $data['user'] = $result->object;
        
        $response                       = new \stdClass();
        $response->state                = true;
        $response->uid                  = self::$userData->getId();
        $response->pid                  = \processData::getProcessData()->getID();
        $response->object               = new \stdClass();
        $response->object->strOutput    = \components\user\userbox\Component::Display( $data );
        $response->object->userid       = $data['user']->getID();
        $response->object->id           = "#cartUser" .$response->object->userid;
        $response->object->target       = '#group_' . \user_obj_definition($data['user']) . ' .sortable';
        $response->object->method       = 'append'; // append, prepend, text, html
        $response->callback             = 'PostComponent';
        $response->object->reinit       = true;


        //TODO send invitation mail
        
        return $response;
        
    }
    
}