<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.revision")
  */
 class Revision {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="integer", length=10, nullable=false) */
    private $revision;
   
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    function getID() { return $this->id; }
    
    /**
     * GETERS
     */
   
    function getRevision() { return $this->revision; }
    
    /**
     * SETERS
     */
    
    function setRevision( $val ) { $this->revision = $val; }
    

 }
 
 /* @End ----- */