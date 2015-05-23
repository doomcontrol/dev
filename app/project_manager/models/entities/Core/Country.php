<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\countryRepository")
  * @Table(name="projectcontrol.country")
  */
 class Country {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=255, nullable=false) */
    private $name;
    /** @Column(type="string", length=20, nullable=false) */
    private $code;
    /** @Column(type="string", length=40, nullable=true) */
    private $flag;
   
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    function getID() { return $this->id; }
    
    /**
     * GETERS
     */
   
    function getName() { return $this->name; }
    function getCode() { return $this->code; }
    function getFlag() { return $this->flag; }
    
    /**
     * SETERS
     */
    
    function setName( $val ) { $this->name = $val; }
    function setCode( $val ) { $this->code = $val; }
    function setFlag( $val ) { $this->flag = $val; }

 }
 
 /* @End ----- */