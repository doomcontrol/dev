<?php namespace models;



use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \application\controllers\company\src\models\entities\Company;


class usersRepository extends EntityRepository {
    
    function findByLogin($username,$password){
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            'partial u.{id, fname, lname,hash, username, isOwner, email, avatar, position, joined}',
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
            'partial u.{id, fname, lname,hash, username, isOwner, email, avatar, position, joined}',
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
    
    function getFirstUserInGroup($group_id){
        
        $qb = $this->_em->createQueryBuilder();
        
         $qb->select(array(
            'partial u.{id, fname, lname,hash, username, isOwner, email, avatar, position, joined}',
            'partial ugd.{id,name,status,icon}',
            'partial m.{id,name,status}',
            'partial ugdp.{id,name,read,write,edit,delete,upload,viewInternal,manageAll}'
        ))->from ( 'models\entities\Users', 'u' )
        ->leftJoin('u.user_groups_definition','ugd')
        ->leftJoin('ugd.privilegies','ugdp')
        ->leftJoin('ugd.modules','m')
        ->where('ugd.id = :gid')
        ->orderBy('u.position','ASC')
        ->setMaxResults(1)
        ->setParameter('gid', $group_id);
        
        $query = $qb->getQuery();
        $query->setHint(Query::HINT_REFRESH, true);


        return $query->getOneOrNullResult();
        
    }
    
    
    function getAll($keyword = null){
        
         $qb = $this->_em->createQueryBuilder();
        
         $qb->select(array(
            'partial u.{id, fname, lname,hash, username, isOwner, email, avatar, position, joined}',
            'partial ugd.{id,name,status,icon}',
            'partial m.{id,name,status}',
            'partial ugdp.{id,name,read,write,edit,delete,upload,viewInternal,manageAll}'
        ))->from ( 'models\entities\Users', 'u' )
        ->leftJoin('u.user_groups_definition','ugd')
        ->leftJoin('ugd.privilegies','ugdp')
        ->leftJoin('ugd.modules','m')
        ->orderBy('u.position','ASC');
         
        $this->filterGetAll($keyword, $qb);
        
        $query = $qb->getQuery(); 
        $query->setHint(Query::HINT_REFRESH, true);

        return $query->getResult();
    }
    
    
    
    private function filterGetAll($keyword, & $qb){
        
        if($keyword){
            
        	$keyList = explode(' ', $keyword);
        	$keyImplode = implode('%', $keyList);
        	$keywordString = str_replace('%%','%',('%'.$keyImplode.'%'));    
                
        	$qb
        	->where($qb->expr()->orX(
        			$qb->expr()->like('u.fname',  ':key1'),
        			$qb->expr()->like('u.lname',  ':key2'),
                                $qb->expr()->like('u.email',  ':key3'),
        			$qb->expr()->like('ugd.name', ':key4')
        	));
                
                
                foreach($keyList as $index => $key){
                $qb->orWhere($qb->expr()->orX(
                                $qb->expr()->like('u.fname', ':lopkey1_'.$index),
                                $qb->expr()->like('u.lname', ':lopkey2_'.$index),
                                $qb->expr()->like('u.email', ':lopkey3_'.$index),
                                $qb->expr()->like('ugd.name',':lopkey4_'.$index)
                    ));
                    $qb
                ->setParameter('lopkey1_'.$index, $key)
                ->setParameter('lopkey2_'.$index, $key)
                ->setParameter('lopkey3_'.$index, $key)
                ->setParameter('lopkey4_'.$index, $key);
                }
        	
        	
                $qb
        	->setParameter('key1', $keywordString)
        	->setParameter('key2', $keywordString)
        	->setParameter('key3', $keywordString)
                ->setParameter('key4', $keywordString); 
        }
        
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
            
            $user->setPosition( $user->getID() );
            
            $this->_em->persist($user);
        
            $this->_em->flush();
            
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
    
    
    
    function storeAvatar($id, $avatar){
        
        $user = $this->_em->getReference('models\entities\Users', $id);
        
        if($user){
            $oldAvatar = $user->getAvatar();
            
            $user->setAvatar($avatar);
            
            $this->_em->persist( $user );
            $this->_em->flush();
            
            return $oldAvatar;
            
        }
        
        return null;
        
    }
    
    function setOrder($id, $prev_id){
        
        
        
    }
    
    
}