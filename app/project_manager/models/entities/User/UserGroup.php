<?php namespace models\entities\User;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="user_group")
  */
 class UserGroup {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @Column(type="integer", length=2, nullable=false) */
    private $status;
  
    
    /**
     * @ManyToOne(targetEntity="models\entities\Users")
     * @JoinColumn(name="userId", referencedColumnName="id")
     **/
    private $user;
    
    
    /**
     * @ManyToOne(targetEntity="models\entities\User\UserGroupDefinition")
     * @JoinColumn(name="groupDefinitionId", referencedColumnName="id")
     **/
    private $group_definition;
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * 
     * GETERS
     */
    
    function getID() { return $this->id; }
    
    function getStatus(){ return $this->status; }
   
    function getUser() { return $this->user; }
    
    function getGroupDefinition() { return $this->group_definition; }
    
    /**
     * 
     * SETERS
     */
    
    function setStatus($status = true) { $this->status = $status ? 1 : 0; }
    
    function setUser( \models\entities\Users $val ) { $this->user = $val; }
    
    function setGroupDefinition( models\entities\User\UserGroupDefinition $val ){ $this->group_definition = $val; }
   
    
  
    

 }
 
 /* @End ----- */