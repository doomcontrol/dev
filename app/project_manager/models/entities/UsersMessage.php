<?php namespace models\entities;



/**
  * @Entity(repositoryClass="models\usersMessageRepository")
  * @Table(name="usersMessage")
  */
 class UsersMessage {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=80, nullable=false) */
    private $title;
    /** @Column(type="string", length=500, nullable=false) */
    private $message;
    /** @Column(type="datetime", length=30, nullable=false) */
    private $postDate; 
    
    
    
    /**
     * @ManyToOne(targetEntity="models\entities\Users")
     * @JoinColumn(name="userId", referencedColumnName="id", nullable=false)
     **/
    private $user;
    
    
    
    /**
     * @OneToMany(targetEntity="models\entities\UserMessage\MarkReaded", mappedBy="message")
     **/
    private $readList;
  
    
    
    public function __construct() {
        $this->postDate = new \DateTime();
    }
    
    
    
    function getID() { return $this->id; }
    function getTitle() { return $this->title; }
    function getMessage() { return $this->message; }
    function getPostDate( $format = true){ return $format ? $this->postDate->format('d.m.Y') : $this->postDate; }
    function getPostDateISO(){ return $this->postDate->format(\DateTime::ISO8601); }
    function getUser(){ return $this->user; }
    function getReadList() { return $this->readList; }
   
    
    
    function setTitle($val){ $this->title = $val; }
    function setMessage($val) { $this->message = $val; }
    function setUser( \models\entities\Users $user) { $this->user = $user; }
    function setReadList( \models\entities\UserMessage\MarkReaded $mark) { $this->readList[] = $mark;}
    
  
    

 }
 
 /* @End ----- */