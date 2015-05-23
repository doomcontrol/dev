<?php namespace controler;



class Upload {
    
    public $core;
    
    public $session;
    
    const ALLOW_ALL     = "png,gif,jpg,jpeg,ppt,pdf,psd,mp3,xls,xlsx,swf,doc,docx,odt,odc,odp,odg";
    const ALLOW_IMAGE   = "png,gif,jpg,jpeg";
    const ALLOW_FILES   = "ppt,pdf,psd,mp3,xls,xlsx,swf,doc,docx,odt,odc,odp,odg";

    
    
    
    public function __construct() {
        
        global $core;
        $this->core = $core;
        
        global $session;
        $this->session = $session;
        
        \core\SessionCore::ValidateSession();
    }
    
    
    
    /**
     * BoxViewAjax
     * ----------------------------------------
     * 06.05.2015
     * 
     * 
     * @category controler
     * @name controler.Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $service
     * @param type $id
     */
    public function BoxViewAjax($service, $id){
        
        $response = new \stdClass();
        $response->strOutput = \components\upload\box\Component::Display($service, $id);
            
        $this->core->output->json($response);
        
    }
    
    
    
    /**
     * UploadAjax
     * ----------------------------------------
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $service
     * @param type $id
     */
    public function UploadAjax($service, $id){
        
        $this->core->load->library('Upload');
        
        $data = [];
        
        $data['id'] = $id;
        
        $data['files'] = ($_FILES);
        
        $data['service'] = call_user_func_array( sprintf("\controler\upload\%s::Service", $service), array());
        
        $response = $this->core->library->upload->uploadFile( $data );
        
        $this->core->output->json($response);
    } 
    
    
}