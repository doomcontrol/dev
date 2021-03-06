<?php

namespace proxies\__CG__\models\entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Privilegies extends \models\entities\Privilegies implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'id', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'name', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'read', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'write', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'edit', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'delete', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'upload', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'viewInternal', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'manageAll');
        }

        return array('__isInitialized__', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'id', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'name', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'read', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'write', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'edit', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'delete', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'upload', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'viewInternal', '' . "\0" . 'models\\entities\\Privilegies' . "\0" . 'manageAll');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Privilegies $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getID', array());

        return parent::getID();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getRead()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRead', array());

        return parent::getRead();
    }

    /**
     * {@inheritDoc}
     */
    public function getWrite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWrite', array());

        return parent::getWrite();
    }

    /**
     * {@inheritDoc}
     */
    public function getEdit()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEdit', array());

        return parent::getEdit();
    }

    /**
     * {@inheritDoc}
     */
    public function getDelete()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDelete', array());

        return parent::getDelete();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpload()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpload', array());

        return parent::getUpload();
    }

    /**
     * {@inheritDoc}
     */
    public function getViewInternal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getViewInternal', array());

        return parent::getViewInternal();
    }

    /**
     * {@inheritDoc}
     */
    public function getManageAll()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getManageAll', array());

        return parent::getManageAll();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($val)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($val));

        return parent::setName($val);
    }

    /**
     * {@inheritDoc}
     */
    public function setRead($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRead', array($bool));

        return parent::setRead($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setWrite($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWrite', array($bool));

        return parent::setWrite($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setEdit($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEdit', array($bool));

        return parent::setEdit($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setDelete($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDelete', array($bool));

        return parent::setDelete($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpload($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpload', array($bool));

        return parent::setUpload($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setViewInternal($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setViewInternal', array($bool));

        return parent::setViewInternal($bool);
    }

    /**
     * {@inheritDoc}
     */
    public function setManageAll($bool = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setManageAll', array($bool));

        return parent::setManageAll($bool);
    }

}
