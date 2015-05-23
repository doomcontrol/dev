<?php namespace lib\form;


class Submit {

    private $class;
    
    private $value;
    
    private $onclick;
    
    public function __construct() {
        
    }
    
    
    
    public function Clear(){
        
        return new \lib\form\Input();
        
    }
    
    public function onclick($val){
        $this->onclick = $val;
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
    
    
    
    public function Generate(){
        
       $strInput = '<input ';
       $strInput.= 'type="button" ';
       $strInput.= 'name="submitform" ';
       $strInput.= $this->value     ? 'value="'.$this->value.'" '           : 'value="Submit" ';
       $strInput.= $this->class     ? 'class="'.$this->class.'" '           : '';
       $strInput.= $this->onclick   ? 'onclick="'.$this->onclick.'" '       : ''; 
       $strInput.= ' />';

       return $strInput;
    }
}

