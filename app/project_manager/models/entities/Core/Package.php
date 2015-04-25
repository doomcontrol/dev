<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.packages")
  */
 class Package {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=120, nullable=false) */
    private $name;
    
  
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * 
     * GETERS
     */
    
    function getID() { return $this->id; }    
    
    function getName() { return $this->fname; }
   
    
    /**
     * 
     * SETERS
     */
    
    function setName( $val ) { $this->name = $val; }
  
    

 }
 
 /* @End ----- */