<?php namespace models\entities;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="users")
  */
 class Users {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=45, nullable=false) */
    private $fname;
    /** @Column(type="string", length=45, nullable=true) */
    private $lname;
    /** @Column(type="integer", length=2, nullable=false) */
    private $status;
    /** @Column(type="string", length=30, nullable=false) */
    private $username; 
    /** @Column(type="string", length=50, nullable=false) */
    private $password;
    /** @Column(type="string", length=120, nullable=true) */
    private $hash;
    /** @Column(type="integer", length=10, nullable=true) */
    private $languageId;
    /** @Column(type="integer", length=2, nullable=false) */
    private $isOwner;
    /** @Column(type="string", length=80, nullable=false) */
    private $email;
    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Language")
     * @JoinColumn(name="languageId", referencedColumnName="id", nullable=true)
     **/
    private $language;
  
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    function getID() { return $this->id; }
    function getName() { return $this->fname; }
    function getLastName() { return $this->lname; }
    function getfullName() { return $this->fname . ' ' . $this->lname; }
    function getStatus(){ return $this->status; }
    function getUsername(){ return $this->username; }
    function getPassword(){ return $this->password;}
    function getHash(){ return $this->hash;}
    function getLanguage() { return $this->language; }
    function getIsOwner() { return $this->isOwner; }
    function getEmail(){ return $this->email;}
    
    
    function setName($val){ $this->fname = $val; }
    function setLastName($val) { $this->lname = $val; }
    function setStatus($status = true) { $this->status = $status ? 1 : 0; }
    function setUsername($val){ $this->username = $val;}
    function setPassword($val, $md5 = true){ $this->password = $md5 ? \md5($val) : $val; }
    function setHash($val){ $this->hash = $val; }
    function setLanguage( \models\entities\Core\Language $val ) { $this->language = $val; }
    function setIsOwner($bool = false){ $this->isOwner = $bool ? 1 : 0;}
    function setEmail( $val ) { $this->email = $val; }
    
  
    

 }
 
 /* @End ----- */