<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.process")
  */
 class Process {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=255, nullable=false) */
    private $companyName;
    /** @Column(type="string", length=45, nullable=false) */
    private $urlShort;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $status;
    /** @Column(type="datetime", nullable=true) */
    private $startDate; 
    /** @Column(type="datetime", nullable=false) */
    private $endDate; 
  
    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Owner")
     * @JoinColumn(name="ownerId", referencedColumnName="id")
     **/
    private $owner;
    
    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Package")
     * @JoinColumn(name="packageId", referencedColumnName="id")
     **/
    private $package;
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * 
     * GETERS
     */
    
    function getID() { return $this->id; }
   
    function getCompanyName() { return $this->companyName; }
    
    function getUrlShort() { return $this->urlShort; }
    
    function getStatus() { return $this->status; }
    
    function getStartDate() { return $this->startDate; }
    
    function getEndDate() { return $this->endDate; }
    
    function getOwner() { return $this->owner; }
    
    function getPackage() { return $this->package; }
    
    
    
    /**
     * SETERS
     */
    
    function setCompanyName( $val ){ $this->companyName = $val; }
    
    function setUrlShort( $val ) { $this->urlShort = $val; }
    
    function setStatus( $status_on = true ) { $this->status = $status_on ? 1 : 0; }
    
    function setEndDate( $datetime ) { $this->endDate = $datetime; }
    
    function setOwner( \models\entities\Core\Owner $val ) { $this->owner = $val; } 
    
    function setPackage( \models\entities\Core\Package $val ) { $this->package = $val; } 
    
  
    

 }
 
 /* @End ----- */