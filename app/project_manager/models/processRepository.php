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
    
    function getGuiText( $lang_id = 1){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial gt.{ id, guiText, guiString }',
            'partial l.{ id,name}'
            
        ))->from ( 'models\entities\Core\GuiText', 'gt' )
        ->innerJoin('gt.language', 'l')
                
        ->where('l.status = 1')
        ->andWhere('l.id = :lang_id')
        ->setParameter('lang_id', $lang_id);
        
        return $qb->getQuery()->getArrayResult();
    }
    
    function getRevision(){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial r.{ id, revision }'
            
        ))->from ( 'models\entities\Core\Revision', 'r' )
                
        ->orderBy('r.id','DESC')
        ->setMaxResults(1);
        
        return $qb->getQuery()->getOneOrNullResult();
        
    }
    
    function getClientRevision(){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial r.{ id, revision }'
            
        ))->from ( 'models\entities\Revision', 'r' )
                
        ->orderBy('r.id','DESC')
        ->setMaxResults(1);
        
        return $qb->getQuery()->getOneOrNullResult();
        
    }
    
    function updateClientRevision($revision){
        
        $entity = new \models\entities\Revision();
        $entity->setRevision( $revision );
        
        $this->_em->persist( $entity );
        $this->_em->flush();
        
    }
}