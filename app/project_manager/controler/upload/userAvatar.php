<?php namespace controler\upload;


class userAvatar {
    
    public $config;
    
    public $serviceName;
    
    
    
    public function __construct() {
        $this->Init();
    }
    
    
    
    
    /**
     * Init
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale config file
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \controler\upload\userAvatar
     */
    public function Init(){
        
        $this->config = array(
            'target'    => sprintf(IMAGES_CLIENTS, \processData::getProcessData()->getUrlShort() ),
            'dirname'   => USER_AVATAR_PATH,
            'type'      => \controler\Upload::ALLOW_IMAGE,
            'resize'    => array(
                'small'=> array('width'=>120, 'height'=>120, 'method'=>'ZEBRA_IMAGE_CROP_CENTER'),
                'medium'=> array('width'=>300, 'height'=>200, 'method'=>'ZEBRA_IMAGE_CROP_CENTER'),
                'big'=> array('width'=>450, 'height'=>300, 'method'=>'ZEBRA_IMAGE_BOXED'),
            ),
            'maxsize' => 400000,
            'response'  => 'Store',
            'live'=>array(
                'target'=>'#userAvatar%s',
                'callback' => 'PostComponent',
                'method'=>'html',
                'id'=>'#cartUser'
            ),
        );
        
        $this->serviceName = get_class($this);
        
        return $this;
    }
    
    
    
    
    /**
     * getAvatarPath
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc get avatar base path
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    public function getAvatarPath(){
        
        $this->Init();
        
        return sprintf( $this->config['target'], $this->config['dirname']);
        
    }
    
    
    
    /**
     * getImagePath
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc get avatar base path same as avatar path
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return type
     */
    public function getImagePath(){
        
        $this->Init();
        
        return sprintf( $this->config['target'], $this->config['dirname']);
        
    }
    
    
    
    
    /**
     * Service
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc return this class
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @return \controler\upload\userAvatar
     */
    public static function Service(){
        return new \controler\upload\userAvatar;
    }
    
    
    
    
    /**
     * Store
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc store new uploaded file to user
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @global type $core
     * @param type $id
     * @param type $response
     * @return type
     */
    public function Store($id, $response){
        
        global $core;
        
        $userModel = $core->em->getRepository('models\entities\Users');
        
        $oldAvatar = $userModel->storeAvatar($id,$response->fileData->fullName);
        
        if($oldAvatar){
            $this->unlinkImage( 
                    sprintf( $response->fileData->target, USER_AVATAR_PATH),
                    $oldAvatar
            );
        }
        
        $response->live = new \stdClass();
        $response->strOutput = \components\user\useravatar\cartview\Component::display( $response->fileData->fullName, $id );
        
        return $response;
    }
    
    
    
    
    /**
     * unlinkImage
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc delete old images
     * 
     * @category upload files
     * @name controler.upload.userAvatar
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $path
     * @param type $imageName
     */
    private function unlinkImage($path,$imageName){
        
        $fullPath = $path . $imageName;
        
        if(file_exists( $fullPath ))unlink($fullPath);
        
        foreach($this->config['resize'] as $key=>$value){
            $fullPath = $path . $key . DIRECTORY_SEPARATOR . $imageName;
            
            if(file_exists( $fullPath ))unlink($fullPath);
        }
    }
    
    
    
}
