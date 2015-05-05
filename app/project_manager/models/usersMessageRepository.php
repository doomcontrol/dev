<?php namespace models;



use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\Query;
use \Doctrine\ORM\Tools\Pagination\Paginator;
use \application\controllers\company\src\models\entities\Company;


class usersMessageRepository extends EntityRepository {
    
    function findLast($limit = 50){
        
        $userId = \objects\user\UserData::userData()->getId();
        
        $qb = $this->_em->createQueryBuilder();
        
        $qb->select(array(
            
            'partial m.{id, title, message, postDate}',
            'partial u.{id, fname, lname,hash, username, isOwner, email}',
            'partial rl.{id,deleted}',
            'partial rlu.{id}'
            
        ))->from ( 'models\entities\UsersMessage', 'm' )
        ->leftJoin('m.user', 'u')
        ->leftJoin('m.readList','rl')
        ->leftJoin('rl.user','rlu')
        ->where('rlu.id !=:userid')
        ->orWhere('rlu.id is null')
        //->orWhere('rlu.id = null')
        ->orderBy('m.id','DESC')
        ->groupBy('m.id')
        ->setFirstResult(0)
        ->setMaxResults($limit)
        ->setParameter('userid', $userId);
        
        
        
        return $qb->getQuery()->getResult();
    }
    
    function saveMessage($data){
        
        $message = new \models\entities\UsersMessage();
        
        $message->setMessage( $data['message'] );
        $message->setTitle( $data['title'] );
        $message->setUser(  $this->_em->find('\models\entities\Users', \objects\user\UserData::userData()->getId() ) );
        
        $this->_em->persist( $message );
        
        $this->_em->flush();
        
        if($message->getID()) return $message; else return false;
        
    }
    
    
    function markReaded($id){
        
         $message = $this->_em->find('\models\entities\UsersMessage', $id );
         $user = $this->_em->find('\models\entities\Users', \objects\user\UserData::userData()->getId() );
         
         $markRead = new \models\entities\UserMessage\MarkReaded();
         $markRead->setMessage( $message );
         $markRead->setUser($user);
         $markRead->setDeleted(false);
         
         $this->_em->persist($markRead);
         $this->_em->flush();
         
         
        
    }
    
}