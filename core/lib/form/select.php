<?php namespace lib\form;


class Select {
    
    private $name;
    
    private $id;
    
    private $class;
    
    private $value;
    
    private $required = false;
    
    private $listData;
    
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
    
    public function setListData($val){
        $this->listData = $val;
    }
    
    public function Generate(){
        
       $strSelect = '<select ';
       $strSelect.= 'name="'.$this->name.'" ';
       $strSelect.= 'id="'.$this->name.'" ';
       $strSelect.= $this->class  ? 'class="'.$this->class.'" ' : '';
       $strSelect.= $this->required  ? 'required ' : '';
       $strSelect.= ' >';
       
       if(count($this->listData)){
           foreach($this->listData as $data){
               $strSelect.='<option value="'.$data['value'].'" '.( $data['value']==$this->value ? 'SELECTED' :'').'>'.$data['string'].'</option>';
           }
       }
       
       $strSelect.= '</select>';

       return $strSelect;
    }
}