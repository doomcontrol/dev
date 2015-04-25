<?php namespace models\entities\User;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="user_group_definition")
  */
 class UserGroupDefinition {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=255, nullable=false) */
    private $name;
    /** @Column(type="integer", length=2, nullable=false) */
    private $status;
  
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * 
     * GETERS
     */
    
    function getID() { return $this->id; }
    function getName() { return $this->name; }
    function getStatus(){ return $this->status; }
   
    
    /**
     * 
     * SETERS
     */
    
    function setName($val){ $this->name = $val; }
    function setStatus($status = true) { $this->status = $status ? 1 : 0; }
   
    
  
    

 }
 
 /* @End ----- */