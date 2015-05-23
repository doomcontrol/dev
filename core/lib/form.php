<?php namespace lib;


class Form {
    
    private $core;
    
    private $element = "";
    
    private $label;
    
    private $onclick;
    
    private $list = [];
    
    const 
        INPUT   = "input",
        SELECT  = "select",
        RADIO   = "radio",
        CHECKBOX= "checkbox",
        SUBMIT  = "submit";


    public function __construct() {
        
        global $core;
        
        $this->core = $core;
        
    }
    
    private function element($val){
        $this->element .= $val;
    }
    
    public function Clear(){
        $this->element = "";
        $this->label = null;
        $this->list = [];
        $this->onclick = null;
        return $this;
    }
    
    public function listData($val){
        $this->list = $val;
        return $this;
    }
    
    public function call($funct = null){
        return $this;
    }
    
    public function label($name){
        $this->label = $name;
        return $this;
    }
    
    public function onclick($val){
        $this->onclick = $val;
        return $this;
    }
    
    public function add($type,$name,$value,$required,$class, $maxlength){
        
        $element = "";
        
        switch ($type){
            
            case "input":
                
                $input = new \lib\form\Input();
                
                $input->setName( $name )
                      ->setRequired( $required )
                      ->setValue($value)
                      ->setClass($class)
                      ->setMaxlength($maxlength);
                
                $element = $input->Generate();
                
            break;
        
            case "select":
                
                $select = new \lib\form\Select();
                
                $select->setName( $name )
                       ->setRequired( $required )
                       ->setValue($value)
                       ->setClass($class)
                       ->setListData( $this->list );
                
                $element = $select->Generate();
                
            break;
        
            case "submit":
                
                $submit = new \lib\form\Submit();
                
                if($this->onclick) $submit->onclick($this->onclick);
                
                $submit->setClass($class)
                       ->setValue($value);
                
                $element = $submit->Generate();
                
            break;
            
        }
        
        if($this->label) $element = '<label for="'.$name.'">'.$this->label.'</label>' . $element;
        
        
        $this->element( $element );
        
        return $this;
        
    }
    
    public function output(){
        
        return $this->element;
    }
    
}
