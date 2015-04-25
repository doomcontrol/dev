<?php namespace lib;


class Session {
    
    private $session_time;
    
    private $sess_unit = 600;
    
    private $key;
    
    private $CI;
    
    
    public function __construct() {  }
    
    
    
    /**
     * @category Session
     * @name init
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    protected function init(){
        
        $this->key          = SECRET_KEY;
        
        $this->session_time = SESSION_TIMEOUT * $this->sess_unit;
    }
    
    
    
    
    /**
     * @category Session
     * @name save_session
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    public function set_session($name, $data, $session = null){
        
        $this->init();
        
        if($session > 0){
            $this->session_time = $session * $this->sess_unit;
        }
        
        $serializedData = base64_encode(serialize($data));
        
        $cryptedData = $this->encrypt_string( $serializedData );
        
        @setcookie($name, $cryptedData, time() + ($this->session_time), "/");
        
        if(! @$_COOKIE[$name]){
            @setcookie($name, $cryptedData, time() + ($this->session_time), "/");
        }
        
    }
    
    public function set_session_raw($name, $data){
        
         @setcookie($name, $data, time() + ($this->session_time), "/");
        
    }
    

    
     /**
     * @category Session
     * @name encrypt_string
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    public function get_session( $name, $unserialize = true ){
        
        $this->init();
        
        $cryptedData = isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
        
        if( ! $cryptedData ) return null;
        
        if($unserialize)
            $decryptedData = $this->decrypt_string( $cryptedData );
        else 
            $decryptedData = $cryptedData;
        
     
        $unserializedData = $unserialize ? unserialize( base64_decode($decryptedData) ) : $decryptedData;
        
        if($decryptedData && !$unserializedData && $unserialize){
            $unserializedData = unserialize(base64_decode($decryptedData));
        }
        
        if(is_serialized($unserializedData)){
            $unserializedData = unserialize(base64_decode($decryptedData));
        }
        
        return $unserializedData;
    }
    
    
    
    
    /**
     * @category Session
     * @name delete_session
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    public function delete_session($name){
        
        if(isset( $_COOKIE[$name])){
            unset( $_COOKIE[$name] );
            @setcookie($name, null, -1, '/');
        }
    }
    
    
    
    
    /**
     * @category Session
     * @name delete_session_all
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    public function delete_session_all(){
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
    }
    
    
    
   
    
    
    
    /**
     * @category Session
     * @name encrypt_string
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    protected function encrypt_string($pure_string){
        
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $this->key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        
        return base64_encode($encrypted_string);
    }

    
    
    /**
     * @category Session
     * @name decrypt_string
     * @version 1.0
     * 
     * @author Damir Mozar <dmozar@gmail.com>
     * @copyright (c) 2015, intermedia.eu.com
     */
    protected function decrypt_string($encrypted_string){
        
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $this->key, base64_decode($encrypted_string), MCRYPT_MODE_ECB, $iv);
        
        return $decrypted_string;
    }
    
    
    
    
}
