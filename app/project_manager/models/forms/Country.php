<?php namespace models\forms;


class Country {
    
    
    public static function All($val = null){
        
        global $core;
        
        $countries = $core->em->getRepository('models\entities\Core\Country')->getAll();
        
        $listData = [];
        
        if($countries)
            foreach ($countries as $country)
                $listData[] = array('value'=>$country->getID(),'string'=>$country->getName());
            
        
        $core->library->form->listData( $listData )->label('Country')->add(
                $type       = \lib\Form::SELECT, 
                $name       = 'country', 
                $value      = $val, 
                $required   = null, 
                $class      = null,
                $maxlength  = null
             );
    }
    
    
    
}
