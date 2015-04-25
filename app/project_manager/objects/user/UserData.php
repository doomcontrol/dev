<?php namespace objects\user;


class UserData {
    
    protected   $firstName,
                $lastName,
                $hash,
                $id,
                $isOwner,
                $email;
    
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
    
    
    public function setHash( $hash ) { $this->hash = $hash; }
    
    public function getHash() { return $this->hash; }
    
    
    public function setId( $id ) { $this->id = $id; }
    
    public function getId() { return $this->id; }
    
    
    public function isOwner() { return $this->isOwner; }
    
    public function setisOwner($boolean = false) { $this->isOwner = $boolean; }
    
    
    public function setEmail($email){ $this->email = $email;}
    
    public function getEmail(){ return $this->email;}
    
    
}