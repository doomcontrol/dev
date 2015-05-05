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
            'partial ugd.{id,name,status,icon}',
            'partial ugdp.{id,name,read,write,edit,delete,upload,viewInternal,manageAll}'
        ))->from ( 'models\entities\Users', 'u' )
        ->leftJoin('u.user_groups_definition','ugd')
        ->leftJoin('ugd.privilegies','ugdp')
                
        ->where('u.username = :username')
        ->andWhere('u.password = :password')
        //->orderBy('RAND()')
        ->setParameter('username', $username )
        ->setParameter('password', $password );
        
        $query = $qb->getQuery();
        $query->setHint(Query::HINT_REFRESH, true);


        $paginator  = new Paginator($query, $fetchJoinCollection = TRUE);
        $result     = $paginator;
        $records    = array();
        
        $user = null;
        
        foreach($result as $rslt){ $user = $rslt; break; }
        
        if($user)
        $this->getUserModules($user);
        
        return $user;
    }
    
    private function getUserModules( $user ){
        
        $idList = array();
        
        foreach($user->getUserGroupDefinition() as $def){
            $idList[] = $def->getID();
        }

        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            'partial ugd.{id,name,status,icon}',
            'partial m.{id,name,status}'
        ))->from ( 'models\entities\User\UserGroupDefinition', 'ugd' )
        ->leftJoin('ugd.modules','m')     
        ->where('ugd.id in('.implode(',',$idList).')');
        
         $query = $qb->getQuery()->getResult();
        
    }
    
    
    function getGroups(){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            'partial ugd.{id,name,status,icon}',
        ))->from ( 'models\entities\User\UserGroupDefinition', 'ugd' ) 
        ->where('ugd.status = 1');
        
        return  $query = $qb->getQuery()->getResult();
        
    }
    
    
    function findUserByEmail($email){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            'partial u.{id, fname, lname,hash, username, isOwner, email}',
        ))->from ( 'models\entities\Users', 'u' )
        ->where('u.email = :email')
        ->setParameter('email', $email );
        
        $query = $qb->getQuery();



        return $query->getOneOrNullResult();
    }
    
    
    function getUserGroupDefinition($id){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select('ugd')->from ( 'models\entities\User\UserGroupDefinition', 'ugd' )
        ->where('ugd.id = :id')
        ->setParameter('id', $id );
        
        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
        
    }
    
    
    function getAll(){
        
         $qb = $this->_em->createQueryBuilder();
        
         $qb->select(array(
            'partial u.{id, fname, lname,hash, username, isOwner, email}',
            'partial ugd.{id,name,status,icon}',
            'partial m.{id,name,status}',
            'partial ugdp.{id,name,read,write,edit,delete,upload,viewInternal,manageAll}'
        ))->from ( 'models\entities\Users', 'u' )
        ->leftJoin('u.user_groups_definition','ugd')
        ->leftJoin('ugd.privilegies','ugdp')
        ->leftJoin('ugd.modules','m');
        
        $query = $qb->getQuery();
        $query->setHint(Query::HINT_REFRESH, true);


        return $query->getResult();
    }
    
    
    function addNewUser($data){
        
        $user = $this->findUserByEmail($data['email']);
        
        $response = new \stdClass();
        
        if($user){
            
            $response->state = false;
            $response->message = "User_allready_exist";
            
            return $response;
        }
        
        $user = new \models\entities\Users();
        
        $user->setEmail($data['email']);
        $user->setHash();
        $user->setIsOwner(false);
        $user->setLastName($data['lastName']);
        $user->setName($data['firstName']);
        $user->setPassword($data['password'],true);
        $user->setStatus(true);
        $user->setUsername($data['email']);
        $user->setUsrGroupsDefinition($this->getUserGroupDefinition($data['userGroup']));
        
        $this->_em->persist($user);
        
        $this->_em->flush();
        
       
        
        if($user->getID()){
            
            $response->state = true;
            $response->message = null;
            $response->object = $user;
        } else {

            $response->state = false;
            $response->message = 'System_error_saving';
            $response->object = null;
        }
        
        return $response;
        
    }
    
    
    
    
    
}