<?php namespace models;



use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \application\controllers\company\src\models\entities\Company;


class usersRepository extends EntityRepository {
    
    function findByLogin($username,$password){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial u.{id, fname, lname,hash, username, isOwner, email}',
            
        ))->from ( 'models\entities\Users', 'u' )
                
        ->where('u.username = :username')
        ->andWhere('u.password = :password')
        //->orderBy('RAND()')
        ->setParameter('username', $username )
        ->setParameter('password', $password );
        
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    
}