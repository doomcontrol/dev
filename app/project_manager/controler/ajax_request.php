<?php namespace controler;


class Ajax_Request {
    
    private $classObj, $classFunct;
    
    
    public function __construct(){
        
        \core\SessionCore::ValidateSession();
        
    }
    
    /**
     * indexAction
     * ----------------------------------------------
     * Load Assets Resources array files
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Ajax_Request
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     */
    public function indexAction(){
        
        // DIE IF IS NOT FROM AJAX
        if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')  die();
        
        
        $classObj           = null;
        $classFunct         = null;
        
        if(isset($_POST['classObj'])) $classObj     = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['classObj']);
        if(isset($_POST['classFunct'])) $classFunct = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['classFunct']);
        
        
        if($classFunct == null || $classObj == null) die();
        
        
        $this->classFunct   = $classFunct . 'Ajax';
        $this->classObj     = $classObj;
        
        
        
        $this->loadObject();
        
        die();
    }
    
    
    /**
     * loadObject
     * ----------------------------------------------
     * Load Assets Resources array files
     * 06.05.2015
     * 
     * @category controler
     * @name controler.Ajax_Request
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     */
    private function loadObject(){
        
        $nmsp = '\controler\\' . $this->classObj;
        
        $class = new $nmsp();
        
        $post = $_POST;
        
        unset($post['classObj']);
        unset($post['classFunct']);
        
        call_user_func_array(array($class, $this->classFunct), $post);
        
    }
    
    
}
