<?php namespace models;


use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \models\entities\Core\Process;

class processRepository extends EntityRepository {
    

    function findBySubdomain( $subdomain ){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial p.{id, companyName, urlShort, status, startDate, endDate }',
            'partial o.{id, fname, mname, lname, username,password, email}',
            'partial pg.{id,name}'
            
        ))->from ( 'models\entities\Core\Process', 'p' )
        ->leftJoin('p.owner', 'o')
        ->leftJoin('p.package', 'pg')
                
        ->where('p.urlShort = :subdomain')
        ->setParameter('subdomain', $subdomain );
        
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    
}