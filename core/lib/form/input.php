<?php namespace lib\form;


class Input {
    
    private $name;
    
    private $id;
    
    private $class;
    
    private $value;
    
    private $required = false;
    
    private $maxlength;
    
    public function __construct() {
        
    }
    
    public function Clear(){
        
        return new \lib\form\Input();
        
    }
    
    public function setName($val){
        
        $this->name = $val;
        
        $this->id = $val;
        
        return $this;
    }
    
    public function setClass($val){
        $this->class = $val;
        
        return $this;
    }
    
    public function setValue($val){
        
        $this->value = $val;
        
        return $this;
        
    }
    
    public function setRequired($val = true){
        
        $this->required = $val;
        
        return $this;
        
    }
    
    public function setMaxlength($val){
        
        $this->maxlength = $val;
        
        return $this;
        
    }
    
    public function Generate(){
        
       $strInput = '<input ';
       $strInput.= 'type="text" ';
       $strInput.= 'name="'.$this->name.'" ';
       $strInput.= 'id="'.$this->name.'" ';
       $strInput.= $this->value     ? 'value="'.$this->value.'" '           : '';
       $strInput.= $this->maxlength ? 'maxlength="'.$this->maxlength.'" '   : '';
       $strInput.= $this->required  ? 'required '                           : '';
       $strInput.= ' />';

       return $strInput;
    }
}

