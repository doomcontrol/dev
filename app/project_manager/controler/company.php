<?php namespace controler;

use factory\company\Company_List;

class Company  extends Company_List {
    
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
     * @name controler.Company
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \stdClass
     */
    public function indexAction(){
        
        $this->core->registerControler = "Company.indexAction";
        
        $data = [];
        
        $data['navigation']         = $this->getNavigation();
        $data['add_company_form']   = $this->getAddCompanyForm();
        $data['company_list']       = $this->getCompanyList();
         
        $objOutput                  = new \stdClass();
        
        $objOutput->content         = $this->core->load->view('company/index', $data, true); 
        $objOutput->status          = true;
        
        return $objOutput;
        
    }
    
    
    
}