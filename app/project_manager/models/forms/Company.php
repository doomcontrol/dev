<?php namespace models\forms;


class Company {
    
    
    public static function Name($val = null){
        
        global $core;
        
        $core->library->form->label('Name')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'name', 
                $value      = $val, 
                $required   = 'required', 
                $class      = '',
                $maxlength  = ''
             );
    }
    
    
    public static function Street($val = null){
        
        global $core;
        
        $core->library->form->label('Street')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'street', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    public static function Number($val = null){
        
        global $core;
        
        $core->library->form->label('Number')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'number', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    
    public static function Zip($val = null){
        
        global $core;
        
        $core->library->form->label('Zip Code')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'zip', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    
    public static function City($val = null){
        
        global $core;
        
        $core->library->form->label('City')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'city', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    
    public static function Phone($val = null){
        
        global $core;
        
        $core->library->form->label('Phone')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'phone', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    
    public static function Email($val = null){
        
        global $core;
        
        $core->library->form->label('Email')->add(
                $type       = \lib\Form::INPUT, 
                $name       = 'email', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    public static function SubmitAjax($val, $_class = null, $onclick = null){
        
        global $core;
        
        if($onclick ){
            $core->library->form->onclick($onclick);
        }
        
        $core->library->form->add(
                $type       = \lib\Form::SUBMIT, 
                $name       = null, 
                $value      = $val, 
                $required   = null, 
                $class      = $_class,
                $maxlength  = null
             );
        
    }
    
}
