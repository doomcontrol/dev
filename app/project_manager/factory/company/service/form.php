<?php namespace factory\company\service;


class Form {
    
    
    public static function generateAddForm( ){
        
        global $core;
        
        $data = [];
        
        $core->load->library('Form');
        
        $data['form_id']    = 'addcompany' . time();
        
        $data['method']     = "post";
        
        $data['action']     = site_url('call');
        
        $data['onscreen']   = array(
            
            'tabs' => array(
                    'tab1'=>'Company Data',
                    'tab2'=>'Company Contact',
                    'tab3'=>'Save'
                 ),
                 'form' => array(
                     'tab1' => array(
                         'view' => $core->library->form->Clear()
                                ->call( \models\forms\Company::Name()   )
                                ->call( \models\forms\Company::Street() )
                                ->call( \models\forms\Company::Number() )
                                ->call( \models\forms\Company::Zip()    )
                                ->call( \models\forms\Company::City()   )
                                ->call( \models\forms\Country::All()    )
                                ->output()
                     ),
                     'tab2' => array(
                         'view'=> $core->library->form->Clear()
                                ->call( \models\forms\Company::Email() )
                                ->call( \models\forms\Company::Phone() )
                                ->output()
                     ),
                     'tab3' => array(
                         'view'=> $core->library->form->Clear()
                                ->call( \models\forms\Company::SubmitAjax( 
                                        'Save & invite', 
                                        'button blue animate-fast margin30', 
                                        'SF.Init(\''.$data['form_id'].'\')' 
                                        ) 
                                )->output()
                     )
                 ),
            
        );
        
        $data['countries'] = $core->em->getRepository('models\entities\Core\Country')->getAll();
        
        return $data;
        
        
    }
    
    
}
