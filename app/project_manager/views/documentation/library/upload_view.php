<div class="clr docpage">
    <h1>Library::Upload <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>Upload file</h3>
        
        <div class="summary">Uplaod library requires service name, id of entity item from database.
            <p>
                Service create in controler/upload/ path in your application. Service structure is like this
            </p>
        </div>
        <?php $core->load->library("String")?>
        <pre class="prettyprint linenums lang-php">
        <?= prettify(' <?php namespace controler\upload;
            class userAvatar {
            
                public $config;
                public $serviceName;
                
                public function __construct() { $this->Init();}
                
                public function Init(){
                
                    $this->config = array(
                        \'target\'    => sprintf(IMAGES_CLIENTS, \processData::getProcessData()->getUrlShort() ),
                        \'dirname\'   => USER_AVATAR_PATH,
                        \'type\'      => \controler\Upload::ALLOW_IMAGE,
                        \'resize\'    => array(
                            \'small\'=> array(\'width\'=>120, \'height\'=>120, \'method\'=>\'ZEBRA_IMAGE_CROP_CENTER\'),
                            \'medium\'=> array(\'width\'=>300, \'height\'=>200, \'method\'=>\'ZEBRA_IMAGE_CROP_CENTER\'),
                            \'big\'=> array(\'width\'=>450, \'height\'=>300, \'method\'=>\'ZEBRA_IMAGE_BOXED\'),
                    ),
                    \'maxsize\' => 400000,
                    \'response\'  => \'Store\',
                    \'live\'=>array(
                        \'target\'=>\'#userAvatar%s\',
                        \'callback\' => \'PostComponent\',
                        \'method\'=>\'html\',
                        \'id\'=>\'#cartUser\'
                    ),
                );
        
                $this->serviceName = get_class($this);
        
                return $this;
                }


                public function getAvatarPath(){

                    $this->Init();

                    return sprintf( $this->config[\'target\'], $this->config[\'dirname\']);

                }



                public function getImagePath(){

                    $this->Init();

                    return sprintf( $this->config[\'target\'], $this->config[\'dirname\']);

                }


                public static function Service(){
                    return new \controler\upload\userAvatar;
                }


                public function Store($id, $response){

                    global $core;

                    $userModel = $core->em->getRepository(\'models\entities\Users\');

                    $oldAvatar = $userModel->storeAvatar($id,$response->fileData->fullName);

                    if($oldAvatar){
                        $this->unlinkImage( 
                            sprintf( $response->fileData->target, USER_AVATAR_PATH),
                            $oldAvatar
                        );
                    }

                    $response->live = new \stdClass();
                    $response->reinit = true;
                    $response->strOutput = \components\user\useravatar\cartview\Component::display( $response->fileData->fullName, $id );

                    return $response;
                }


                private function unlinkImage($path,$imageName){

                    $fullPath = $path . $imageName;

                    if(file_exists( $fullPath ))unlink($fullPath);

                    foreach($this->config[\'resize\'] as $key=>$value){
                        $fullPath = $path . $key . DIRECTORY_SEPARATOR . $imageName;

                        if(file_exists( $fullPath ))unlink($fullPath);
                    }
                }
            }')?>
        </pre>
        <div class="summary">
            Service must have config;
            <p><strong>targer</strong>:  server path where file will be uploaded.</p>
            <p><strong>dirname</strong>:  must have directory name - relative path where file will be uploaded.</p>
            <p><strong>type</strong>: allowed type`s for upload.</p>
            <p><strong>maxsize</strong>: maximum file size</p>
            <p><strong>response</strong>: Service function called after upload file</p>
            Optional Parameters
            <p><strong>resize</strong>: array with resize arguments, width, height, method. This will used only for image upload</p>
            <p><strong>live</strong>: live configuration for live screen update</p>
        </div>
        
        <div class="summary">
            Upload is used with javascript called from html.
            <pre class="prettyprint linenums lang-html">
<?= prettify('<form id="adduser1430464649" method="post" action="/call" data-class="Upload" data-funct="DoUpload" data-service="userAvatar" data-id="39" class="fullscreen boxsizing">
    <div class="upload-box boxsizing" id="dropbox_1431887442" data-processing="Processing...">
        <div class="uploadclick fullscreen">
            <span class="init-text-upload">
                <i class="icon-upload-alt">&nbsp;</i><br>
                    DRAG&amp;DROP FILE<br>
                    <small>or click here to chose file</small>
            </span>
            <input type="file" id="input" class="boxsizing">
            <div class="throbber">
                <div class="loader" id="throbber_1431887442"></div>
                <div class="message" id="message_1431887442"></div>
            </div>
        </div>
    </div>        
</form>') ?>
            </pre>
        </div>
    </div>
</div>