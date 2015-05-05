<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="projectcontrol.modules")
  */
 class Module {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=80, nullable=false) */
    private $name;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $status;
    
    
    
    
    
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * 
     * GETERS
     */
    
    function getID() { return $this->id; }
    
    function getName(){ return $this->name; }
   
    function getStatus() { return $this->status; }
    
    
    /**
     * 
     * SETERS
     */
    
    function setName( $val ){ $this->name = $val; }
    
    function setStatus($bool = true) { $this->status = $bool ? 1 : 0; }
   
    
  
    

 }
 
 /* @End ----- */