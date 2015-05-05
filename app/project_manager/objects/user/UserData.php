<?php namespace objects\user;


class UserData {
    
    protected   $firstName,
                $lastName,
                $hash,
                $id,
                $isOwner,
                $email,
                $privilegies,
                $modules,
                $procesId;
    
    public function __construct() {
        
    }
    
    
    public static function userData(){
        
        global $session;
        
        return $session->get_session('userSes');
        
    }
    
    
    public function setFirstName( $fname ) { $this->firstName = $fname; }
    public function getFirstName() { return $this->firstName; }
    
    
    public function setLastName( $lname ) { $this->lastName = $lname; }
    public function getLastName() { return $this->lastName; }
    
    public function getFullName() { return $this->firstName . ' ' . $this->lastName; }
    
    
    public function setHash( $hash ) { $this->hash = $hash; }
    public function getHash() { return $this->hash; }
    
    
    public function setId( $id ) { $this->id = $id; }
    public function getId() { return $this->id; }
    
    
    public function isOwner() { return $this->isOwner; }
    public function setisOwner($boolean = false) { $this->isOwner = $boolean; }
    
    
    public function setEmail($email){ $this->email = $email;}
    public function getEmail(){ return $this->email;}
    
    public function getPrivilegies(){ return $this->privilegies; }
    public function setPrivilegies( $val ) { $this->privilegies = $val; }
    
    public function getModules(){ return $this->modules; }
    public function setModules( $val ) { $this->modules = $val; }
    
    public function setProcessID($val){$this->procesId = $val;}
    public function getProcessID(){ return $this->procesId;}
    
    
}