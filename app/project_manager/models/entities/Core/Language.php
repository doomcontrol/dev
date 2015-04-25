<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.language")
  */
 class Language {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=45, nullable=false) */
    private $name;
    /** @Column(type="string", length=45, nullable=true) */
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
    
    function setName( $val  ) { $this->name = $val; }
    
    function steStatus( $val = true ) { $this->status = $val ? 1 : 0; }
    

 }
 
 /* @End ----- */