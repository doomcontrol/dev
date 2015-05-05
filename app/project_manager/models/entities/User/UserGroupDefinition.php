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
    /** @Column(type="string", length=100, nullable=true) */
    private $icon;
    
    /**
     * @ManyToMany(targetEntity="models\entities\Core\Module")
     * @JoinTable(name="user_group_definition_modules",
     *      joinColumns={@JoinColumn(name="groupDefinitionId", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="moduleId", referencedColumnName="id")}
     *      )
     * */
    private $modules;
    
    
    /**
     * @ManyToMany(targetEntity="models\entities\Privilegies")
     * @JoinTable(name="user_group_definition_privilegies",
     *      joinColumns={@JoinColumn(name="groupDefinitionId", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="privilegyId", referencedColumnName="id")}
     *      )
     * */
    private $privilegies;
    
    
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
    function getModules(){ return $this->modules; }
    function getprivilegies(){ return $this->privilegies; }
    function getIcon(){ return $this->icon; }

   
    
    /**
     * 
     * SETERS
     */
    
    function setName($val){ $this->name = $val; }
    function setStatus($status = true) { $this->status = $status ? 1 : 0; }
    function setModule($module){ $this->modules[] = $module;}
    function setPrivilegies($privilegy){ $this->privilegies[] = $privilegy; }
    function setIcon($val) { $this->icon = $val; }
    
  
    

 }
 
 /* @End ----- */