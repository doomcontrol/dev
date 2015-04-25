<?php namespace models\entities\Core;



/**
  * @Entity(repositoryClass="models\processRepository")
  * @Table(name="projectcontrol.guiText")
  */
 class GuiText {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=45, nullable=false) */
    private $guiString;
    /** @Column(type="string", length=500, nullable=false) */
    private $guiText;

    
    /**
     * @ManyToOne(targetEntity="models\entities\Core\Language")
     * @JoinColumn(name="languageId", referencedColumnName="id")
     **/
    private $language;
    
  
    
    
    public function __construct() {
        //$this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    function getID() { return $this->id; }
    
    /**
     * GETERS
     */
   
    function getGuiString() { return $this->guiString; }
    
    function getGuiText() { return $this->guiText; }
    
    function getLanguage() { return $this->language; }
    
    /**
     * SETERS
     */
    
    function setGuiString( $val ) { $this->guiString = $val; }
    
    function setGuiText( $val ) { $this->guiText = $val; }
    
    function setLanguage( \models\entities\Core\Language $val ) { $this->language = $val; }
    

 }
 
 /* @End ----- */