<?php namespace controler;


class Ajax_Request {
    
    private $classObj, $classFunct;
    
    public function indexAction(){
        
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
    
    
    private function loadObject(){
        
        $nmsp = '\controler\\' . $this->classObj;
        
        $class = new $nmsp();
        
        $post = $_POST;
        
        unset($post['classObj']);
        unset($post['classFunct']);
        
        call_user_func_array(array($class, $this->classFunct), $post);
        
    }
    
    
}
