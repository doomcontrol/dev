<?php namespace models;


use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \models\entities\Core\Process;

class companyRepository extends EntityRepository {
    
    /**
     * 
     * @return type
     */
    function getAll( $keyword = null ){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial cp.{id, name, street, number, zip, city, email, phone, logo, dtm }',
            'partial c.{id,name,code,flag}',
            'partial u.{id, fname, lname,hash, username, isOwner, email, avatar, position, joined}',
            
        ))->from ( 'models\entities\Company', 'cp' )
        ->leftJoin('cp.country', 'c')
        ->leftJoin('cp.createdBy', 'u');
        
        $this->filterGetAll($keyword, $qb);
        
        $query = $qb->getQuery(); 
        $query->setHint(Query::HINT_REFRESH, true);

        return $query->getResult();
    }
    
    
    /**
     * 
     * @param type $keyword
     * @param type $qb
     */
    private function filterGetAll($keyword, & $qb){
        
        if($keyword){
            
        	$keyList = explode(' ', $keyword);
        	$keyImplode = implode('%', $keyList);
        	$keywordString = str_replace('%%','%',('%'.$keyImplode.'%'));    
                
        	$qb
        	->where($qb->expr()->orX(
        			$qb->expr()->like('cp.name',  ':key1'),
        			$qb->expr()->like('cp.street',':key2'),
                                $qb->expr()->like('cp.city',  ':key3'),
        			$qb->expr()->like('cp.email', ':key4'),
                                $qb->expr()->like('cp.phone', ':key5'),
                                $qb->expr()->like('c.name',   ':key6')
        	));
                
                
                foreach($keyList as $index => $key){
                $qb->orWhere($qb->expr()->orX(
                                $qb->expr()->like('cp.name',    ':lopkey1_'.$index),
                                $qb->expr()->like('cp.street',  ':lopkey2_'.$index),
                                $qb->expr()->like('cp.city',    ':lopkey3_'.$index),
                                $qb->expr()->like('cp.email',   ':lopkey4_'.$index),
                                $qb->expr()->like('cp.phone',   ':lopkey5_'.$index),
                                $qb->expr()->like('c.name',     ':lopkey6_'.$index)
                    ));
                    $qb
                ->setParameter('lopkey1_'.$index, $key)
                ->setParameter('lopkey2_'.$index, $key)
                ->setParameter('lopkey3_'.$index, $key)
                ->setParameter('lopkey4_'.$index, $key)
                ->setParameter('lopkey5_'.$index, $key)
                ->setParameter('lopkey6_'.$index, $key);
                }
        	
        	
                $qb
        	->setParameter('key1', $keywordString)
        	->setParameter('key2', $keywordString)
        	->setParameter('key3', $keywordString)
                ->setParameter('key4', $keywordString)
                ->setParameter('key5', $keywordString)
                ->setParameter('key6', $keywordString); 
        }
        
    }
   
}