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
    /** @Column(type="string", length=120, nullable=false) */
    private $hash;
    /** @Column(type="integer", length=2, nullable=false) */
    private $isOwner;
    /** @Column(type="string", length=80, nullable=false) */
    private $email;
    /** @Column(type="string", length=80, nullable=true) */
    private $avatar;
    /** @Column(type="integer", length=10, nullable=true) */
    private $position;
    /** @Column(type="datetime", nullable=false) */
    private $joined;
    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Language")
     * @JoinColumn(name="languageId", referencedColumnName="id", nullable=true)
     **/
    private $language;
    
    
    /**
     * @ManyToMany(targetEntity="models\entities\User\UserGroupDefinition")
     * @JoinTable(name="user_group",
     *      joinColumns={@JoinColumn(name="userId", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="userGroupDefinitionId", referencedColumnName="id")}
     *      )
     * */
    private $user_groups_definition;
  
    
    
    public function __construct() {
        $this->joined = new \DateTime(); 
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
    function getUserGroupDefinition(){ return $this->user_groups_definition; }
    function getAvatar(){ return $this->avatar; }
    function getPosition(){ return $this->position;}
    function getJoined( $format = true){ return $format ? $this->joined->format('d.m.Y') : $this->joined; }
    function getJoinedISO(){ return $this->joined->format(\DateTime::ISO8601); }
    
    
    function setName($val){ $this->fname = $val; }
    function setLastName($val) { $this->lname = $val; }
    function setStatus($status = true) { $this->status = $status ? 1 : 0; }
    function setUsername($val){ $this->username = $val;}
    function setPassword($val, $md5 = true){ $this->password = $md5 ? \md5($val) : $val; }
    function setHash(){ $this->hash = md5(\time()); }
    function setLanguage( \models\entities\Core\Language $val ) { $this->language = $val; }
    function setIsOwner($bool = false){ $this->isOwner = $bool ? 1 : 0;}
    function setEmail( $val ) { $this->email = $val; }
    function setUsrGroupsDefinition(\models\entities\User\UserGroupDefinition $user_group_definition ) { $this->user_groups_definition[] = $user_group_definition; }
    function setAvatar( $val ) { $this->avatar = $val; }
    function setPosition($val){ $this->position = $val;}
    

 }
 
 /* @End ----- */