<?php namespace components\onscreen;


class Component {
    
    private static $config = [];
    
    private static function defaultConfig(){
        
        self::$config = array(
            
                'tabs' => array(
                    'tab1'=>'Base Data',
                    'tab2'=>'Extend Data',
                    'tab3'=>'Save'
                 ),
                 'form' => array(
                     'tab1' => array(
                         'view' => ''
                     ),
                     'tab2' => array(
                         'view'=>''
                     ),
                     'tab3' => array(
                         'view' => ''
                     )
                 ),
        );
        
    }
    
    public static function setConfig( $config ){
        
        self::$config = $config;
        
    }
    
    
    public static function Display( $onscreenId, $config, $form_id ){
        
        if(count($config)) { self::setConfig( $config ); }
        
        $data = [];
        
        $data['config'] = self::$config;
        
        $data['form_id']= $form_id;
        
        $data['onscreenId'] = $onscreenId;
        
        global $core;
        
        return $core->load->view('components/onscreen/black', $data, true);
        
        
    }
}