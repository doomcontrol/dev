<?php 


class core {
    
    public $doctrine;
    
    public $em;
    
    public $user;
    
    public $laod;
    
    public $output;
    
    public $library ;
    
    public $guiText;
    
    public $validate;
    
    public $clean;
    
    public $detect;
    
    public static $Detect;
    
    public $registerControler;

    
    public function __construct() {
        
        $this->library = new \stdClass();
        
    }
    
    
    public function Init(){
        
        include_once CORE . 'helpers/doctrine_helper.inc.php';
        include_once CORE . 'helpers/url_helper.inc.php';
        
        $this->doctrine = new lib\Doctrine();
        $this->load = new \lib\Load(); 
        $this->output = new \lib\Output();
        $this->validate = new \lib\Validate();
        $this->clean = new \lib\Clean();
        $this->detect = new \lib\device\PHP\uagent_info();
        self::$Detect = $this->detect;
        
        $this->predefine_helpers();
        
        $this->loadGuiText();
        
        \process\Resolve::ResolveProcess();
        
    }
    
    
    private function loadGuiText(){
        
        $guiModel = $this->em->getRepository('models\entities\Core\GuiText');
        //TODO promeniti na dinamicki
        $this->guiText = $guiModel->getGuiText(2);
        
    }
    
    
    public function predefine_helpers(){
        
        $this->load->helper(array('Form','URL', 'Doctrine', 'User', 'String'));
        
    }
    
    
    public function isLoged(){
        
        global $session;
        
        $this->user = $session->get_session('userSes');
        
        return $this->user;
        
    }
    
    
    public function Build(){
        
        $processData = \processData::getProcessData();
        
        $processId = $processData->getID();
        
        global $session;
        
        $this->user = $session->get_session('userSes');
        
        $data = \control\Load::LoadByUrl();
        
        foreach($data as $key=>$value){
            $$key = $value;
        }
        if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
        
        if(! $this->user)
            include APP . 'template' . DIRECTORY_SEPARATOR . 'login' . DIRECTORY_SEPARATOR . 'html_tmpl.phtml';
        else
            include APP . 'template' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'html_tmpl.phtml';
        
    }
    
    
    
    
    
}

