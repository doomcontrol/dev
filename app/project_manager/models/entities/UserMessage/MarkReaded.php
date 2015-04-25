<?php namespace models\entities\UserMessage;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="usersMessageMarkReaded")
  */
 class MarkReaded {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="datetime", nullable=true) */
    private $readDate;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $deleted;
    
    
    /**
     * @ManyToOne(targetEntity="models\entities\Users")
     * @JoinColumn(name="userId", referencedColumnName="id", nullable=false)
     **/
    private $user;
    
    /**
     * @ManyToOne(targetEntity="models\entities\UsersMessage", inversedBy="readList")
     * @JoinColumn(name="messageId", referencedColumnName="id")
     **/
    private $message;
  
    
    
    public function __construct() {
        $this->readDate = new \DateTime();
    }
    
    /**
     * 
     * GETTERS
     */
    
    function getID() { return $this->id; }
    
    function getReadDate() { return $this->readDate->format('d.m.Y H:i'); }
   
    function getDeleted() { return $this->deleted; }
    
    function getUser() { return $this->user; }
    
    function getMessage() { return $this->message; }
    
    
    
    /**
     * 
     * SETTERS
     */
    function setDeleted($boolean = true) { $this->deleted = $boolean ? 1 : 0; }
    
    function setUser( \models\entities\Users $user ) { $this->user = $user; }
    
    function setMessage( \models\entities\UsersMessage $message ) { $this->message = $message; }
  
    

 }
 
 /* @End ----- */