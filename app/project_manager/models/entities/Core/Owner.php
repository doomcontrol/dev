<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.owner")
  */
 class Owner {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=45, nullable=false) */
    private $fname;
    /** @Column(type="string", length=45, nullable=true) */
    private $mname;
    /** @Column(type="string", length=45, nullable=true) */
    private $lname;
    /** @Column(type="string", length=30, nullable=false) */
    private $username; 
    /** @Column(type="string", length=90, nullable=false) */
    private $password;
    /** @Column(type="string", length=80, nullable=false) */
    private $email;
    /** @Column(type="string", length=120, nullable=true) */
    private $hash;
  
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * 
     * GETERS
     */
    function getID() { return $this->id; }
    
    function getName() { return $this->fname; }
    
    function getLastName() { return $this->lname; }
    
    function getMiddleName() { return $this->mname; }
    
    function getUsername(){ return $this->username; }
    
    function getPassword(){ return $this->password;}
    
    function getEmail(){ return $this->email;}
    
    function getHash() { return $this->hash; }
    
  
    /**
     * 
     * SETERS
     */   
    
    function setName( $val ) { $this->fname = $val; }
    
    function setMiddleName( $val ) { $this->mname = $val; }
    
    function setLastName( $val ) { $this->lname = $val; }
    
    function setUsername( $val ) { $this->username = $val; }
    
    function setPassword( $val ) { $this->password = \md5($val); }
    
    function setEmail( $val ) { $this->email = $val; }
    
    function setHash( $val ) { $this->hash = $val; }

 }
 
 /* @End ----- */