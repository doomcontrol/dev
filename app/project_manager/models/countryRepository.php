<?php namespace models;


use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \models\entities\Core\Process;

class countryRepository extends EntityRepository {
    

    function getAll( ){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial c.{id, name, code, flag }',
            
        ))->from ( 'models\entities\Core\Country', 'c' );
        
        
        return $qb->getQuery()->getResult();
    }
    
   
}