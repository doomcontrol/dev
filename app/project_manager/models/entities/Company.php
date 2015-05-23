<?php namespace models\entities;



/**
  * @Entity(repositoryClass="models\companyRepository")
  * @Table(name="company")
  */
 class Company {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=250, nullable=false) */
    private $name;
    
    /** @Column(type="string", length=200, nullable=true) */
    private $street;
    
    /** @Column(type="string", length=20, nullable=true) */
    private $number;

    /** @Column(type="string", length=20, nullable=true) */
    private $zip;
    
    /** @Column(type="string", length=120, nullable=true) */
    private $city;
    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Country")
     * @JoinColumn(name="countryId", referencedColumnName="id", nullable=true)
     **/
    private $country;
    
    /** @Column(type="string", length=140, nullable=true) */
    private $email;
    
    /** @Column(type="string", length=250, nullable=true) */
    private $phone;
    
    /** @Column(type="string", length=60, nullable=true) */
    private $logo;
    
    /**
     * @ManyToOne(targetEntity="models\entities\Users")
     * @JoinColumn(name="createUserId", referencedColumnName="id", nullable=false)
     **/
    private $createdBy;
    
    /** @Column(type="datetime",  nullable=false) */
    private $dtm;
    
    /** @Column(type="integer", length=10, nullable=true) */
    private $position;
    
   
    public function __construct() {
        $this->dtm = new \DateTime();
    }
    
    
    
    function getID() { return $this->id; }
    
    
    /**
     * GETERS
     */
   
    function getName() { return $this->name; }
    function getStreet(){ return $this->street; }
    function getNUmber(){ return $this->number; }
    function getZip(){ return $this->zip;}
    function getCity(){ return $this->city; }
    function getCountry(){ return $this->country; }
    function getCreatedBy() { return $this->createdBy; }
    function getEmail(){ return $this->email; }
    function getPhone(){ return $this->phone; }
    function getLogo(){ return $this->logo; }
    function getDtm($format = false){ return $format ? $this->dtm->format('d.m.Y') : $this->dtm; }
    function getPosition(){ return $this->position;}
    
    /**
     * SETERS
     */
    
    function setName( $val ) { $this->name = $val; }
    function setStreet( $val ) { $this->street = $val; }
    function setNumber( $val ) { $this->number = $val; }
    function setZip( $val ) { $this->zip = $val; }
    function setCity( $val ) { $this->city = $val; }
    function setCountry( \models\entities\Core\Country $val ) { $this->country = $val; }
    function setCreatedBy( \models\entities\Users $val ) { $this->createdBy = $val; }
    function setEmail( $val ){ $this->email = $val; }
    function setPhone( $val ) { $this->phone = $val; }
    function setLogo($val){ $this->logo = $val; }
    function setPosition($val){ $this->position = $val;}

 }
 
 /* @End ----- */
