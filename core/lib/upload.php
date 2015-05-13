<?php namespace lib;


class Upload {
    
    
    public $core;
    
    private $response;
    
    private $ext;
    
    private $fileData;
    
    
    
    
    public function __construct() {
        global $core;
        $this->core = $core;
    }
    
    
    
    
    /**
     * UploadFile
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $data
     * @return type
     */
    public function UploadFile($data){
        
        $service = $data['service'];
        
        $callback = $service->config['response'];
        
        $this->DoUpload($data['files'],$service->config, $data['id']);

        $this->response = $service->{$callback}($data['id'], $this->response);
        
        
        if($this->response->status && isset($service->config['resize']) && $service->config['type']==\controler\Upload::ALLOW_IMAGE)
            
            $this->Resize( $service->config['resize'] );
        
        
        $this->response->live           = new \stdClass();
        $this->response->live->target   = sprintf($service->config['live']['target'], $data['id']);
        $this->response->live->method   = ($service->config['live']['method']);
        $this->response->live->callback = ($service->config['live']['callback']);
        $this->response->live->id       = ($service->config['live']['id']) . $data['id'];
        
        return $this->response;
    }
    
    
    
    
    /**
     * DoUpload
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * 
     * @param type $files
     * @param type $config
     * @param type $id
     * @return type
     */
    private function DoUpload($files, $config, $id){
        
        $this->response = new \stdClass();
        
        $this->response->status = false;
        $this->response->message = null;
        
        
        if( $this->response->message = $this->checkCoruption( $files ) ) return;
        if( $this->response->message = $this->checkErrors( $files ) ) return;
        if( $this->response->message = $this->checkSize( $files, $config['maxsize'] ) ) return;
        if( $this->response->message = $this->checkExtension( $files, $config['type'] ) ) return;
        if( $this->response->message = $this->checkDirectory( $config['target'], $config['dirname'] ) ) return;
        if( $this->response->message = $this->moveFile( $files, $config['target'], $id, $config['dirname'] ) ) return;
    }
    
    
    
    /**
     * checkCoruption
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $files
     * @return type
     */
    private function checkCoruption($files){
        
        if ( !isset($files['file']['error']) || is_array($files['file']['error'])) {
            return ('Invalid parameters. File is corupted');
        }
        
        return null;
    }
    
    
    
    /**
     * checkErrors
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $files
     * @return type
     */
    private function checkErrors($files){
        
        switch ($files['file']['error']) {
            case UPLOAD_ERR_OK:
                return null;
            case UPLOAD_ERR_NO_FILE:
                return ('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return('Exceeded filesize limit.');
            default:
                return ('Unknown errors.');
        }
    }
    
    
    
    /**
     * checkSize
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $files
     * @param type $maxsize
     * @return type
     */
    private function checkSize($files, $maxsize =null){
        
        
        if(!$maxsize) $maxsize = MAX_UPLOAD;
        
        if ($files['file']['size'] > $maxsize) return ('Exceeded filesize limit.'); 
        
        return null;
    }
    
    
    
    /**
     * checkExtension
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $files
     * @param type $type
     * @return type
     */
    private function checkExtension($files, $type){
        
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $allowed = explode(',', $type);
        
 
        $mime = ($finfo->file($files['file']['tmp_name']));
        $splitMime = explode('/', $mime);
        $this->ext = strtolower(end($splitMime));
        
        if (!in_array($this->ext, $allowed)) {
            return ('Invalid file format.');
        }
        
        return null;
    }
    
    
    
    
    /**
     * checkDirectory
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $target
     * @param type $dir
     * @return type
     */
    private function checkDirectory($target, $dir){
        
        $targetDirPath =  sprintf($target,$dir);
        
        if(is_dir($targetDirPath)) return null;
        
        return $this->makeDirectory($targetDirPath);
    }
    
    
    
    /**
     * makeDirectory
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $targetDirPath
     * @return string
     */
    private function makeDirectory($targetDirPath){
      
        
        
        if(is_dir($targetDirPath)) return null;
        
        $old_umask = umask(0);

        if(! mkdir($targetDirPath, 0755, true) ){
            return "Unable to create specific directory";
        }
        umask($old_umask);
        
        return null;
    }
    
    
    
    /**
     * moveFile
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $files
     * @param type $target
     * @param type $id
     * @param type $dir_name
     * @return type
     */
    private function moveFile($files, $target, $id, $dir_name){
       
        $newname = md5($files['file']['tmp_name'] . $id .  microtime());
        $finaly = sprintf($target.'%s.%s',$newname, $this->ext);
        $realPath = $target;
        
        try{

            if (!move_uploaded_file($files['file']['tmp_name'], $finaly)) {
                return ('Failed to move uploaded file.');
            }

            $this->fileData             = new \stdClass();
            $this->fileData->id         = $id;
            $this->fileData->name       = $newname;
            $this->fileData->fullName   = $newname . '.' . $this->ext;
            $this->fileData->extension  = $this->ext;
            $this->fileData->target     = $target;
            $this->fileData->size       = $files['file']['size'];
            $this->fileData->realPath   = $finaly;
            $this->fileData->dirPath    = $realPath;
            $this->fileData->dirName    = $dir_name;
            
            $this->response->status = true;
            $this->response->fileData = $this->fileData;

            return null;
        
        } catch( \Exception $e){
            return $e->getMessage();
        }
    }
    
    
    
    /**
     * Resize
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $resizeConf
     * @return type
     */
    private function Resize( $resizeConf ){
        
        
        $action = array(
            'ZEBRA_IMAGE_BOXED' => 0,
            'ZEBRA_IMAGE_NOT_BOXED' => 1,
            'ZEBRA_IMAGE_CROP_TOPLEFT'=>2,
            'ZEBRA_IMAGE_CROP_TOPCENTER'=>3,
            'ZEBRA_IMAGE_CROP_TOPRIGHT'=>4,
            'ZEBRA_IMAGE_CROP_MIDDLELEFT'=>5,
            'ZEBRA_IMAGE_CROP_CENTER'=>6,
            'ZEBRA_IMAGE_CROP_MIDDLERIGHT'=>7,
            'ZEBRA_IMAGE_CROP_BOTTOMLEFT'=>8,
            'ZEBRA_IMAGE_CROP_BOTTOMCENTER'=>9,
            'ZEBRA_IMAGE_CROP_BOTTOMRIGHT'=>10,
        );
        
        $this->core->load->library('Zebra');
            
        $resize_manager = $this->core->library->zebra->Init();
        
        foreach($resizeConf as $key=>$resizeItem){
            
            $this->makeDirectory($this->response->fileData->dirPath . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR);
            
            $resize_manager->source_path = $this->response->fileData->realPath;
            
            $resize_manager->target_path = $this->response->fileData->dirPath . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . $this->response->fileData->fullName;
         
            if (!$resize_manager->resize($resizeItem['width'], $resizeItem['height'], $action[$resizeItem['method']], -1)) { 
                $this->response->message = $this->resizeError($resize_manager->error, $resize_manager->source_path, $resize_manager->target_path); 
                $this->response->status = false;
                return;
            }
        }
    }
    
    
    
    /**
     * resizeError
     * ----------------------------------------
     * 06.05.2015
     * 
     * @desc Initiale function
     * 
     * @category upload files
     * @name $lib\Upload
     * 
     * @author Codeion <damir@codeion.com>
     * @version 1.0
     * 
     * @param type $error_code
     * @param type $source_path
     * @param type $target_path
     * @return string
     */
    private function resizeError($error_code, $source_path, $target_path){
        
        switch ($error_code) {

            case 1:
                return 'Source file "' . $source_path . '" could not be found!';
            case 2:
                return 'Source file "' . $source_path . '" is not readable!';
            case 3:
                return 'Could not write target file "' . $source_path . '"!';
            case 4:
                return $source_path . '" is an unsupported source file format!';
            case 5:
                return $target_path . '" is an unsupported target file format!';
            case 6:
                return 'GD library version does not support target file format!';
            case 7:
                return 'GD library is not installed!';
            case 8:
                return '"chmod" command is disabled via configuration!';
        }
        
        return null;
    }
}