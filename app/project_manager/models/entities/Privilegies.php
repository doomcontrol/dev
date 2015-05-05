<?php namespace models\entities;



/**
  * @Entity(repositoryClass="models\usersRepository")
  * @Table(name="privilegies")
  */
 class Privilegies {
     
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /** @Column(type="string", length=80, nullable=false) */
    private $name;
    
    /** @Column(type="smallint", length=2, nullable=false) */
    private $read;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $write;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $edit;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $delete;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $upload;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $viewInternal;
    /** @Column(type="smallint", length=2, nullable=false) */
    private $manageAll;
    
    
    function getID() { return $this->id;}
    function getName(){ return $this->name; }
    function getRead(){ return $this->read; }
    function getWrite(){ return $this->write; }
    function getEdit(){ return $this->edit; }
    function getDelete(){ return $this->delete; }
    function getUpload(){ return $this->upload; }
    function getViewInternal() { return $this->viewInternal; }
    function getManageAll(){ return $this->manageAll; }
    
    function setName($val){ $this->name = $val;}
    

    function setRead($bool = true){ $this->read = $bool ? 1 : 0; }
    function setWrite($bool = true){ $this->write = $bool ? 1 : 0; }
    function setEdit($bool = true){ $this->edit = $bool ? 1 : 0; }
    function setDelete($bool = true){ $this->delete = $bool ? 1 : 0; }
    function setUpload($bool = true){ $this->upload = $bool ? 1 : 0; }
    function setViewInternal($bool = true) { $this->viewInternal = $bool ? 1 : 0; }
    function setManageAll($bool = true){ $this->manageAll = $bool ? 1 : 0; }
    
    
 }